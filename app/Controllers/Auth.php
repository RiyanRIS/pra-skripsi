<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function index(){
		return redirect()->to(site_url('auth'));
	}	

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
				$data_user = $this->users->getByUsername($username);
				if($this->setting_notif->loginNotifBool($data_user->id)){
					$this->notifLogin($data_user);
				}
				return redirect()->to(site_url("home/dashboard"))->with('msg', [1, lang('Auth.msgBerhasilMasuk')]);
			} else {
				$ses = [0, lang('Auth.msgGagalMasuk')];
				session()->setFlashdata(['msg' => $ses]);
			}
		}
		$data = [
			'err' => $this->validation->getErrors(),
			'username' => (@$username ?: '')
		];
		return view("auth/login", $data);
	}

	function notifLogin($data_user){
		$chat_id = $data_user->chat_id;
		$user_id = $data_user->id;
		if($chat_id == null){
			return false;
		}
		$msg = lang('Auth.notiftele', ["admin" => "https://t.me/kodokkayang"]);
		$bot_token = env("BOT_TOKEN_TELE");
		$bot = new \Telegram($bot_token);
		$content = ['chat_id' => $chat_id, 'text' => $msg, 'parse_mode' => 'HTML'];
		$this->simpan_chat($msg, $user_id);
		$bot->sendMessage($content);
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
		return redirect()->to(site_url('auth'))->with('msg', [1, lang("Auth.msgBerhasilKeluar")]);
	}
}
