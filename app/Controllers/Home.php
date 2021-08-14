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
		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Dashboard",
			'nav' => "Dashboard",
			'pgtitle' => "Halaman Dashboard",
		];
		return view('home',$data);
	}
}
