<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Notifikasi extends BaseController
{
	public function index()
	{
		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Atur Notifikasi",
			'nav' => "Atur Notifikasi",
			'subnav' => "Notifikasi",
			'pgtitle' => "Atur Notifikasi",
			'setting_notif' => $this->setting_notif->findByUser(session()->user_id)
		];
		return view('notifikasi/index',$data);
	}

	function loginOn(){
		$data = [
			'login' => 1
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}

	function loginOff(){
		$data = [
			'login' => 0
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}
}
