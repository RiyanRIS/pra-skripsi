<?php

namespace App\Controllers;

use \App\Models\AuthModel;
use \App\Models\LogModel;
use \App\Models\ChatModel;
use \App\Models\UsersModel;
use \App\Models\CacheModel;
use \App\Models\TugasModel;
use \App\Models\SettingNotifModel;
use \App\Models\BerkasModel;
use \App\Models\PanitiaModel;
use \App\Models\PesertaModel;
use \App\Models\KegiatanModel;

use \App\Libraries\Breadcrumb;

use Psr\Log\LoggerInterface;

use CodeIgniter\Controller;
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

	protected $auth;
	protected $users;
	protected $kegiatan;
	protected $panitia;
	protected $berkas;
	protected $peserta;
	protected $tugas;
	protected $log;
	protected $chat;
	protected $cache;
	protected $setting_notif;

	public $data = [];

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		helper(['form', 'url', 'cookie' ,'ini_helper']);

		$this->session        = \Config\Services::session();
		$this->validation 		= \Config\Services::validation();

		$this->breadcrumb 		= new Breadcrumb();

		$this->auth = new AuthModel();
		$this->users = new UsersModel();
		$this->kegiatan = new KegiatanModel();
		$this->panitia = new PanitiaModel();
		$this->berkas = new BerkasModel();
		$this->peserta = new PesertaModel();
		$this->tugas = new TugasModel();
		$this->log = new LogModel();
		$this->chat = new ChatModel();
		$this->cache = new CacheModel();
		$this->setting_notif = new SettingNotifModel();
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

	public function report_to_usernya($ket, $user_id, $kunci, $tabel = null, $key = null, $param1 = null){
		
		$user = $this->users->find($user_id);
		$chat_id = $user['chat_id'];
		if($chat_id == null){
			return false;
		}

		$hylink = site_url("log/".encrypt_url($kunci));
		$hylink = "<a href='".$hylink."'>Klik disini untuk detail</a>";
		
		if($tabel == 'kegiatan'){
			$kegiatan = $this->kegiatan->find($key);
			$kegiatan_id = ($kegiatan['id'] ?: 1);
			$kegiatan_nama = ($kegiatan['nama'] ?: '');
		}

		if($ket == "edit_user"){
			$msg = "Detail data kamu baru saja dirubah, jika memang benar kamu melakukan aktivitas ini, abaikan pesan ini.\n\n" + $hylink;
		}

		if($ket == "add_panitia"){
			$msg = "Kamu baru saja dimasukkan kepanitiaan pada kegiatan ${kegiatan_nama} sebagai ${param1}.\n\n" . $hylink;
		}

		if($ket == "delete_panitia"){
			$msg = "Kamu baru saja dihapus/dikeluarkan kepanitiaan pada kegiatan ".$kegiatan_nama.".\n\n" . $hylink;
		}

		if($ket == "add_peserta"){
			$msg = "Kamu baru saja dimasukkan/mendaftar sebagai peserta pada kegiatan ${kegiatan_nama}.\n\n" . $hylink;
		}

		if($ket == "delete_peserta"){
			$msg = "Kamu baru saja dihapus/dikeluarkan sebagai peserta untuk kegiatan ".$kegiatan_nama.".\n\n" . $hylink;
		}

		$bot_token = env("BOT_TOKEN_TELE");
		$bot = new \Telegram($bot_token);
		$content = ['chat_id' => $chat_id, 'text' => $msg, 'parse_mode' => 'HTML'];
		$this->simpan_chat($msg, $user_id);
		$bot->sendMessage($content);
	}

	public function report_to_admin(string $ket, string $kunci, string $tabel = null, string $key = null){
		$msg = '';
		$user_id = (session()->user_id ?: 1);
		$user_nama = (session()->user_nama ?: '');

		if($tabel == 'kegiatan'){
			$kegiatan = $this->kegiatan->find($key);
			$kegiatan_id = ($kegiatan['id'] ?: 1);
			$kegiatan_nama = ($kegiatan['nama'] ?: '');
		}

		$hylink = site_url("log/".encrypt_url($kunci));
		$hylink = "<a href='".$hylink."'>Klik disini untuk detail</a>";

		if($ket == "add_user"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah pengguna pada sistem dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "reg_user_from_tele"){
			$msg = "Seseorang telah mendaftar pada sistem dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "edit_user"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja mengubah pengguna pada sistem dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_user"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus pengguna pada sistem dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "add_kegiatan"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") pada sistem dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "edit_kegiatan"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja mengubah kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") pada sistem dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_kegiatan"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") pada sistem dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "add_tugas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah tugas pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "edit_tugas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja mengubah tugas pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_tugas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus tugas pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "add_panitia"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah panitia pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_panitia"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus panitia pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "add_peserta"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah peserta pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "hadir_peserta"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja mengubah status kehadiran menjadi hadir pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "batal_hadir_peserta"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja mengubah status kehadiran menjadi tidak hadir pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_peserta"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus peserta pada sistem dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "add_berkas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah berkas pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_berkas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus berkas pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}
		
		$getAllAdmin = $this->users->getAllAdmin();
    $chatIdAllAdmin = [];
    foreach($getAllAdmin as $r){
      if($r['chat_id'] != null){
        array_push($chatIdAllAdmin, $r['chat_id']);
      }
    }

		$bot_token = env("BOT_TOKEN_TELE");
		$bot = new \Telegram($bot_token);
		foreach($chatIdAllAdmin as $r){
			$content = ['chat_id' => $r, 'text' => $msg, 'parse_mode' => 'HTML'];
			$this->simpan_chat($msg, $user_id);
			$bot->sendMessage($content);
		}
	}

	public function report_to_panitia(string $ket, string $kunci, string $tabel, string $key, string $param1 = null, string $param2 = null){

		$msg = '';
		$user_id = (session()->user_id ?: 1);
		$user_nama = (session()->user_nama ?: '');

		if($tabel == 'kegiatan'){
			$kegiatan = $this->kegiatan->find($key);
			$kegiatan_id = ($kegiatan['id'] ?: 1);
			$kegiatan_nama = ($kegiatan['nama'] ?: '');
		}

		$hylink = site_url("log/".encrypt_url($kunci));
		$hylink = "<a href='".$hylink."'>Klik disini untuk detail</a>";

		if($ket == "add_panitia"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah panitia(".$param1." sebagai ".$param2.") pada kegiatan ". $kegiatan_nama ." dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_panitia"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus panitia(".$param1." sebagai ".$param2.") pada kegiatan ". $kegiatan_nama ." dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "add_tugas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah tugas: ".$param1." pada kegiatan ". $kegiatan_nama ." dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "edit_tugas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja mengubah tugas pada kegiatan " .$kegiatan_id. "(".$kegiatan_nama.") dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_tugas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus tugas: ".$param1." pada kegiatan ". $kegiatan_nama ." dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "add_berkas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah berkas(".$param1.") pada kegiatan ". $kegiatan_nama ." dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_berkas"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus berkas pada kegiatan ". $kegiatan_nama ." dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "add_peserta"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menambah peserta pada kegiatan ". $kegiatan_nama ." dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		if($ket == "delete_peserta"){
			$msg = "UserId: #" .$user_id. "(".$user_nama.") baru saja menghapus panitia pada kegiatan ". $kegiatan_nama ." dengan kode Log #". $kunci . "\n\n". $hylink;
		}

		// Setting telegram bot nya
		$bot_token = env("BOT_TOKEN_TELE");
		$bot = new \Telegram($bot_token);

		// Dapetin semua panitia di kegiatan tsb trus looping
		$panitias = $this->panitia->getByKegiatan($key);

		foreach ($panitias as $k) {
			$user = $this->users->withDeleted()->find($k['user']);
			$notifikasi_user = $this->setting_notif->findByUser($k['user']);

			// Periksa jika user gamau di notif
			if($notifikasi_user->keg_pan == 1 && ($ket == "add_panitia" || $ket == "delete_panitia")) 
			{
				$content = ['chat_id' => $user['chat_id'], 'text' => $msg, 'parse_mode' => 'HTML'];
				$this->simpan_chat($msg, $user_id);
				$bot->sendMessage($content);
			}

			if($notifikasi_user->keg_tug == 1 && ($ket == "add_tugas" || $ket == "edit_tugas" || $ket == "delete_tugas"))
			{
				$content = ['chat_id' => $user['chat_id'], 'text' => $msg, 'parse_mode' => 'HTML'];
				$this->simpan_chat($msg, $user_id);
				$bot->sendMessage($content);
			}

			if($notifikasi_user->keg_ber == 1 && ($ket == "add_berkas" || $ket == "delete_berkas"))
			{
				$content = ['chat_id' => $user['chat_id'], 'text' => $msg, 'parse_mode' => 'HTML'];
				$this->simpan_chat($msg, $user_id);
				$bot->sendMessage($content);
			}

			if($notifikasi_user->keg_pes == 1 && ($ket == "add_peserta" || $ket == "delete_peserta"))
			{
				$content = ['chat_id' => $user['chat_id'], 'text' => $msg, 'parse_mode' => 'HTML'];
				$this->simpan_chat($msg, $user_id);
				$bot->sendMessage($content);
			}

		}
	}

	function simpan_chat($pesan, $user, $status = 1)
  {
    $data = [
      'pesan' => $pesan,
      'jenis' => $status, // 1 = kirim, 0 = terima
      'time' => time(),
      'user' => $user
    ];
    $this->chat->insert($data);
  }
}
