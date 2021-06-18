<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
	public function index()
	{
		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Pengguna",
			'pgtitle' => "Data Pengguna",
			'users' => $this->users->findAll(),
		];
		return view('users/index',$data);
	}

	public function add()
	{
		// validate form input
		$this->validation->setRules([
        'nama' 						=> 'trim|required',
        'username' 				=> 'trim|required|is_unique[users.username]',
        'password' 				=> 'required|min_length[8]|matches[password_confirm]',
        'password_confirm'=> 'required',
    ],
    [   // Errors
        'username' => [
            'is_unique'   => 'Username sudah digunakan.',
        ],
        'password' => [
            'min_length'  => 'Password kamu terlalu pendek.',
            'matches' 	  => 'Konfirmasi password belum tepat.',
        ]
    ]);
		
		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run())
		{
			$additionalData = [
					'nama' 			=> $this->request->getPost('nama'),
					'username'  => $this->request->getPost('username'),
					'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
					'role'      => $this->request->getPost('role'),
					'nohp'		  => $this->request->getPost('nohp'),
					'create_at'	=> time(),
				];
				$lastid = $this->users->simpan($additionalData);
				if($lastid){
					$this->log("insert",$lastid,"users");
					return redirect()->to(site_url('home/pengguna'))->with('msg', [1,"Berhasil Menambahkan Pengguna"]);
				}else{
					return redirect()->to(site_url('home/pengguna'))->with('msg', [0,lang('gagal Menambahkan Pengguna')]);
				}
		}else{

			$data = [
				'breadcrumbs' => $this->breadcrumb->buildAuto(),
				'title' => "Pengguna",
				'pgtitle' => "Tambah Pengguna",
				'errors' => $this->validation->getErrors(),
			];

			$data['nama'] = [
				'name'  => 'nama',
				'label' => 'Nama Lengkap',
				'placeholder' => 'Nama Lengkap',
				'value' => set_value('nama'),
			];

			$data['username'] = [
				'name'  => 'username',
				'label'    => 'Username',
				'placeholder' => 'Username',
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

			return view('users/tambah',$data);
		}
	}

	public function delete(int $id){
		if(!empty($id)){
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
			return redirect()->to(site_url('/home/pengguna'))->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0,"Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}
}
