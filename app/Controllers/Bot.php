<?php

/**
  *** jika belum terdaftar
  
  * start
  *   daftar
  *   sudah ada akun

  *** jika sudah terdaftar
  
  * start
  *   kegiatan yang tersedia
  *   kegiatan yang sedang diikuti
  *   pengaturan
*/

namespace App\Controllers;

class Bot extends BaseController
{

  protected $chatid;
  protected $userid;
  protected $bot;

  // CEWECANTIK
  // protected $bot_token = '1369088735:AAGkBavShqR7Lt3CFfv_QLkvr6S2n45CvBU';

  // KEGIATAN_UKMIK_BOT 
  // protected $bot_token = '1848204186:AAFVsGpjZr_EbuEOq0hpkX2FRB-x5266JbM';
  protected $bot_token;

  public function __construct()
  {
    $this->bot_token = env("BOT_TOKEN_TELE");
    $this->bot = new \Telegram($this->bot_token);
  }

  public function index()
  {
    $this->chatid = $this->bot->ChatID();
    $text = $this->bot->Text();

    $text = \strtolower($text);

    if ($text == "/start") {
      $this->start();
    }

    if (($text == "daftar") || ($text == "/daftar")) {
      $this->daftar();
    }

    if (($text == "sudah ada akun") || ($text == "/sudah_ada_akun")) {
      $this->sudah_ada_akun();
    }

    if (($text == "masukkan kode") || ($text == "/masukkan_kode")) {
      $this->masukkan_kode();
    }

    $this->userid = $this->cek_pengguna();
    if($this->userid == null){
      $this->start();
    }

    if (($text == "detail") || ($text == "/detail")) {
      $this->detail();
    }

    if ($text == "kegiatan yang tersedia" || $text == "/kegiatan_yang_tersedia") {
      $this->kegiatan_yang_tersedia($this->userid);
    }

    if (($text == "kegiatan yang diikuti") || ($text == "/kegiatan_yang_diikuti")) {
      $this->kegiatan_yang_diikuti($this->userid);
    }

    if(substr( $text, 0, 7 ) === "/detkeg"){
      $this->detailKegiatan($text);
    }

    if(substr( $text, 0, 7 ) === "/gabkeg"){
      $this->gabungKegiatan($text);
    }

    if(substr( $text, 0, 7 ) === "/kelkeg"){
      $this->keluarKegiatan($text);
    }

    if(($text == "bantuan") || ($text == "/bantuan")){
      $this->bantuan();
    }

    if(($text == "profil") || ($text == "/profil")){
      $this->profil();
    }

  }

  function start(){
    $idd = $this->cek_pengguna();
    if($idd == null){
      $option = array(
        array($this->bot->buildKeyboardButton("Sudah ada akun"), $this->bot->buildKeyboardButton("Daftar")),
        array($this->bot->buildKeyboardButton("Bantuan"))
      );
      $keyb = $this->bot->buildKeyBoard($option, true);
      $content = array('chat_id' => $this->chatid, 'reply_markup' => $keyb, 'text' => "Sepertinya ini pertama kali kamu menggunakan bot ini, dan kami belum mengenalimu, silahkan daftar atau sambungkan dengan akun yang sudah ada.");
      $this->bot->sendMessage($content);
      die();
    } else {
      $this->kirimbtn("Hai, silahkan pilih menu dibawah.");
    }
  }

  function daftar(){
    $idd = $this->cek_pengguna();
    if($idd == null){
      $chatid = $this->chatid;
      $username = $this->bot->Username();
      $nama = $this->bot->FirstName() . " " . $this->bot->LastName();
      if($this->users->findByUsername($username)){
        $username .= rand(1000, 9999);
      }
      $data = [
        'username' => $username,
        'nama' => $nama,
        'password' => \password_hash($username, PASSWORD_DEFAULT),
        'create_at' => time(),
        'ava' => "1.png",
        'chat_id' => $chatid
      ];

      $userid = $this->users->simpan($data);

      $settingNotif = [
        'user' => $userid,
        'login' => 1
      ];
      $this->setting_notif->simpan($settingNotif);
      
      $rep = $this->log("insert", $userid, "users");
      $this->report_to_admin("reg_user_from_tele", $rep);
      $pesan = "Pendaftaran Berhasil. \n\nKami akan mengenalimu dengan nama \"$nama\". Kamu dapat masuk ke sistem kami dengan \n\nusername: $username\npassword: $username. \n\nJangan lupa untuk mengubah username & password setelah berhasil masuk.\n\nJika mengalami masalah saat masuk, hubungi admin.";
      $this->kirim($pesan);
      $this->bantuan();
    } else {
      $pesan = "Kamu telah melakukan pendaftaran. Gunakan perintah /profil untuk melihat detail akun kamu. \n\nJika ini kesalahan, hubungi admin.";
      $this->kirim($pesan);
    }
    die();
  }

