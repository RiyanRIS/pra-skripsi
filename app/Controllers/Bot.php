<?php

namespace App\Controllers;

class Bot extends BaseController
{

  protected $chatid;
  protected $userid;
  protected $url = 'https://d12e-118-99-83-32.ngrok.io/bot'; // http://localhost:8080/bot/setwebhook
  protected $bot;

  // CEWECANTIK
  // protected $bot_token = '1369088735:AAGkBavShqR7Lt3CFfv_QLkvr6S2n45CvBU';

  // KEGIATAN_UKMIK_BOT 
  protected $bot_token = '1848204186:AAFVsGpjZr_EbuEOq0hpkX2FRB-x5266JbM';

  public function __construct()
  {
    $this->bot = new \Telegram($this->bot_token);
  }

  public function index()
  {
    $this->chatid = $this->bot->ChatID();
    $text = $this->bot->Text();

    $text = \strtolower($text);
    $ex = \explode(" ", $text);

    if ($text == "daftar") {
      $this->daftar();
    }

    $this->userid = $this->cek_pengguna();
    // $this->simpan_pesan($text, $this->userid, 0);

    if ($text == "detail") {
      $this->detail();
    }

    // if ($text == "kegiatan yang sedang diikuti") {
    //   $this->kegiatan_yang_sedang_diikuti($this->userid);
    // }

    // if ($text == "kegiatan yang telah diikuti") {
    //   $this->kegiatan_yang_telah_diikuti($this->userid);
    // }

    // if ($text == "kegiatan yang bisa diikuti") {
    //   $this->kegiatan_yang_bisa_diikuti($this->userid);
    // }

    if ($text == "reset") {
      $this->cache->destroy($this->chatid);
      $this->kirim("Berhasil mereset perintah!", $this->userid);
      die();
    }
    
    if ($text == "bantuan") {
      $this->bantuan();
    }

    if (@$ex[0] == "lihat" || @$ex[0] == "show") {
      if (@$ex[1] == "kegiatan") {
        if (@$ex[2] == "detail") {
          if (@$ex[3]) {
            $id = $ex[3];
            $this->showDetailKegiatan($id);
          } else {
            $this->kirim("Maaf bung.\nTolong kirim id kegiatan yang ingin lo tengok.", $this->userid);
            $this->setCached("lihat kegiatan detail");
            die();
          }
        } else {
          if (@$ex[2]) {
            $this->kirim("Maaf bung.\nPerintah \"Lihat Kegiatan\" memiliki parameter \n- detail", $this->userid);
            $this->cache->destroy($this->chatid);
            die();
          } else {
            $this->showKegiatan();
          }
        }
      } else {
        $this->show();
      }
    }

    $c = $this->getCache();

    if ($c) {
      if ($c == "lihat") {
        if (@$ex[0] == "kegiatan") {
          $this->showKegiatan();
        }
      } elseif ($c == "lihat kegiatan detail") {
        $id = $ex[0];
        $this->showDetailKegiatan($id);
      }
    }

    $this->bBantuan();
    $this->cache->destroy($this->chatid);
    die();
  }

  function awal(){
    $option = array(
      array($this->bot->buildKeyboardButton("Sudah ada akun"), $this->bot->buildKeyboardButton("Daftar")),
      array($this->bot->buildKeyboardButton("Bantuan"))
    );
    $keyb = $this->bot->buildKeyBoard($option, true);
    $content = array('chat_id' => $this->chatid, 'reply_markup' => $keyb, 'text' => "Sepertinya ini pertama kali kamu menggunakan bot ini, dan kami belum mengenalimu, silahkan daftar atau sambungkan dengan akun yang sudah ada.");
    $this->bot->sendMessage($content);
    die();
  }

  function daftar(){
    $idd = $this->cek_pengguna();
    if(!$idd){
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
      $this->log("insert", $userid, "users");
      $pesan = "Pendaftaran Berhasil. \n\nKami akan mengenalimu dengan nama \"$nama\". Kamu dapat masuk ke sistem kami dengan \n\nusername: $username\npassword: $username. \n\nJangan lupa untuk mengubah username & password setelah berhasil masuk.\n\nJika mengalami masalah saat masuk, hubungi admin.";
      $this->kirim($pesan);
      $this->bantuan();
    } else {
      $pesan = "Kamu telah melakukan pendaftaran. Gunakan perintah \"detail\" untuk melihat detail akun kamu. \n\nJika ini kesalahan, hubungi admin.";
      $this->kirim($pesan);
    }
    die();
  }

  function detail(){
    $cek = $this->users->where('chat_id', $this->chatid)->where('delete_at', null)->findAll();
    $pesan = "## DETAIL USERS\n\nNama: " . $cek[0]['nama']."\nUsername: " . $cek[0]['username']."\nStatus: " . $cek[0]['role'] . "\n\nJika ini kesalahan, hubungi admin.";
    $option = array(
      array($this->bot->buildInlineKeyboardButton("Kegiatan yang sedang diikuti", '', 'kegiatan_yang_diikuti'), $this->bot->buildInlineKeyboardButton("Kegiatan yang bisa diikuti"), $this->bot->buildInlineKeyboardButton("Kegiatan yang telah diikuti")),
    );
    $keyb = $this->bot->buildKeyBoard($option, true);
    $content = array('chat_id' => $this->chatid, 'reply_markup' => $keyb, 'text' => $pesan);
    $this->bot->sendMessage($content);
    die();
  }

