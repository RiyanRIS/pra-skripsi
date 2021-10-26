<?php

function nav($a, $b)
{
  if ($a == $b) {
    echo "active";
  }
}

function getCountPesertaKegiatan($id)
{
  $userModel = model('App\Models\PesertaModel', false);
  $total = 0;
  $total = count($userModel->getByKegiatan($id));
  return $total;
}

function getCountPanitiaKegiatan($id)
{
  $userModel = model('App\Models\PanitiaModel', false);
  $total = 0;
  $total = count($userModel->getByKegiatan($id));
  return $total;
}

function getUsersById($id)
{
  $userModel = model('App\Models\UsersModel', false);
  $res = $userModel->withDeleted()->find($id);
  return $res;
}

function getKegiatanById($id)
{
  $model = model('App\Models\KegiatanModel', false);
  $res = $model->withDeleted()->find($id);
  return $res;
}

function anti_injection($string)
{
  $data = stripslashes(strip_tags(htmlentities(htmlspecialchars($string, ENT_QUOTES))));
  return $data;
}

function randStr($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function navshow($a, $b)
{
  if ($a == $b) {
    echo "show";
  }
}

function formatBytes($bytes, $precision = 2)
{
  $units = array('B', 'KB', 'MB', 'GB', 'TB');

  $bytes = max($bytes, 0);
  $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
  $pow = min($pow, count($units) - 1);

  // Uncomment one of the following alternatives
  $bytes /= pow(1024, $pow);
  // $bytes /= (1 << (10 * $pow)); 

  return round($bytes, $precision) . ' ' . $units[$pow];
}

function toRp($val)
{
  return "Rp " . number_format($val, 0, ',', '.');
}

function urlImg($nama, $jenis)
{
  return base_url("assets/images/" . $jenis . "/" . $nama);
}

function punyaAkses(array $akses): bool
{
  if (in_array(session()->user_role, $akses)) {
    return true;
  }
  return false;
}

function punyaAksesKegiatan(string $user_id, string $kegiatan): bool
{
  $res = false;
  $panitiaModel = model('App\Models\PanitiaModel', false);
  $tes = $panitiaModel->getByKegiatan($kegiatan);
  
  foreach ($tes as $key) {
    if($key['user'] == $user_id){
      $res = true;
    }
  }
  return $res;
}

function slugify($text)
{
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function encrypt_url($string)
{

  $output = false;

  $security       = parse_ini_file("security.ini");
  $secret_key     = $security["encryption_key"];
  $secret_iv      = $security["iv"];
  $encrypt_method = $security["encryption_mechanism"];

  $key    = hash("sha256", $secret_key);
  $iv     = substr(hash("sha256", $secret_iv), 0, 16);

  $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
  $output = base64_encode($result);
  return $output;
}

function decrypt_url($string)
{

  $output = false;

  $security       = parse_ini_file("security.ini");
  $secret_key     = $security["encryption_key"];
  $secret_iv      = $security["iv"];
  $encrypt_method = $security["encryption_mechanism"];

  $key    = hash("sha256", $secret_key);
  $iv = substr(hash("sha256", $secret_iv), 0, 16);

  $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  return $output;
}
