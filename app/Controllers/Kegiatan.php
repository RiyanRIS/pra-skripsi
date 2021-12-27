<?php

namespace App\Controllers;

class Kegiatan extends BaseController
{
	public function index()
	{
		$URI = service('uri');
		$segments = $URI->getSegments();

		$data = [
				'breadcrumbs' => $this->breadcrumb->buildAuto(),
				'title' => "Kegiatan",
		];

		if($this->request->getGet("awal") && $this->request->getGet("ahir")){
			$data['dtawal'] = $this->request->getGet("awal");
			$data['dtahir'] = $this->request->getGet("ahir");
			$dtawal = strtotime($data['dtawal']);
			$dtahir = strtotime($data['dtahir']);
		}

		if(@$segments[2]){
			if(@$segments[2] == "semua"){
				$data['subnav'] = "semua";
				$data['pgtitle'] = "Data Semua Kegiatan";
				$data['pgdesc'] = "Seluruh kegiatan UKM Informatika dan Komputer";
				if(@$data['dtawal']){
					$data['kegiatans'] =  $this->kegiatan->where('tanggal >', $dtawal)->where('tanggal <', $dtahir)->orderBy("tanggal", "DESC")->findAll();
				} else {
					$data['kegiatans'] =  $this->kegiatan->orderBy("tanggal", "DESC")->findAll();
				}

			}elseif(@$segments[2] == "umum"){
				$data['subnav'] = "umum";
				$data['pgtitle'] = "Kegiatan Umum";
				$data['pgdesc'] = "Data kegiatan yang bersifat umum";
				if(@$data['dtawal']){
					$data['kegiatans'] =  $this->kegiatan->where('tanggal >', $dtawal)->where('tanggal <', $dtahir)->orderBy("tanggal", "DESC")->where('jenis', 'umum')->findAll();
				} else {
					$data['kegiatans'] =  $this->kegiatan->orderBy("tanggal", "DESC")->where('jenis', 'umum')->findAll();
				}

			}elseif(@$segments[2] == "internal"){
				$data['subnav'] = "internal";
				$data['pgtitle'] = "Kegiatan Internal UKM IK";
				$data['pgdesc'] = "Data kegiatan yang bersifat internal";
				if(@$data['dtawal']){
					$data['kegiatans'] =  $this->kegiatan->where('tanggal >', $dtawal)->where('tanggal <', $dtahir)->orderBy("tanggal", "DESC")->where('jenis', 'internal')->findAll();
				} else {
					$data['kegiatans'] =  $this->kegiatan->orderBy("tanggal", "DESC")->where('jenis', 'internal')->findAll();
				}

			}elseif(@$segments[2] == "master"){
				$data['subnav'] = "master";
				$data['title'] = "Master Kegiatan";
				$data['pgtitle'] = "Data Semua Kegiatan";
				$data['pgdesc'] = "Seluruh kegiatan UKM Informatika dan Komputer";
				$data['kegiatans'] =  $this->kegiatan->orderBy("tanggal", "DESC")->findAll();

				return view('kegiatan/master-index',$data);
				die();
			}else{
				return redirect()->back()->with('msg', [0,lang("Error.halamanTidakLengkap")]);
				die();
			}
		}else{
				$data['subnav'] = "semua";
				$data['pgtitle'] = "Data Semua Kegiatan";
				$data['kegiatans'] =  $this->kegiatan->findAll();
		}
		
		return view('kegiatan/index',$data);
	}

