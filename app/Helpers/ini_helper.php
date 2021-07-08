<?php

function nav($a,$b){
    if($a == $b){
        echo "active";
    }
}

function navshow($a,$b){
    if($a == $b){
        echo "show";
    }
}

function toRp($val){
    return "Rp " . number_format($val,0,',','.');
}

function urlImg($nama,$jenis){
    return base_url("assets/images/".$jenis."/".$nama);
}

function slugify($text){
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

function encrypt_url($string) {

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

function decrypt_url($string) {

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