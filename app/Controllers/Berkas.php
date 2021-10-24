<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Berkas extends BaseController
{
	public function index()
	{
		$data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Berkas Master",
			'nav' => "Berkas",
			'subnav' => "Berkas",
			'pgtitle' => "Halaman Berkas",
			'berkas' => $this->berkas->findAll()
		];
		return view('berkas/index',$data);
	}

	public function delete($id)
	{
		$id = decrypt_url($id);
		if(!empty($id)){
			$keg_id = $this->berkas->find($id);
			unlink("assets/berkas/kegiatan/".$keg_id['link']);
			$status = $this->berkas->delete($id);
			if($status){
				$resp = $this->log("delete",$id,"berkas");
				$this->report_to_admin("delete_berkas", $resp, 'kegiatan', $keg_id['kegiatan']);
				$message = [1, "Berhasil Menghapus Berkas"];
			} else {
				$message = [0, "Gagal Menghapus Berkas"];
			}
			return redirect()->to(site_url("home/berkas"))->with('msg', $message);
		}else{
			return redirect()->back()->with("msg", [0,"Ada parameter yang hilang, harap hubungi pengembang."]);
		}
	}
}