	public function detail($id)
	{
		$id = decrypt_url($id);
		$URI = service('uri');
		$segments = $URI->getSegments();

		$this->breadcrumb->add('Home', site_url('home/dashboard'));
		$this->breadcrumb->add('Kegiatan', site_url('home/kegiatan'));
		$this->breadcrumb->add('Detail', '/');

		$data = [
				'title' => "Kegiatan",
				'pgtitle' => "Detail Kegiatan",
				'pgdesc' => "Mulai dari kebutuhan Kegiatan, Peserta, Berkas dan masih banyak lagi",
		];

		$data['subnav'] = 'umum';

		$data['kegiatan'] =  $this->kegiatan->where('id', $id)->find();
		if(count($data['kegiatan']) == 0){
			$data['kegiatan'] = [];
		}else{
			$data['kegiatan'] = $data['kegiatan'][0];
			if($data['kegiatan']['jenis'] == 'internal'){
				$data['subnav'] = 'internal';
			}
		}

		$list_panitia = $this->panitia->getByKegiatan($id);
		$list_berkas = $this->berkas->getByKegiatan($id);
		$list_peserta = $this->peserta->getByKegiatan($id);
		$list_tugas = $this->tugas->getByKegiatan($id);

		$data['list_panitia'] = $list_panitia;
		$data['list_berkas'] = $list_berkas;
		$data['list_peserta'] = $list_peserta;
		$data['list_tugas'] = $list_tugas;

		$data['total_panitia'] = count($list_panitia);
		$data['total_peserta'] = count($list_peserta);

		$data['breadcrumbs'] = $this->breadcrumb->render();
		$data['id'] = $id;
		
		return view('kegiatan/detail',$data);
	}

