<?php
namespace App\Controllers;


class Home extends BaseController
{

	public function __construct()
	{
	}

	public function index(){
		// return redirect()->to(site_url('/home/artikel'))->with('msg', [1,lang('Msg.berhasil_menambah_artikel')]);
		return redirect()->to(site_url('/home/dashboard'));
	}

	public function dashboard()
	{
		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Dashboard",
			'pgtitle' => "Halaman Dashboard",
		];
		return view('home',$data);
	}
}