  function sudah_ada_akun(){
    $idd = $this->cek_pengguna();
    if($idd == null){
      $pesan = "Sambungkan akun kamu dengan telegram, caranya:\n\n1. Masuk ke halaman website https://riyanpra.herokuapp.com \n2. Login dengan akun yang ingin kamu sambungkan.\n3. Buka setting dengan cara, klik nama kamu di pojok kanan atas lalu klik \"Pengaturan\"\n4. Cari bagian \"Kode Undangan Telegram\" Lalu klik Dapatkan Kode\n5. Pastikan telah muncul kode unik untuk kamu, bukan pesan bahwa akun kamu sudah terikat.\n6. Setelah itu kembali ke telegram dan klik tombol \"Masukkan Kode\" yang ada dibawah ini (di bagian keyboard biasanya)\n7. Bot akan meminta kode undangan\n8. Masukkan kode undangan yang ada pada langkah 5.\n9. Bot akan memverifikasi kodenya dan membalas dengan pesan berhasil atau gagal.\n10. Selesai.\n\nJika ada masalah, hubungi admin.";
      $option = array(
        array($this->bot->buildInlineKeyboardButton("Masukkan Kode", '', 'masukkan_kode'))
      );
      $keyb = $this->bot->buildKeyBoard($option, true);
      $content = array('chat_id' => $this->chatid, 'reply_markup' => $keyb, 'text' => $pesan);
      $this->bot->sendMessage($content);  
    } else {
      $pesan = "Akun kamu sudah terikat dengan sistem. Gunakan perintah /profil untuk melihat detail akun kamu. \n\nJika ini kesalahan, hubungi admin.";
      $this->kirim($pesan);
    }
    die();
  }

  function masukkan_kode(){
    $this->setCached("masukkan kode");
    $pesan = "Baiklah, Sekarang silahkan masukkan kode undanganmu.";
    $this->kirim($pesan);
    die();
  }

  function kegiatan_yang_tersedia($user_id){
    $pesan = ""; $no = 1;

    $user = getUsersById($user_id);

    if($user['role'] == 'admin' || $user['role'] == 'anggota'){
      
      $list_kegiatan = $this->kegiatan->whereIn("jenis", ["internal", "umum"])->where('tanggal > ', time())->orderBy("tanggal", "DESC")->limit(10)->findAll();
      
      $pesan .= "Hai, ".$user['nama'];

      if(count($list_kegiatan) == 0){
        $pesan .= "\n\nSaat ini belum ada kegiatan yang dapat kamu ikuti.";
      } else {
        $pesan .= "\n\nBerikut list kegiatan yang bisa kamu ikutin: \n\n";
        
        foreach($list_kegiatan as $key){
          $pesan .= $no++ . ". " . $key['nama'];
          $pesan .= "\nDetail: /detkeg" . $key['id'];
          $pesan .= "\nGabung: /gabkeg" . $key['id'];
          $pesan .= "\n\n\n";
        }
      }

      $this->kirimbtn($pesan);
    } else {
      $list_kegiatan = $this->kegiatan->where("jenis", "umum")->where('tanggal > ', time())->orderBy("tanggal", "DESC")->limit(10)->findAll();
      
      $pesan .= "Hai, ".$user['nama'];

      if(count($list_kegiatan) == 0){
        $pesan .= "\n\nSaat ini belum ada kegiatan yang dapat kamu ikuti.";
      } else {
        $pesan .= "\n\nBerikut list kegiatan yang bisa kamu ikutin: \n\n";
        
        foreach($list_kegiatan as $key){
          $pesan .= $no++ . ". " . $key['nama'];
          $pesan .= "\nDetail: /detkeg" . $key['id'];
          $pesan .= "\nGabung: /gabkeg" . $key['id'];
          $pesan .= "\n\n\n";
        }
      }

      $this->kirimbtn($pesan);
    }
  }