  function bantuan(){
    $pesan = "Halo, ini adalah bantuan.";
    $this->kirim($pesan, $this->userid);
    $this->cache->destroy($this->chatid);
    die();
  }

  function bBantuan(){
    $option = array(
      array($this->bot->buildKeyboardButton("Bantuan")),
    );
    $keyb = $this->bot->buildKeyBoard($option, $onetime = true);
    $content = array('chat_id' => $this->chatid, 'reply_markup' => $keyb, 'text' => "Waah.\nPerintah lo ambigu bro. Silahkan tekan tombol ini untuk dapet bantuan.");
    $this->bot->sendMessage($content);
    // $this->setCached("lihat");
    die();
  }

  function show(){
    $option = array(
      array($this->bot->buildKeyboardButton("Kegiatan"), $this->bot->buildKeyboardButton("Peserta")),
    );
    $keyb = $this->bot->buildKeyBoard($option, $onetime = true);
    $content = array('chat_id' => $this->chatid, 'reply_markup' => $keyb, 'text' => "Lihat apa bung?");
    $this->bot->sendMessage($content);
    $this->setCached("lihat");
    die();
  }

  function showKegiatan(){
    $kegiatan = $this->kegiatan->findAll();

    if ($kegiatan) {
      $this->kirim("Berikut list kegiatan aktif UKM-IK", $this->userid);

      foreach ($kegiatan as $key) {
        $pesan = "ID #" . $key['id']
          . "\n\nnama: " . ucwords($key['nama'])
          . "\ntanggal: " . date("d F Y H:i", $key['tanggal']);
        $this->kirim($pesan, $this->userid);
      }
      $this->kirim("Sudah bung.\nAda lagi yang bisa gue bantu?", $this->userid);
    } else {
      $this->kirim("Kegiatan aktif kosong.", $this->userid);
    }
    $this->cache->destroy($this->chatid);
    die();
  }

  function showDetailKegiatan($id){
    $kegiatan = $this->kegiatan->find($id);

    if ($kegiatan) {

      $user = $this->users->find(2);

      $list_panitia = $this->panitia->getByKegiatan($id);
      $list_berkas = $this->berkas->getByKegiatan($id);
      $list_peserta = $this->peserta->getByKegiatan($id);
      $list_tugas = $this->tugas->getByKegiatan($id);

      $total_peserta = count($list_peserta);
      $total_panitia = count($list_panitia);

      $cp = $kegiatan['cp1'];
      if ($kegiatan['cp2'] != "") {
        $cp .= "/" . $kegiatan['cp2'];
      }

      $this->kirim(json_encode($user), $this->userid);
      die();


      $pesan = "ID #" . $kegiatan['id']
        . "\n\nNama: " . ucwords($kegiatan['nama'])
        . "\nDeskripsi: " . $kegiatan['deskripsi']
        . "\nTanggal: " . date("d F Y H:i", $kegiatan['tanggal'])
        . "\nLokasi: " . ucwords($kegiatan['lokasi'])
        . "\nPenanggungjawab: " . $user['nama']
        . "\nContact person: " . $cp
        . "\nLink: " . $kegiatan['link1']
        . "\n\nTotal Peserta: " . $total_peserta
        . "\nTotal Panitia: " . $total_panitia;
      $this->kirim($pesan, $this->userid);
    } else {
      $this->kirim("Ngga ada kegiatan dengan id itu bro.\nCoba lo cek lagi dah..", $this->userid);
      $option = array(
        array($this->bot->buildKeyboardButton("Lihat Kegiatan")),
      );
      $keyb = $this->bot->buildKeyBoard($option, $onetime = true);
      $content = array('chat_id' => $this->chatid, 'reply_markup' => $keyb, 'text' => "Lu klik tombol itu buat liat list kegiatan.");
      $this->bot->sendMessage($content);
    }
    $this->cache->destroy($this->chatid);
    die();
  }

  //kirim ke user, parameter kedua jika kosong tidak akan disimpan ke database.
  function kirim($pesan, $userid = null){
    $content = ['chat_id' => $this->chatid, 'text' => $pesan];
    $this->bot->sendMessage($content);
    if ($userid != null) {
      $this->simpan_pesan($pesan, $userid);
    }
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
      $this->awal();
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
    $data = [
      'chatid' => $this->chatid,
      'nama' => $nama,
      'status' => 0
    ];
    $this->cache->insert($data);
  }

  function setWebhook()
  {
    echo "<pre>";
    print_r($this->bot->setWebhook($this->url));
    echo "</pre>";
  }
}
