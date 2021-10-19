<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
	public function index()
	{
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
		} elseif ($segments[1] == "pengurus") {
			$data['subnav'] = "pengurus";
			$data['pgtitle'] = "Data Pengurus";
			$data['pgdesc'] = "Seluruh pengurus UKM Informatika dan Komputer";
			$data['users'] =  $this->users->where('role', 'pengurus')->findAll();
		} elseif ($segments[1] == "peserta") {
			$data['subnav'] = "peserta";
			$data['pgtitle'] = "Data Peserta";
			$data['pgdesc'] = "Peserta yang pernah mendaftar pada sistem";
			$data['users'] =  $this->users->where('role', 'peserta')->findAll();
		} else {
			echo "Akses dilarang.";
			die();
		}

		return view('users/index', $data);
	}

	public function add()
	{
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
		} elseif ($segments[1] == "pengurus") {
			$url_redirect = site_url('home/pengurus');
			$data['subnav'] = "pengurus";
			$data['pgtitle'] = "Tambah Pengurus";
		} elseif ($segments[1] == "peserta") {
			$url_redirect = site_url('home/peserta');
			$data['subnav'] = "peserta";
			$data['pgtitle'] = "Tambah Peserta";
		} else {
			echo "Akses dilarang.";
			die();
		}

		// validate form input
		$this->validation->setRules(
			[
				'nama' 						=> 'trim|required',
				'username' 				=> 'trim|required|is_unique[users.username]',
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
				$lastid = $this->users->simpan($additionalData);
				if ($lastid) {
					$rep = $this->log("insert", $lastid, "users");
					$this->report_to_admin("add_user", $rep);
					return redirect()->to($url_redirect)->with('msg', [1, "Berhasil Menambahkan Pengguna"]);
				} else {
					return redirect()->to($url_redirect)->with('msg', [0, 'gagal Menambahkan Pengguna']);
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
		} elseif ($segments[1] == "pengurus") {
			$url_redirect = site_url('home/pengurus');
			$data['subnav'] = "pengurus";
			$data['pgtitle'] = "Ubah Pengurus";
			$this->breadcrumb->add('Pengurus', $url_redirect);
		} elseif ($segments[1] == "peserta") {
			$url_redirect = site_url('home/peserta');
			$data['subnav'] = "peserta";
			$data['pgtitle'] = "Ubah Peserta";
			$this->breadcrumb->add('Peserta', $url_redirect);
		} else {
			echo "Akses dilarang.";
			die();
		}

		$this->breadcrumb->add('Ubah', '/');

		// validate form input
		$this->validation->setRules(
			[
				'nama' 						=> 'trim|required',
				'username' 				=> 'trim|required|is_unique[users.username,id,{id}]',
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

			$sebelum = $this->users->find($id);
			$lastid = $this->users->update($id, $additionalData);
			$sesudah = $this->users->find($id);

			if ($lastid) {
				$this->log("update", $id, "users", json_encode($sebelum), json_encode($sesudah));
				return redirect()->to($url_redirect)->with('msg', [1, "Berhasil Mengubah Pengguna"]);
			} else {
				return redirect()->to($url_redirect)->with('msg', [0, 'gagal Mengubah Pengguna']);
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
		$id = decrypt_url($id);
		if (!empty($id)) {
			$URI = service('uri');
			$segments = $URI->getSegments();

			if ($segments[1] == "pengguna") {
				$url_redirect = site_url('home/pengguna');
			} elseif ($segments[1] == "pengurus") {
				$url_redirect = site_url('home/pengurus');
			} elseif ($segments[1] == "peserta") {
				$url_redirect = site_url('home/peserta');
			} else {
				echo "Akses dilarang.";
				die();
			}

			$data = [
				'delete_at' => time(),
			];
			$status = $this->users->update($id, $data);
			if ($status) {
				$this->log("delete", $id, "users");
				$message = [1, "Berhasil Menghapus Pengguna"];
			} else {
				$message = [0, "Gagal Menghapus Pengguna"];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		} else {
			return redirect()->back()->with("msg", [0, "Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}
}
