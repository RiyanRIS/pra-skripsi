<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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

		if(@$segments[2]){
			if(@$segments[2] == "semua"){
				$data['subnav'] = "semua";
				$data['pgtitle'] = "Data Semua Kegiatan";
				$data['pgdesc'] = "Seluruh kegiatan UKM Informatika dan Komputer";
				$data['kegiatans'] =  $this->kegiatan->findAll();

			}elseif(@$segments[2] == "umum"){
				$data['subnav'] = "umum";
				$data['pgtitle'] = "Kegiatan Umum";
				$data['pgdesc'] = "Data kegiatan yang bersifat umum";
				$data['kegiatans'] =  $this->kegiatan->where('jenis', 'umum')->findAll();

			}elseif(@$segments[2] == "internal"){
				$data['subnav'] = "internal";
				$data['pgtitle'] = "Kegiatan Internal UKM IK";
				$data['pgdesc'] = "Data kegiatan yang bersifat internal (khusus anggota dan pengurus)";
				$data['kegiatans'] =  $this->kegiatan->where('jenis', 'internal')->orWhere('jenis', 'pengurus')->findAll();

			}elseif(@$segments[2] == "master"){
				$data['subnav'] = "master";
				$data['title'] = "Master Kegiatan";
				$data['pgtitle'] = "Data Semua Kegiatan";
				$data['pgdesc'] = "Seluruh kegiatan UKM Informatika dan Komputer";
				$data['kegiatans'] =  $this->kegiatan->findAll();

				return view('kegiatan/master-index',$data);

			}else{
				echo "Akses dilarang."; die();
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

		$data['list_panitia'] = $this->panitia->getByKegiatan($id);
		$data['list_berkas'] = $this->berkas->getByKegiatan($id);

		$data['breadcrumbs'] = $this->breadcrumb->render();
		$data['id'] = $id;
		
		return view('kegiatan/detail',$data);
	}

	public function modalTambahPanitia()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$list_penanggungjawab = $this->users->where('role','pengurus')->findAll();
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
		if ($this->request->getPost())
		{
			$additionalData = [
				'kegiatan' 	=> $this->request->getPost('kegiatan'),
				'user' 			=> $this->request->getPost('user'),
				'posisi'  	=> $this->request->getPost('posisi'),
			];
			$lastid = $this->panitia->simpan($additionalData);
			if($lastid){
				$this->log("insert",$lastid,"panitia");
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [1,"Berhasil Menambahkan Panitia"]);
			}else{
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [0,lang('gagal Menambahkan Panitia')]);
			}
		}
	}

	public function aksiHapusPanitia($id, $url)
	{
		$id = decrypt_url($id);
		if(!empty($id)){
			$url_redirect = site_url('home/kegiatan/detail/'.$url);

			$status = $this->panitia->delete($id);
			if($status){
				$this->log("delete",$id,"panitia");
				$message = [1, "Berhasil Menghapus Panitia"];
			}else{
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
				$this->log("insert",$lastid,"berkas");
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [1,"Berhasil Menambahkan Berkas"]);
			}else{
				return redirect()->to(site_url('home/kegiatan/detail/'.\encrypt_url($this->request->getPost('kegiatan'))))->with('msg', [0,lang('gagal Menambahkan Berkas')]);
			}
		}
	}

	public function aksiHapusBerkas($id, $url)
	{
		$id = decrypt_url($id);
		if(!empty($id)){
			$url_redirect = site_url('home/kegiatan/detail/'.$url);

			$status = $this->panitia->delete($id);
			if($status){
				$this->log("delete",$id,"panitia");
				$message = [1, "Berhasil Menghapus Panitia"];
			}else{
				$message = [0, "Gagal Menghapus Panitia"];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0,"Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}

	public function add()
	{
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
				echo "Akses dilarang."; die();
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
					$this->log("insert",$lastid,"kegiatan");
					return redirect()->to($url_redirect)->with('msg', [1,"Berhasil Membuat Kegiatan"]);
				}else{
					return redirect()->to($url_redirect)->with('msg', [0,lang('gagal Menambahkan Kegiatan')]);
				}

		}else{

			$data['errors'] = $this->validation->getErrors();
			$data['list_penanggungjawab'] = $this->users->where('role','pengurus')->findAll();

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

		}else{
			echo "Akses dilarang."; die();
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
				$this->log("update",$id,"kegiatan",json_encode($sebelum),json_encode($sesudah));
				return redirect()->to($url_redirect)->with('msg', [1,"Berhasil Mengubah Kegiatan"]);
			}else{
				return redirect()->to($url_redirect)->with('msg', [0,"Gagal Mengubah Kegiatan"]);
			}
		}else{

			$data['breadcrumbs'] = $this->breadcrumb->render();
			$data['errors'] = $this->validation->getErrors();
			$data['banner'] = $datakegiatans['banner'];

			$data['list_penanggungjawab'] = $this->users->where('role','pengurus')->findAll();

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
		if(!empty($id)){
			$URI = service('uri');
			$segments = $URI->getSegments();

			if($segments[1] == "pengguna"){
				$url_redirect = site_url('home/pengguna');
			}elseif($segments[1] == "pengurus"){
				$url_redirect = site_url('home/pengurus');
			}elseif($segments[1] == "peserta"){
				$url_redirect = site_url('home/peserta');
			}elseif($segments[1] == "master"){
				$url_redirect = site_url('home/master');
			}else{
				echo "Akses dilarang."; die();
			}

			$data = [
				'delete_at' => time(),
			];
			$status = $this->users->update($id,$data);
			if($status){
				$this->log("delete",$id,"users");
				$message = [1, "Berhasil Menghapus Pengguna"];
			}else{
				$message = [0, "Gagal Menghapus Pengguna"];
			}
			return redirect()->to($url_redirect)->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0,"Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}
}
