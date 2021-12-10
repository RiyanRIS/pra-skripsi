<?php
namespace App\Controllers;


class Home extends BaseController
{

	public function __construct()
	{
	}

	public function index(){
		return redirect()->to(site_url('/home/dashboard'));
	}

	public function dashboard()
	{
		$data = $this->users->find(session()->user_id);
		if($data['remember_selector'] != null){
			set_cookie([
				'name'   => 'sim_ketika_riyanpunya_cok',
				'value'  => $data['remember_selector'],
				'expire' => time() + (3600 * 24 * 2) // 2 hari
			]);
		}
		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Dashboard",
			'nav' => "Dashboard",
			'pgtitle' => "Halaman Dashboard",
		];
		return view('home',$data);
	}

	public function setting(){
		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Pengaturan",
			'nav' => "Pengaturan",
			'pgtitle' => "Halaman Pengaturan",
		];
		return view('setting',$data);
	}

	function settingCode(){
		$user_id = session()->user_id;
		if($user_id){
			$datausers = $this->users->find($user_id);
			if($datausers['chat_id'] == null){
				$result = $datausers['terahir_dilihat'];
			} else {
				$result = "Akun kamu sudah terikat dengan Telegram";
			}
		} else {
			$result = "Kamu tidak memiliki akses kode";
		}
		return json_encode($result);
	}

	public function profil()
	{
		$user_id = session()->user_id;
		$datausers = $this->users->find($user_id);
		$url_redirect = 'home/profil';

		// validate form input
		$this->validation->setRules(
			[
				'nama' 						=> 'trim|required',
				'username' 				=> 'trim|required|is_unique[users.username, id, '.$user_id.']',
			],
			[   // Errors
				'username' => [
					'is_unique'   => 'Username sudah digunakan.',
				],
			]
		);

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
				$additionalData = [
					'nama' 			=> $this->request->getPost('nama'),
					'ava' 			=> $this->request->getPost('ava'),
					'username'  => $this->request->getPost('username'),
					'nohp'		  => $this->request->getPost('nohp'),
				];

				// update the password if it was posted
				if ($this->request->getPost('password_lama')) {
					if(strlen($this->request->getPost('password')) < 8){
						return redirect()->to($url_redirect)->with('msg', [0, "Minimal panjang password adalah 8 karakter"]);
						die();
					}
					if($this->request->getPost('password') != $this->request->getPost('password_confirm')){
						return redirect()->to($url_redirect)->with('msg', [0, "Konfirmasi password tidak cocok"]);
						die();
					}
					if(password_verify($this->request->getPost('password_lama'), $datausers['password'])){
						$additionalData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
					} else {
						return redirect()->to($url_redirect)->with('msg', [0, "Password masih belum tepat."]);
						die();
					}
				}

				$lastid = $this->users->update($user_id, $additionalData);
				$sesudah = $this->users->find($user_id);
				if ($lastid) {
					$this->log("update", $user_id, "users", json_encode($datausers), json_encode($sesudah));
					// Set Session
					$sessionData = [
						'user_id'   => $sesudah['id'],
						'user_nama' => $sesudah['nama'],
						'user_role' => $sesudah['role'],
						'user_ava'  => $sesudah['ava'],
					];
					session()->set($sessionData);
					
					return redirect()->to($url_redirect)->with('msg', [1, "Berhasil Mengubah Profil"]);
				} else {
					return redirect()->to($url_redirect)->with('msg', [0, 'Gagal Mengubah Profil']);
				}
		} else {
			$data = [
				'breadcrumbs' => $this->breadcrumb->buildAuto(),
				'title' => "Profil",
				'nav' => "Profil",
				'pgtitle' => "Halaman Profil",
			];

			$data['ava'] = $datausers['ava'];

			$data['errors'] = $this->validation->getErrors();

			$data['nama'] = [
				'name'  => 'nama',
				'label' => 'Nama Lengkap',
				'placeholder' => 'Nama Lengkap',
				'value' => set_value('nama', $datausers['nama'] ?: ''),
			];

			$data['username'] = [
				'name'  => 'username',
				'label'    => 'Username',
				'placeholder' => 'Gunakan kombinasi karakter dan angka',
				'value' => set_value('username', $datausers['username'] ?: ''),
			];

			$data['password_lama'] = [
				'name'  => 'password_lama',
				'label'    => 'Password Lama',
				'placeholder' => 'Password',
			];

			$data['password'] = [
				'name'  => 'password',
				'label'    => 'Password Baru',
				'placeholder' => 'Password Baru',
			];

			$data['password_confirm'] = [
				'name'  => 'password_confirm',
				'label'    => 'Konfirmasi Password',
				'placeholder' => 'Konfirmasi Password Baru',
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

			return view('profil',$data);
		}
	}

	public function logg($id){
		$id = decrypt_url($id);
		$log = $this->log->find($id);
		$data = [
			'data' => $log,
			'nama' => $this->users->withDeleted()->find($log['users'])['nama']
		];
		return view('log_umum',$data);
	}
         
	public function autorespon(){
		echo "<pre>".date("Y-m-d H:i:s")."</pre>";

		$time_now = time();

		$kegiatan = $this->kegiatan->where("tanggal >", $time_now)->findAll();

		foreach ($kegiatan as $key) {
			if($key['tanggal'] <= ($time_now + 1800)) // Cek jika ada notif 30 menit
			{
				if($key['notif_30'] == 1){
					$pesan = "Sekitar 30 menit lagi, akan dilaksanakan kegiatan ". $key['nama'];
					$this->pesan($key['id'], $pesan);
				}
			} else if($key['tanggal'] <= ($time_now + 3600)) {
				if($key['notif_1jam'] == 1){
					$pesan = "Sekitar 1 jam lagi, akan dilaksanakan kegiatan ". $key['nama'];
					
					$this->pesan($key['id'], $pesan);
				}
			} else if($key['tanggal'] <= ($time_now + 7200)) {
				if($key['notif_2jam'] == 1){
					$pesan = "Sekitar 2 jam lagi, akan dilaksanakan kegiatan ". $key['nama'];
					
					$this->pesan($key['id'], $pesan);
				}
			} else if($key['tanggal'] <= ($time_now + 10800)) {
				if($key['notif_3jam'] == 1){
					$pesan = "Sekitar 3 jam lagi, akan dilaksanakan kegiatan ". $key['nama'];
					
					$this->pesan($key['id'], $pesan);
				}
			} else if($key['tanggal'] <= ($time_now + 86400)) {
				if($key['notif_1hari'] == 1){
					$pesan = "Sekitar 1 hari lagi, akan dilaksanakan kegiatan ". $key['nama'];
					
					$this->pesan($key['id'], $pesan);
				}
			}
		}
	}

	function pesan($kegiatan, $pesan){
		$peserta = $this->peserta->getByKegiatan($kegiatan);

		foreach($peserta as $key){
			$users = $this->users->find($key['user']);
			if($users['chat_id'] != null){
				$this->kirim_pesan($users['chat_id'], $pesan);
			}
		}
	}

	function kirim_pesan($to, $msg){
		$bot_token = env("BOT_TOKEN_TELE");
		$bot = new \Telegram($bot_token);
		$content = ['chat_id' => $to, 'text' => $msg, 'parse_mode' => 'HTML'];
		$bot->sendMessage($content);
	}
}