  function kegiatan_yang_diikuti($user_id){
    $pesan = ""; $no = 1;

    $user = getUsersById($user_id);

    if($user['role'] == 'admin' || $user['role'] == 'anggota'){
      
      $list_kegiatan = $this->peserta->getByUser(session()->user_id);

      $pesan .= "Hai, ".$user['nama'];

      if(count($list_kegiatan) == 0){
        $pesan .= "\n\nKegiatan yang kamu ikuti masih kosong.";
      } else {
        $pesan .= "\n\nBerikut list kegiatan yang telah kamu ikutin: \n\n";
        
        foreach($list_kegiatan as $key){
          $pesan .= $no++ . ". " . $key['nama'];
          $pesan .= "\nDetail: /detkeg" . $key['id'];
          $pesan .= "\nKeluar: /kelkeg" . $key['id'];
          $pesan .= "\n\n\n";
        }
      }

      $this->kirimbtn($pesan);
    } else {
      $list_kegiatan = $this->peserta->getByUser(session()->user_id);

      $pesan .= "Hai, ".$user['nama'];

      if(count($list_kegiatan) == 0){
        $pesan .= "\n\nKegiatan yang kamu ikuti masih kosong.";
      } else {
        $pesan .= "\n\nBerikut list kegiatan yang telah kamu ikutin: \n\n";
        
        foreach($list_kegiatan as $key){
          $pesan .= $no++ . ". " . $key['nama'];
          $pesan .= "\nDetail: /detkeg" . $key['id'];
          $pesan .= "\nKeluar: /kelkeg" . $key['id'];
          $pesan .= "\n\n\n";
        }
      }

      $this->kirimbtn($pesan);
    }
  }

  function detailKegiatan($txt){
    $pesan = "";
    $id = str_replace("/detkeg", "", $txt);

    $kegiatan = $this->kegiatan->find($id);
    $peserta = $this->peserta->getByKegiatan($id);

    if($kegiatan){
      $tanggal = date("d F Y H:i", $kegiatan['tanggal']);
      $pesan .= $kegiatan['nama'];
      $pesan .= "\n\nTanggal Kegiatan: ". $tanggal;
      $pesan .= "\nlokasi: ". $kegiatan['lokasi'];
      $pesan .= "\ndeskripsi: \n\n". $kegiatan['deskripsi'];
      $pesan .= "\n\nContact Person: ". $kegiatan['cp1'];
      $pesan .= "\nLink: ". $kegiatan['link1'];
      $pesan .= "\nTotal Peserta: ". count($peserta) ." orang.";
    } else {
      $pesan .= "Maaf, kami tidak menemukan data kegiatan yang kamu cari.";
    }

    $this->kirimbtn($pesan);
  }

  function gabungKegiatan($txt){
    $pesan = ""; $tes = true;
    $id = str_replace("/gabkeg", "", $txt);

    $kegiatan = $this->kegiatan->find($id);

    if(!$kegiatan){
      $tes = false;
      $pesan = "Kegiatan dengan kode ".$id." tidak ditemukan.\n\nGunakan tombol Kegiatan Yang Tersedia untuk memunculkan list kegiatan.";
    }

    if($tes == true){
      if(!isUserSudahJadiPeserta($id, $this->userid)){

        $additionalData = [
          'kegiatan' 	=> $id,
          'user' 			=> $this->userid,
          'tgl_daftar'  	=> time(),
          'hadir' 		=> 0
        ];

        $lastid = $this->peserta->simpan($additionalData);
        if($lastid){
          $resp = $this->log("insert",$lastid,"peserta");
          $this->report_to_admin("add_peserta", $resp, 'kegiatan', $id);
          $this->report_to_usernya("add_peserta", $this->userid, $resp, 'kegiatan', $id);
          $pesan = "Berhasil Gabung";
        }else{
          $pesan = "Gagal Gabung";
        }
      } else {
        $pesan = "Anda sudah tergabung dalam kegiatan tersebut";
      }
    }

    $this->kirimbtn($pesan);
  }

