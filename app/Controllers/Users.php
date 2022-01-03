<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
	public function index()
	{
		if(!punyaAkses(['admin'])){
			return redirect()->back()->with('msg', [0, lang("Error.tidakMemilikiAksesKehalamanTsb")]);
		}

		$URI = service('uri');
		$segments = $URI->getSegments();

		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Pengguna",
		];

		if ($segments[1] == "pengguna") {
			$data['subnav'] = "pengguna";
			$data['pgtitle'] = "Data Pengguna";
			$data['pgdesc'] = "Seluruh pengguna dalam sistem ini";
			$data['users'] =  $this->users->findAll();
		} elseif ($segments[1] == "anggota") {
			$data['subnav'] = "anggota";
			$data['pgtitle'] = "Data Anggota";
			$data['pgdesc'] = "Seluruh anggota UKM Informatika dan Komputer";
			$data['users'] =  $this->users->where('role', 'anggota')->findAll();
		} elseif ($segments[1] == "peserta") {
			$data['subnav'] = "peserta";
			$data['pgtitle'] = "Data Peserta";
			$data['pgdesc'] = "Peserta yang pernah mendaftar pada sistem";
			$data['users'] =  $this->users->where('role', 'peserta')->findAll();
		} else {
			return redirect()->back()->with('msg', [0,lang("Error.halamanTidakLengkap")]);
			die();
		}

		return view('users/index', $data);
	}

	public function add()
	{
		if(!punyaAkses(['admin'])){
			return redirect()->back()->with('msg', [0,lang("Error.tidakMemilikiAksesKehalamanTsb")]);
			die();
		}

		$URI = service('uri');
		$segments = $URI->getSegments();

		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Pengguna",
			'pgdesc' => "Formulir menambah data pengguna",
		];

		if ($segments[1] == "pengguna") {
			$url_redirect = site_url('home/pengguna');
			$data['subnav'] = "pengguna";
			$data['pgtitle'] = "Tambah Pengguna";
		} elseif ($segments[1] == "anggota") {
			$url_redirect = site_url('home/anggota');
			$data['subnav'] = "anggota";
			$data['pgtitle'] = "Tambah Anggota";
		} elseif ($segments[1] == "peserta") {
			$url_redirect = site_url('home/peserta');
			$data['subnav'] = "peserta";
			$data['pgtitle'] = "Tambah Peserta";
		} else {
			return redirect()->back()->with('msg', [0,lang("Error.halamanTidakLengkap")]);
			die();
		}

		// validate form input
		$this->validation->setRules(
			[
				'nama' 						=> 'trim|required',
				'username' 				=> 'trim|required|alpha_dash|is_unique[users.username]',
				'password' 				=> 'required|min_length[8]|matches[password_confirm]',
				'password_confirm' => 'required',
			],
			[   // Errors
				'username' => [
					'is_unique'   => 'Username sudah digunakan.',
				],
				'password' => [
					'min_length'  => 'Password kamu terlalu pendek.',
					'matches' 	  => 'Konfirmasi password belum tepat.',
				]
			]
		);

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
				$additionalData = [
					'nama' 			=> $this->request->getPost('nama'),
					'ava' 			=> $this->request->getPost('ava'),
					'username'  => $this->request->getPost('username'),
					'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
					'role'      => $this->request->getPost('role'),
					'nohp'		  => $this->request->getPost('nohp'),
					'create_at'	=> time(),
				];

				if($segments[1] == "peserta"){
					$additionalData['role'] = 'peserta';
				} else  if($segments[1] == "anggota"){
					$additionalData['role'] = 'anggota';
				}

				$lastid = $this->users->simpan($additionalData);

				$settingNotif = [
					'user' => $lastid,
					'login' => 0
				];
				$this->setting_notif->simpan($settingNotif);

				if ($lastid) {
					$rep = $this->log("insert", $lastid, "users");
					$this->report_to_admin("add_user", $rep);
					return redirect()->to($url_redirect)->with('msg', [1, lang("LangUsers.tambahBerhasil")]);
				} else {
					return redirect()->to($url_redirect)->with('msg', [0, lang("LangUsers.tambahGagal")]);
				}
		} else {

			$data['errors'] = $this->validation->getErrors();

			$data['nama'] = [
				'name'  => 'nama',
				'label' => 'Nama Lengkap',
				'placeholder' => 'Nama Lengkap',
				'value' => set_value('nama'),
			];

			$data['username'] = [
				'name'  => 'username',
				'label'    => 'Username',
				'placeholder' => 'Gunakan kombinasi karakter dan angka',
				'value' => set_value('username'),
			];

			$data['password'] = [
				'name'  => 'password',
				'label'    => 'Password',
				'placeholder' => 'Min. 8 Karakter',
			];

			$data['password_confirm'] = [
				'name'  => 'password_confirm',
				'label'    => 'Konfirmasi Password',
				'placeholder' => 'Konfirmasi Password',
			];

			$data['role'] = [
				'name'  => 'role',
				'label'    => 'Role',
				'value' => set_value('role'),
			];

			$data['nohp'] = [
				'name'  => 'nohp',
				'label'    => 'No. Handphone',
				'placeholder' => '08xxxx',
				'value' => set_value('nohp'),
			];

			return view('users/tambah', $data);
		}
	}

	public function update($id)
	{
		if(!punyaAkses(['admin'])){
			return redirect()->back()->with('msg', [0,lang("Error.tidakMemilikiAksesKehalamanTsb")]);
		}
		
		$id = decrypt_url($id);
		$URI = service('uri');
		$segments = $URI->getSegments();

		$datausers = $this->users->find($id);

		$this->breadcrumb->add('Home', site_url('home/dashboard'));

		$data = [
			'title' => "Pengguna",
			'pgdesc' => "Formulir mengubah data pengguna",
		];

		if ($segments[1] == "pengguna") {
			$url_redirect = site_url('home/pengguna');
			$data['subnav'] = "pengguna";
			$data['pgtitle'] = "Ubah Pengguna";
			$this->breadcrumb->add('Pengguna', $url_redirect);
		} elseif ($segments[1] == "anggota") {
			$url_redirect = site_url('home/anggota');
			$data['subnav'] = "anggota";
			$data['pgtitle'] = "Ubah Anggota";
			$this->breadcrumb->add('Anggota', $url_redirect);
		} elseif ($segments[1] == "peserta") {
			$url_redirect = site_url('home/peserta');
			$data['subnav'] = "peserta";
			$data['pgtitle'] = "Ubah Peserta";
			$this->breadcrumb->add('Peserta', $url_redirect);
		} else {
			return redirect()->back()->with('msg', [0,lang("Error.halamanTidakLengkap")]);
			die();
		}

		$this->breadcrumb->add('Ubah', '/');

		// validate form input
		$this->validation->setRules(
			[
				'nama' 						=> 'trim|required',
				'username' 				=> 'trim|required|alpha_dash|is_unique[users.username,id,{id}]',
			],
			[   // Errors
				'username' => [
					'is_unique'   => 'Username sudah digunakan.',
				],
			]
		);

		if ($this->request->getPost('password')) {
			$this->validation->setRules(
				[
					'password' 				=> 'required|min_length[8]|matches[password_confirm]',
					'password_confirm' => 'required',
				],
				[   // Errors
					'password' => [
						'min_length'  => 'Password kamu terlalu pendek.',
						'matches' 	  => 'Konfirmasi password belum tepat.',
					]
				]
			);
		}

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
			$additionalData = [
				'nama' 			=> $this->request->getPost('nama'),
				'ava'  			=> $this->request->getPost('ava'),
				'username'  => $this->request->getPost('username'),
				'role'      => $this->request->getPost('role'),
				'nohp'		  => $this->request->getPost('nohp'),
			];
			// update the password if it was posted
			if ($this->request->getPost('password')) {
				$additionalData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
			}

			if($segments[1] == "peserta"){
				$additionalData['role'] = 'peserta';
			} else  if($segments[1] == "anggota"){
				$additionalData['role'] = 'anggota';
			}

			$sebelum = $this->users->find($id);
			$lastid = $this->users->update($id, $additionalData);
			$sesudah = $this->users->find($id);

			if ($lastid) {
				$rep = $this->log("update", $id, "users", json_encode($sebelum), json_encode($sesudah));
				$this->report_to_admin("edit_user", $rep);
				// $this->report_to_usernya("edit_user", $id, $rep);
				return redirect()->to($url_redirect)->with('msg', [1, lang('LangUsers.ubahBerhasil')]);
			} else {
				return redirect()->to($url_redirect)->with('msg', [0, lang('LangUsers.ubahGagal')]);
			}
		} else {

			$data['breadcrumbs'] = $this->breadcrumb->render();
			$data['errors'] = $this->validation->getErrors();
			$data['ava'] = $datausers['ava'];
			$data['id'] = $id;

			$data['nama'] = [
				'name'  => 'nama',
				'label' => 'Nama Lengkap',
				'placeholder' => 'Nama Lengkap',
				'value' => set_value('nama', $datausers['nama'] ?: ''),
			];

			$data['username'] = [
				'name'  => 'username',
				'label'    => 'Username',
				'placeholder' => 'Username',
				'value' => set_value('username', $datausers['username'] ?: ''),
			];

			$data['password'] = [
				'name'  => 'password',
				'label'    => 'Password',
				'placeholder' => 'Isi jika ingin merubah password',
			];

			$data['password_confirm'] = [
				'name'  => 'password_confirm',
				'label'    => 'Konfirmasi Password',
				'placeholder' => 'Konfirmasi Password',
			];

			$data['role'] = [
				'name'  => 'role',
				'label'    => 'Role',
				'value' => set_value('role', $datausers['role'] ?: ''),
			];

			$data['nohp'] = [
				'name'  => 'nohp',
				'label'    => 'No. Handphone',
				'placeholder' => '08xxxx',
				'value' => set_value('nohp', $datausers['nohp'] ?: ''),
			];

			return view('users/ubah', $data);
		}
	}

	public function delete($id)
	{
		if(!punyaAkses(['admin'])){
			return redirect()->back()->with('msg', [0,lang("Error.tidakMemilikiAksesKehalamanTsb")]);
		}
		
		$id = decrypt_url($id);
		if (!empty($id)) {
			$URI = service('uri');
			$segments = $URI->getSegments();

			if ($segments[1] == "pengguna") {
				$url_redirect = site_url('home/pengguna');
			} elseif ($segments[1] == "anggota") {
				$url_redirect = site_url('home/anggota');
			} elseif ($segments[1] == "peserta") {
				$url_redirect = site_url('home/peserta');
			} else {
				return redirect()->back()->with('msg', [0,lang("Error.halamanTidakLengkap")]);
				die();
			}

			$data = [
				'delete_at' => time(),
			];
			$status = $this->users->update($id, $data);
			if ($status) {
				$rep = $this->log("delete", $id, "users");
				$this->report_to_admin("delete_user", $rep);
				$message = [1, lang("LangUsers.hapusBerhasil")];
			} else {
				$message = [0, lang("LangUsers.hapusGagal")];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		} else {
			return redirect()->back()->with("msg", [0, lang("Error.parameterHilang")]);
		}
	}
}
