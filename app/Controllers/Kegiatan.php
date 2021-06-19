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

	public function update(int $id)
	{
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

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run())
		{
			$tanggal = strtotime($this->request->getPost('tanggal'));

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
			$data['id'] = $id;

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
				'value' => set_value('lokasi', $datakegiatans['nama']),
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

	public function delete(int $id){
		if(!empty($id)){
			$URI = service('uri');
			$segments = $URI->getSegments();

			if($segments[1] == "pengguna"){
				$url_redirect = site_url('home/pengguna');
			}elseif($segments[1] == "pengurus"){
				$url_redirect = site_url('home/pengurus');
			}elseif($segments[1] == "peserta"){
				$url_redirect = site_url('home/peserta');
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
