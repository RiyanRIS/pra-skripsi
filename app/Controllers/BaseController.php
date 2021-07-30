<?php

namespace App\Controllers;

use \App\Models\LogModel;
use \App\Models\ChatModel;
use App\Models\UsersModel;
use \App\Models\CacheModel;
use \App\Models\TugasModel;
use CodeIgniter\Controller;

use \App\Models\BerkasModel;

use Psr\Log\LoggerInterface;
use \App\Models\PanitiaModel;
use \App\Models\PesertaModel;
use \App\Libraries\Breadcrumb;
use \App\Models\KegiatanModel;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

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
	protected $chat;
	protected $cache;

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
		$this->chat = new ChatModel();
		$this->cache = new CacheModel();
	}

	public function log(String $ket, int $kunci = null, String $tabel = null, String $sebelum = null, String $sesudah = null, int $users = 0)
	{
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