  function keluarKegiatan($txt){
    $pesan = ""; $tes = true;
    $id = str_replace("/kelkeg", "", $txt);

    $kegiatan = $this->kegiatan->find($id);

    if(!$kegiatan){
      $tes = false;
      $pesan = "Kegiatan dengan kode ".$id." tidak ditemukan.\n\nGunakan tombol Kegiatan Yang Tersedia (/kegiatan_yang_tersedia) untuk memunculkan list kegiatan.";
    }

    if($tes == true){
      if(isUserSudahJadiPeserta($id, $this->userid)){
        $lastid = $this->peserta->delete($this->userid);
        if($lastid){
          $resp = $this->log("delete",$id,"peserta");
          $this->report_to_admin("delete_peserta", $resp, 'kegiatan', $id['kegiatan']);
          $this->report_to_usernya("delete_peserta", $this->userid, $resp, 'kegiatan', $id);
          $pesan = "Berhasil Keluar";
        }else{
          $pesan = "Gagal Keluar";
        }
      } else {
        $pesan = "Anda belum tergabung dalam kegiatan tersebut";
      }
    }

    $this->kirimbtn($pesan);
  }

  function profil(){
    $userid = $this->cek_pengguna();
    $user = $this->users->find($userid);
    $pesan = "Profil kamu\n\nNama: ".$user['nama']."\nUsername: ".$user['username']."\nRole: ".ucwords($user['role'])."\n\nKamu dapat merubah detail informasimu dari dalam sistem.";
    $this->kirimbtn($pesan);
  }

  function bantuan(){
    $pesan = "
Panel Bantuan

/start = Perintah awal
/daftar = Untuk mendaftar akun
/sudah_ada_akun = Jika sudah memiliki akun dan ingin mentautkan dengan akun telegram
/masukkan_kode = Input kode undangan dari sistem ke telegram
/kegiatan_yang_tersedia = List kegiatan yang tersedia
/kegiatan_yang_diikuti = List kegiatan yang diikuti
/detkeg = Detail kegiatan(diikuti dengan kode, semisal /detkeg1)
/gabkeg = Gabung dalam suatu kegiatan(diikuti dengan kode, semisal /gabkeg1)
/kelkeg = Keluar dari suatu kegiatan(diikuti dengan kode, semisal /kelkeg1)
/profil = Memunculkan profil akun
/bantuan = Memunculkan bantuan

Jika masih mengalami stuck hubungi admin.
      ";
    $this->kirimbtn($pesan);
  }

  function echoo($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
  }

  //kirim ke user, parameter kedua jika kosong tidak akan disimpan ke database.
  function kirim($pesan, $userid = null){
    $content = ['chat_id' => $this->chatid, 'text' => $pesan];
    $this->bot->sendMessage($content);
    if ($userid != null) {
      $this->simpan_pesan($pesan, $userid);
    }
  }

  function kirimbtn($pesan, $userid = null){
    $option = array(
      array($this->bot->buildKeyboardButton("Kegiatan Yang Tersedia"), $this->bot->buildKeyboardButton("Kegiatan Yang Diikuti")),
      array($this->bot->buildKeyboardButton("Bantuan"))
    );
    $keyb = $this->bot->buildKeyBoard($option, true);
    $content = array('chat_id' => $this->chatid, 'reply_markup' => $keyb, 'text' => $pesan);
    $this->bot->sendMessage($content);
    if ($userid != null) {
      $this->simpan_pesan($pesan, $userid);
    }
    die();
  }

  function simpan_pesan($pesan, $user, $status = 1)
  {
    $data = [
      'pesan' => $pesan,
      'jenis' => $status, // 1 = kirim, 0 = terima
      'time' => time(),
      'user' => $user
    ];
    $this->chat->insert($data);
  }

  function cek_pengguna()
  {
    $chatid = $this->chatid;

    $cek = $this->users->where('chat_id', $chatid)->where('delete_at', null)->findAll();
    if (count($cek) == 0) {
      return null;
    } else {
      return $cek[0]['id'];
    }
  }

  function getCache()
  {
    $c = $this->cache->getByChatid($this->chatid);
    if (count($c)) {
      $result = $c[0]['nama'];
      return $result;
    } else {
      return false;
    }
  }

  function setCached($nama)
  {
    $c = $this->cache->getByChatid($this->chatid);
    if (count($c)) {
      $data = [
        'nama' => $nama,
      ];
      $this->cache->update($c[0]['id'], $data);
    } else {
      $data = [
        'chatid' => $this->chatid,
        'nama' => $nama,
        'status' => 0
      ];
      $this->cache->insert($data);
    }
  }

  function setWebhook()
  {
    echo "<pre>";
    print_r($this->bot->setWebhook(env("URL_WEBHOOK") . '/bot'));
    echo "</pre>";
  }
}
