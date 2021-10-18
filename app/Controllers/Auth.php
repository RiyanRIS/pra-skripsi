<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function login(){
		if(session()->islogin){
			return redirect()->to(site_url("home"));
		}

		if($this->auth->cekCookie(get_cookie('sim_ketika_riyanpunya_cok'))){
			return redirect()->to(site_url('home'));
		}
          
		$username = '';

		$this->validation->setRule('username', "Username", 'required');
		$this->validation->setRule('password', "Password", 'required');
		if($this->request->getPost() && $this->validation->withRequest($this->request)->run()){
			$username =  (String)$this->request->getVar('username');
			$password =  (String)$this->request->getVar('password');
			$remember =  (bool)$this->request->getVar('ingatsaya');

			if($this->auth->login($username, $password, $remember)){
				return redirect()->to(site_url("home/dashboard"))->with('msg', [1, "Berhasil masuk"]);
			} else {
				$ses = [0, "Kombinasi username dan password masih belum tepat."];
				session()->set(['msg' => $ses]);
			}
		}
		$data = [
			'err' => $this->validation->getErrors(),
			'username' => (@$username ?: '')
		];
		return view("auth/login", $data);
	}

	public function cekLoginWithCook(String $val):mixed
	{
		
	}

	public function daftar()
	{
		return view("auth/daftar");
	}

	public function lupaPassword()
	{
		return view("auth/lupapassword");
	}

	public function logout(){
		$this->auth->logout(session()->user_id);
		return redirect()->to(site_url('auth'))->with('msg', [1, "Berhasil keluar"]);
	}
}