	public function modalTambahTugas()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$data = [
				'id' => $id,
			];
			$msg = [
				'data' => view('kegiatan/modal-tambahtugas', $data)
			];
			echo json_encode($msg);
		}
	}

	public function aksiTambahTugas()
	{
		if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
			if(!punyaAksesKegiatan(session()->user_id, $this->request->getPost('kegiatan'))){
				return false;
				die();
			}
		}

		if ($this->request->getPost())
		{
			$deadline = strtotime($this->request->getPost('deadline'));
			$additionalData = [
				'kegiatan' 	=> $this->request->getPost('kegiatan'),
				'tugas' 	  => $this->request->getPost('tugas'),
				'deadline'  => $deadline,
				'status'		=> 0
			];
			$lastid = $this->tugas->simpan($additionalData);
			if($lastid){
				$resp = $this->log("insert",$lastid,"tugas");
				$this->report_to_admin("add_tugas", $resp, 'kegiatan', $this->request->getPost('kegiatan'), $this->request->getPost('tugas'));
				$this->report_to_panitia("add_tugas", $resp, 'kegiatan', $this->request->getPost('kegiatan'));
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [1,"Berhasil Menambahkan Panitia"]);
			}else{
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [0,'gagal Menambahkan Panitia']);
			}
		}
	}

	public function modalEditTugas()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$tugas = $this->tugas->find($id);
			if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
				if(!punyaAksesKegiatan(session()->user_id, $tugas['kegiatan'])){
					return false;
					die();
				}
			}
			$data = [
				'id' => $id,
				'kegiatan' => $tugas['kegiatan'],
				'ftugas' => $tugas['tugas'],
				'fdeadline' => date("Y-m-d", $tugas['deadline']),
				'fstatus' => $tugas['status'],
			];
			$msg = [
				'data' => view('kegiatan/modal-edittugas', $data)
			];
			echo json_encode($msg);
		}
	}

	public function aksiEditTugas()
	{
		if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
			if(!punyaAksesKegiatan(session()->user_id, $this->request->getPost('kegiatan'))){
				return false;
				die();
			}
		}
		
		if ($this->request->getPost())
		{
			$id = $this->request->getPost('id');
			$deadline = strtotime($this->request->getPost('deadline'));
			$additionalData = [
				'kegiatan' 	=> $this->request->getPost('kegiatan'),
				'tugas' 			=> $this->request->getPost('tugas'),
				'deadline'  	=> $deadline,
				'status'		=> $this->request->getPost('status')
			];

			$sebelum = $this->tugas->find($id);
			$update = $this->tugas->update($id, $additionalData);
			$sesudah = $this->tugas->find($id);

			if($update){
				$resp = $this->log("update",$id,"tugas",json_encode($sebelum),json_encode($sesudah));
				$this->report_to_admin("edit_tugas", $resp, 'kegiatan', $this->request->getPost('kegiatan'));
				$this->report_to_panitia("edit_tugas", $resp, 'kegiatan', $this->request->getPost('kegiatan'));
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [1,"Berhasil Mengubah Tugas"]);
			}else{
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [0,'gagal Mengubah Tugas']);
			}
		}
	}

	public function aksiHapusTugas($id, $url)
	{	
		$id = decrypt_url($id);
		if(!empty($id)){
			$url_redirect = site_url('home/kegiatan/detail/'.$url);
			$keg_id = $this->tugas->find($id);

			if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
				if(!punyaAksesKegiatan(session()->user_id, $keg_id['kegiatan'])){
					return false;
					die();
				}
			}

			$status = $this->tugas->delete($id);
			if($status){
				$resp = $this->log("delete",$id,"tugas");
				$this->report_to_admin("delete_tugas", $resp, 'kegiatan', $keg_id['kegiatan']);
				$this->report_to_panitia("delete_tugas", $resp, 'kegiatan', $keg_id['kegiatan']);
				$message = [1, "Berhasil Menghapus Tugas"];
			}else{
				$message = [0, "Gagal Menghapus Tugas"];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0,"Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}

	public function modalTambahPanitia()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$list_penanggungjawab = $this->users->whereIn('role', ['admin', 'anggota'])->findAll();
			$data = [
				'list' => $list_penanggungjawab,
				'id' => $id,
			];
			$msg = [
				'data' => view('kegiatan/modal-tambahpanitia', $data)
			];
			echo json_encode($msg);
		}
	}

	public function aksiTambahPanitia()
	{
		if(!punyaAkses(['admin'])){
			return false;
			die();
		}
		
		if ($this->request->getPost())
		{
			$additionalData = [
				'kegiatan' 	=> $this->request->getPost('kegiatan'),
				'user' 			=> $this->request->getPost('user'),
				'posisi'  	=> $this->request->getPost('posisi'),
			];
			$lastid = $this->panitia->simpan($additionalData);
			if($lastid){
				$resp = $this->log("insert",$lastid,"panitia");
				$this->report_to_admin("add_panitia", $resp, 'kegiatan', $this->request->getPost('kegiatan'));
				$this->report_to_usernya("add_panitia", $this->request->getPost('user'), $resp, 'kegiatan', $this->request->getPost('kegiatan'), $this->request->getPost('posisi'));
				$this->report_to_panitia("add_panitia", $resp, 'kegiatan', $this->request->getPost('kegiatan'), $this->request->getPost('user'), $this->request->getPost('posisi'));
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [1,"Berhasil Menambahkan Panitia"]);
			}else{
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [0,'gagal Menambahkan Panitia']);
			}
		}
	}

	public function aksiHapusPanitia($id, $url)
	{
		if(!punyaAkses(['admin'])){
			return false;
			die();
		}
		
		$id = decrypt_url($id);
		if(!empty($id)){
			$url_redirect = site_url('home/kegiatan/detail/'.$url);
			$keg_id = $this->panitia->find($id);
			$status = $this->panitia->delete($id);
			if($status){
				$resp = $this->log("delete",$id,"panitia");
				$this->report_to_admin("delete_panitia", $resp, 'kegiatan', $keg_id['kegiatan']);
				$this->report_to_usernya("delete_panitia", $keg_id['user'], $resp, 'kegiatan', $keg_id['kegiatan']);
				$message = [1, "Berhasil Menghapus Panitia"];
			} else {
				$message = [0, "Gagal Menghapus Panitia"];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0,"Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}

	public function modalTambahBerkas()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$data = [
				'id' => $id,
			];
			$msg = [
				'data' => view('kegiatan/modal-tambahberkas', $data)
			];
			echo json_encode($msg);
		}
	}

	public function aksiTambahBerkas()
	{
		if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
			if(!punyaAksesKegiatan(session()->user_id, $this->request->getPost('kegiatan'))){
				return false;
				die();
			}
		}
		
		if ($this->request->getPost())
		{
			$berkasName = ""; $size = 0;
			$berkas = $this->request->getFile('berkas');
			if(!empty($berkas->getName())){
				$size = $berkas->getSize(); // Get by bytes 
				$berkasName = $berkas->getRandomName();
				$berkas->move(ROOTPATH . 'public/assets/berkas/kegiatan/', $berkasName);
			}

			$additionalData = [
				'kegiatan' 	=> $this->request->getPost('kegiatan'),
				'nama' 			=> $this->request->getPost('nama'),
				'link'		  => $berkasName,
				'permission'  	=> $this->request->getPost('permission'),
				'size'			=> $size,
				'create_at' => time(),
			];

			$lastid = $this->berkas->simpan($additionalData);
			if($lastid){
				$resp = $this->log("insert",$lastid,"berkas");
				$this->report_to_admin("add_berkas", $resp, 'kegiatan', $this->request->getPost('kegiatan'));
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [1,"Berhasil Menambahkan Berkas"]);
			}else{
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [0,'gagal Menambahkan Berkas']);
			}
		}
	}

	public function modalDetailBerkas()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$list = $this->berkas->getByKegiatan($id);
			$data = [
				'id' => $id,
				'list' => $list,
			];
			$msg = [
				'data' => view('kegiatan/modal-detailberkas', $data)
			];
			echo json_encode($msg);
		}
	}

	public function aksiHapusBerkas($id, $url)
	{
		$id = decrypt_url($id);
		if(!empty($id)){
			$keg_id = $this->berkas->find($id);

			if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
				if(!punyaAksesKegiatan(session()->user_id, $keg_id['kegiatan'])){
					return false;
					die();
				}
			}

			$url_redirect = site_url('home/kegiatan/detail/'.$url);
			unlink("assets/berkas/kegiatan/".$keg_id['link']);
			$status = $this->berkas->delete($id);

			if($status){
				$resp = $this->log("delete",$id,"berkas");
				$this->report_to_admin("delete_berkas", $resp, 'kegiatan', $keg_id['kegiatan']);
				$message = [1, "Berhasil Menghapus Berkas"];
			} else {
				$message = [0, "Gagal Menghapus Berkas"];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0,"Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}

	public function modalTambahPeserta()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$list = $this->users->findAll();
			$data = [
				'id' => $id,
				'list' => $list,
			];
			$msg = [
				'data' => view('kegiatan/modal-tambahpeserta', $data)
			];
			echo json_encode($msg);
		}
	}

	public function aksiTambahPeserta()
	{
		if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
			if(!punyaAksesKegiatan(session()->user_id, $this->request->getPost('kegiatan'))){
				return false;
				die();
			}
		}
		
		if ($this->request->getPost())
		{
			$user = $this->users->find($this->request->getPost('user'));
			if($user['chat_id']){
				$additionalData = [
					'kegiatan' 	=> $this->request->getPost('kegiatan'),
					'user' 			=> $this->request->getPost('user'),
					'tgl_daftar'  	=> time(),
					'hadir' 		=> 0
				];
				$lastid = $this->peserta->simpan($additionalData);
				if($lastid){
					$resp = $this->log("insert",$lastid,"peserta");
					$this->report_to_admin("add_peserta", $resp, 'kegiatan', $this->request->getPost('kegiatan'));
					$this->report_to_usernya("add_peserta", $this->request->getPost('user'), $resp, 'kegiatan', $this->request->getPost('kegiatan'));
					return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [1,"Berhasil Menambahkan Peserta"]);
				}else{
					return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [0,'gagal Menambahkan Peserta']);
				}
			} else {
				return redirect()->back()->with('msg', [0,'Akun tersebut belum tertaut dengan telegram']);
			}
		}
	}

	public function aksiGabung()
	{
		$user = $this->users->find($this->request->getPost('user'));
		if($user['chat_id']){
			$additionalData = [
				'kegiatan' 	=> $this->request->getPost('kegiatan'),
				'user' 			=> $this->request->getPost('user'),
				'tgl_daftar' => time(),
				'hadir' 		=> 0
			];
			$lastid = $this->peserta->simpan($additionalData);
			if($lastid){
				$resp = $this->log("insert",$lastid,"peserta");
				$this->report_to_admin("add_peserta", $resp, 'kegiatan', $this->request->getPost('kegiatan'));
				$this->report_to_usernya("add_peserta", $this->request->getPost('user'), $resp, 'kegiatan', $this->request->getPost('kegiatan'));
				return redirect()->back()->with('msg', [1,"Berhasil Bergabung"]);
			}else{
				return redirect()->back()->with('msg', [0,'Gagal Bergabung']);
			}
		} else {
			return redirect()->back()->with('msg', [0,'Akun anda belum tertaut dengan telegram']);
		}
	}

	public function aksiHadirPeserta($id, $url)
	{
		$id = decrypt_url($id);
		$url_redirect = site_url('home/kegiatan/detail/'.$url);
		if(!empty($id)){
			$additionalData = [
				'hadir' 		=> 1
			];
			$ambilnya = $this->peserta->find($id);
			if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
				if(!punyaAksesKegiatan(session()->user_id, $ambilnya['kegiatan'])){
					return false;
					die();
				}
			}
			
			$lastid = $this->peserta->update($id, $additionalData);
			if($lastid){
				$resp = $this->log("update",$lastid,"peserta");
				$this->report_to_admin("hadir_peserta", $resp, 'kegiatan', $ambilnya['kegiatan']);
				return redirect()->to($url_redirect)->with('msg', [1,"Berhasil Mengubah Status Kehadiran Peserta"]);
			}else{
				return redirect()->to($url_redirect)->with('msg', [0,'Gagal Mengubah Status Kehadiran Peserta']);
			}
		}
	}

	public function aksiBatalHadirPeserta($id, $url)
	{
		$id = decrypt_url($id);
		$url_redirect = site_url('home/kegiatan/detail/'.$url);
		if(!empty($id)){
			$additionalData = [
				'hadir' 		=> 0
			];
			$ambilnya = $this->peserta->find($id);
			if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
				if(!punyaAksesKegiatan(session()->user_id, $ambilnya['kegiatan'])){
					return false;
					die();
				}
			}
			
			$lastid = $this->peserta->update($id, $additionalData);
			if($lastid){
				$resp = $this->log("update",$lastid,"peserta");
				$this->report_to_admin("batal_hadir_peserta", $resp, 'kegiatan', $ambilnya['kegiatan']);
				return redirect()->to($url_redirect)->with('msg', [1,"Berhasil Mengubah Status Kehadiran Peserta"]);
			}else{
				return redirect()->to($url_redirect)->with('msg', [0,'Gagal Mengubah Status Kehadiran Peserta']);
			}
		}
	}

	public function aksiHapusPeserta($id, $url)
	{
		if(!punyaAkses(['admin', 'pengawas', 'pengurus'])){
			if(!punyaAksesKegiatan(session()->user_id, $this->request->getPost('kegiatan'))){
				return false;
				die();
			}
		}
		
		$id = decrypt_url($id);
		if(!empty($id)){
			$url_redirect = site_url('home/kegiatan/detail/'.$url);
			$keg_id = $this->peserta->find($id);
			$status = $this->peserta->delete($id);
			if($status){
				$resp = $this->log("delete",$id,"peserta");
				$this->report_to_admin("delete_peserta", $resp, 'kegiatan', $keg_id['kegiatan']);
				$this->report_to_usernya("delete_peserta", $keg_id['user'], $resp, 'kegiatan', $keg_id['kegiatan']);
				$message = [1, "Berhasil Menghapus Peserta"];
			}else{
				$message = [0, "Gagal Menghapus Peserta"];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0,"Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}

	public function modalGabung()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$data = [
				'id' => $id,
			];
			$msg = [
				'data' => view('kegiatan/modal-gabung', $data)
			];
			echo json_encode($msg);
		}
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
				'title' => "Kegiatan",
				'pgdesc' => "Formulir untuk membuat kegiatan baru",
		];
		if(@$segments[2]){
			if(@$segments[2] == "semua"){
				$url_redirect = site_url('home/kegiatan/semua');
				$data['subnav'] = "semua";
				$data['pgtitle'] = "Tambah Kegiatan";

			}elseif(@$segments[2] == "umum"){
				$url_redirect = site_url('home/kegiatan/umum');
				$data['subnav'] = "umum";
				$data['pgtitle'] = "Tambah Kegiatan";

			}elseif(@$segments[2] == "internal"){
				$url_redirect = site_url('home/kegiatan/internal');
				$data['subnav'] = "internal";
				$data['pgtitle'] = "Tambah Kegiatan Internal";

			}elseif(@$segments[2] == "master"){
				$url_redirect = site_url('home/kegiatan/master');
				$data['subnav'] = "master";
				$data['title'] = "Master Kegiatan";
				$data['pgtitle'] = "Tambah Kegiatan";
			}else{
				return redirect()->back()->with('msg', [0,lang("Error.halamanTidakLengkap")]);
				die();
			}
		}else{
				$url_redirect = site_url('home/kegiatan/semua');
				$data['subnav'] = "semua";
				$data['pgtitle'] = "Tambah Kegiatan";
		}

		// validate form input
		$this->validation->setRules([
        'nama' 						=> 'trim|required',
        'tanggal' 				=> 'required',
        'lokasi' 					=> 'trim|required',
        'penanggungjawab' => 'required|is_not_unique[users.id]',
        'jenis' 					=> 'required',
    ],
    [   // Errors
        'penanggungjawab' => [
            'is_not_unique'   => 'Penanggungjawab tidak ada didalam daftar pengurus',
        ],
    ]);
		
		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run())
		{
			$tanggal = strtotime($this->request->getPost('tanggal'));

			$photo = $this->request->getFile('banner'); $newimg = null;

			if(!empty($photo->getName())){
				$newimg = $photo->getRandomName();
				$photo->move(ROOTPATH . 'public/assets/images/banner-kegiatan/', $newimg);
			}
			
			$additionalData = [
					'nama' 						=> $this->request->getPost('nama'),
					'tanggal' 				=> $tanggal,
					'lokasi' 					=> $this->request->getPost('lokasi'),
					'penanggungjawab' => $this->request->getPost('penanggungjawab'),
					'deskripsi' 			=> $this->request->getPost('deskripsi'),
					'banner' 					=> $this->request->getPost('banner'),
					'cp1' 						=> $this->request->getPost('cp1'),
				  'link1' 					=> $this->request->getPost('link1'),
					'jenis' 					=> $this->request->getPost('jenis'),
					'banner'		 			=> $newimg,
					'create_at'				=> time(),
				];
				$lastid = $this->kegiatan->simpan($additionalData);
				if($lastid){
					$resp = $this->log("insert",$lastid,"kegiatan");
					$this->report_to_admin("add_kegiatan", $resp, 'kegiatan', $lastid);
					$this->report_to_allusers("add_kegiatan", $resp, 'kegiatan', $lastid);
					return redirect()->to($url_redirect)->with('msg', [1, lang('LangKegiatan.tambahBerhasil')]);
				}else{
					return redirect()->to($url_redirect)->with('msg', [0, lang('LangKegiatan.tambahGagal')]);
				}

		}else{

			$data['errors'] = $this->validation->getErrors();
			$data['list_penanggungjawab'] = $this->users->where('role','admin')->findAll();

			$data['nama'] = [
				'name'  => 'nama',
				'label' => 'Nama Kegiatan',
				'placeholder' => 'Nama Kegiatan',
				'value' => set_value('nama'),
			];

			$data['lokasi'] = [
				'name'  => 'lokasi',
				'label'    => 'Lokasi Kegiatan',
				'placeholder' => 'Lokasi Kegiatan',
				'value' => set_value('lokasi'),
			];

			$data['tanggal'] = [
				'name'  => 'tanggal',
				'label'    => 'Tanggal Pelaksanaan',
				'placeholder' => 'Tanggal Pelaksanaan',
				'value' => set_value('tanggal'),
			];

			$data['deskripsi'] = [
				'name'  => 'deskripsi',
				'label'    => 'Deskripsi Kegiatan',
				'placeholder' => 'Deskripsi Kegiatan',
				'value' => set_value('deskripsi'),
			];

			$data['penanggungjawab'] = [
				'name'  => 'penanggungjawab',
				'label'    => 'Penanggungjawab',
				'value' => set_value('penanggungjawab'),
			];

			$data['cp1'] = [
				'name'  => 'cp1',
				'label'    => 'Kontak Person',
				'placeholder' => '08xxxx',
				'value' => set_value('cp1'),
			];

			$data['link1'] = [
				'name'  => 'link1',
				'label'    => 'Halaman Informasi',
				'placeholder' => 'https://ukmik.org/xxxx',
				'value' => set_value('link1'),
			];

			$data['jenis'] = [
				'name'  => 'jenis',
				'label'    => 'Jenis Kegiatan',
				'value' => set_value('jenis'),
			];

			$data['banner'] = [
				'name'  => 'banner',
				'label'    => 'Gambar Banner',
				'value' => set_value('banner'),
			];

			return view('kegiatan/tambah',$data);
		}
	}

	public function update($id)
	{
		if(!punyaAkses(['admin'])){
			return redirect()->back()->with('msg', [0,lang("Error.tidakMemilikiAksesKehalamanTsb")]);
			die();
		}

		$id = decrypt_url($id);
		$URI = service('uri');
		$segments = $URI->getSegments();

		$datakegiatans = $this->kegiatan->find($id);

		$this->breadcrumb->add('Home', site_url('home/dashboard'));
		$this->breadcrumb->add('Kegiatan', site_url('home/kegiatan'));  

		$data = [
				'title' => "Kegiatan",
				'pgdesc' => "Formulir mengubah data kegiatan",
		];

		if($segments[2] == "semua"){
			$url_redirect = site_url('home/kegiatan/semua');
			$data['subnav'] = "semua";
			$data['pgtitle'] = "Ubah Kegiatan";
			$this->breadcrumb->add('Semua', $url_redirect);  

		}elseif($segments[2] == "umum"){
			$url_redirect = site_url('home/kegiatan/umum');
			$data['subnav'] = "umum";
			$data['pgtitle'] = "Ubah Kegiatan";
			$this->breadcrumb->add('Umum', $url_redirect);  

		}elseif($segments[2] == "internal"){
			$url_redirect = site_url('home/kegiatan/internal');
			$data['subnav'] = "internal";
			$data['pgtitle'] = "Ubah Kegiatan Internal";
			$this->breadcrumb->add('Internal', $url_redirect);  

		}elseif(@$segments[2] == "master"){
				$url_redirect = site_url('home/kegiatan/master');
				$data['subnav'] = "master";
				$data['title'] = "Master Kegiatan";
				$data['pgtitle'] = "Ubah Kegiatan";

		}elseif(@$segments[2] == "detail"){
				$url_redirect = site_url('home/kegiatan/detail/'.\encrypt_url($id));
				$data['subnav'] = "umum";
				if($datakegiatans['jenis'] == 'internal'){
					$data['subnav'] = 'internal';
				}
				$data['title'] = "Kegiatan";
				$data['pgtitle'] = "Ubah Kegiatan";
				$data['id'] = $id;

		}else{
			return redirect()->back()->with('msg', [0,lang("Error.halamanTidakLengkap")]);
			die();
		}

		$this->breadcrumb->add('Ubah', '/');

		// validate form input
		$this->validation->setRules([
        'nama' 						=> 'trim|required',
        'tanggal' 				=> 'required',
        'lokasi' 					=> 'trim|required',
        'penanggungjawab' => 'required|is_not_unique[users.id]',
        'jenis' 					=> 'required',
    ],
    [   // Errors
        'penanggungjawab' => [
            'is_not_unique'   => 'Penanggungjawab tidak ada didalam daftar pengurus',
        ],
    ]);

		if($this->request->getFile('photo')){
					$this->validation->setRule('photo', "Photo", 'mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]|max_size[photo,1024]');
				}

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run())
		{
			$tanggal = strtotime($this->request->getPost('tanggal'));

			$imglama = $this->request->getPost('imglama');
			$photo = $this->request->getFile('banner');

			if(!empty($photo->getName())){
				$newimg = $photo->getRandomName();
				$photo->move(ROOTPATH . 'public/assets/images/banner-kegiatan/', $newimg);
				if($imglama!=null||$imglama!=""){
					$filePath = ROOTPATH . 'public/assets/images/banner-kegiatan/'. $imglama;
					if(is_writable($filePath)){
						$deleted = unlink($filePath);
					}
				}
				$imglama = $newimg;
			}

			$additionalData = [
					'nama' 						=> $this->request->getPost('nama'),
					'tanggal' 				=> $tanggal,
					'lokasi' 					=> $this->request->getPost('lokasi'),
					'penanggungjawab' => $this->request->getPost('penanggungjawab'),
					'deskripsi' 			=> $this->request->getPost('deskripsi'),
					'banner' 					=> $this->request->getPost('banner'),
					'cp1' 						=> $this->request->getPost('cp1'),
				  'link1' 					=> $this->request->getPost('link1'),
					'jenis' 					=> $this->request->getPost('jenis'),
					'banner'		 			=> $imglama,
				];
			
			$sebelum = $this->kegiatan->find($id);
			$lastid = $this->kegiatan->update($id, $additionalData);
			$sesudah = $this->kegiatan->find($id);

			if($lastid){
				$resp = $this->log("update",$id,"kegiatan",json_encode($sebelum),json_encode($sesudah));
				$this->report_to_admin("edit_kegiatan", $resp, 'kegiatan', $id);
				return redirect()->to($url_redirect)->with('msg', [1, lang('LangKegiatan.ubahBerhasil')]);
			}else{
				return redirect()->to($url_redirect)->with('msg', [0, lang('LangKegiatan.ubahGagal')]);
			}
		}else{

			$data['breadcrumbs'] = $this->breadcrumb->render();
			$data['errors'] = $this->validation->getErrors();
			$data['banner'] = $datakegiatans['banner'];

			$data['list_penanggungjawab'] = $this->users->where('role', 'admin')->findAll();

			$data['nama'] = [
				'name'  => 'nama',
				'label' => 'Nama Kegiatan',
				'placeholder' => 'Nama Kegiatan',
				'value' => set_value('nama', $datakegiatans['nama']),
			];

			$data['lokasi'] = [
				'name'  => 'lokasi',
				'label'    => 'Lokasi Kegiatan',
				'placeholder' => 'Lokasi Kegiatan',
				'value' => set_value('lokasi', $datakegiatans['lokasi']),
			];

			$data['tanggal'] = [
				'name'  => 'tanggal',
				'label'    => 'Tanggal Pelaksanaan',
				'placeholder' => 'Tanggal Pelaksanaan',
				'value' => set_value('tanggal', date("Y-m-d H:i:s", $datakegiatans['tanggal'])),
			];

			$data['deskripsi'] = [
				'name'  => 'deskripsi',
				'label'    => 'Deskripsi Kegiatan',
				'placeholder' => 'Deskripsi Kegiatan',
				'value' => set_value('deskripsi', $datakegiatans['deskripsi']),
			];

			$data['penanggungjawab'] = [
				'name'  => 'penanggungjawab',
				'label'    => 'Penanggungjawab',
				'value' => set_value('penanggungjawab', $datakegiatans['penanggungjawab']),
			];

			$data['cp1'] = [
				'name'  => 'cp1',
				'label'    => 'Kontak Person',
				'placeholder' => '08xxxx',
				'value' => set_value('cp1', $datakegiatans['cp1']),
			];

			$data['link1'] = [
				'name'  => 'link1',
				'label'    => 'Halaman Informasi',
				'placeholder' => 'https://ukmik.org/xxxx',
				'value' => set_value('link1', $datakegiatans['link1']),
			];

			$data['jenis'] = [
				'name'  => 'jenis',
				'label'    => 'Jenis Kegiatan',
				'value' => set_value('jenis', $datakegiatans['jenis']),
			];

			$data['banner'] = [
				'name'  => 'banner',
				'label'    => 'Gambar Banner',
				'value' => set_value('banner', $datakegiatans['banner']),
			];

			return view('kegiatan/ubah',$data);
		}
	}

	public function delete(int $id)
	{
		if(!punyaAkses(['admin'])){
			return redirect()->back()->with('msg', [0,lang("Error.tidakMemilikiAksesKehalamanTsb")]);
			die();
		}

		if(!empty($id)){
			$URI = service('uri');
			$segments = $URI->getSegments();

			if($segments[2] == "master"){
				$url_redirect = site_url('home/kegiatan/master');
			}else{
				return redirect()->back()->with('msg', [0,lang("Error.halamanTidakLengkap")]);
				die();
			}

			$data = [
				'delete_at' => time(),
			];

			$status = $this->kegiatan->update($id,$data);
			if($status){
				$resp = $this->log("delete", $id, "kegiatan");
				$this->report_to_admin("delete_kegiatan", $resp, 'kegiatan', $id);
				$message = [1, lang("LangKegiatan.hapusBerhasil")];
			} else {
				$message = [0, lang("LangKegiatan.hapusGagal")];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0, lang("Error.parameterHilang")]);
		}
	}
}
