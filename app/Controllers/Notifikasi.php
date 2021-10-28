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

	function kegpanOn(){
		$data = [
			'keg_pan' => 1
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}

	function kegpanOff(){
		$data = [
			'keg_pan' => 0
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}

	function kegtugOn(){
		$data = [
			'keg_tug' => 1
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}

	function kegtugOff(){
		$data = [
			'keg_tug' => 0
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}

	function kegberOn(){
		$data = [
			'keg_ber' => 1
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}

	function kegberOff(){
		$data = [
			'keg_ber' => 0
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}

	function kegpesOn(){
		$data = [
			'keg_pes' => 1
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
	}

	function kegpesOff(){
		$data = [
			'keg_pes' => 0
		];
		return $this->setting_notif->updateByUser(session()->user_id, $data);
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
