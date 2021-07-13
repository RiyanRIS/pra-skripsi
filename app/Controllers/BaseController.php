<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use \App\Libraries\Breadcrumb;

use \App\Models\UsersModel;
use \App\Models\KegiatanModel;
use \App\Models\PanitiaModel;
use \App\Models\BerkasModel;
use \App\Models\PesertaModel;
use \App\Models\TugasModel;
use \App\Models\LogModel;

class BaseController extends Controller
{
	protected $request;
	protected $helpers = [];

	protected $session;
	protected $validation;
	protected $validationListTemplate = 'list';

	public $breadcrumb;

	protected $users;
	protected $kegiatan;
	protected $panitia;
	protected $berkas;
	protected $peserta;
	protected $tugas;
	protected $log;

	public $data = [];

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		helper(['form', 'url', 'ini_helper']);

		$this->session        = \Config\Services::session();
		$this->validation 		= \Config\Services::validation();

		$this->breadcrumb 		= new Breadcrumb();

		$this->users = new UsersModel();
		$this->kegiatan = new KegiatanModel();
		$this->panitia = new PanitiaModel();
		$this->berkas = new BerkasModel();
		$this->peserta = new PesertaModel();
		$this->tugas = new TugasModel();
		$this->log = new LogModel();

	}

	public function log(String $ket, int $kunci = null, String $tabel = null, String $sebelum = null, String $sesudah = null, int $users = 0){
		// $users = $users ?: $this->session->get('user_id');
		$users = 1;
		$data = [
			"users" => $users,
			"keterangan" => $ket,
			"asal" => uri_string(),
			"kunci" => $kunci,
			"nama_tabel" => $tabel,
			"sebelum" => $sebelum,
			"sesudah" => $sesudah,
			"time" => time(),
		];
		return $this->log->insert($data);
	}
}
