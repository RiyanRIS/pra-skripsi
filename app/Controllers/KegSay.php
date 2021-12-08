<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KegSay extends BaseController
{
	public function index()
	{
    $data = [
			'breadcrumbs' => $this->breadcrumb->buildAuto(),
			'title' => "Kegiatan Saya",
		];
    $data['subnav'] = "kegsay";
    $data['pgtitle'] = "Kegiatan Saya";
    $data['pgdesc'] = "Seluruh kegiatan yang saya ikuti";

    $data['kegiatans'] =  $this->peserta->getByUser(session()->user_id);

		return view('kegsay/index', $data);
	}
}
