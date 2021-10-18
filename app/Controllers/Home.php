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
		$data = $this->users->find(session()->user_id);
		if($data['remember_selector'] != null){
			set_cookie([
				'name'   => 'sim_ketika_riyanpunya_cok',
				'value'  => $data['remember_selector'],
				'expire' => time() + (3600 * 24 * 2) // 2 hari
			]);
		}
		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Dashboard",
			'nav' => "Dashboard",
			'pgtitle' => "Halaman Dashboard",
		];
		return view('home',$data);
	}
}
