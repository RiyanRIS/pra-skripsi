# SISTEM INFORMASI MANAJEMEN KEGIATAN UKM INFORMATIKA DAN KOMPUTER

SIM Kegiatan UKM-IK adalah sebuah sistem manajemen kegiatan yang digunakan untuk mengatur kegiatan pada suatu organisasi agar lebih terstruktur yang sudah terintregasi dengan Telegram BOT.

<hr>

## Daftar Isi
1. [Fitur](#fitur)
2. [Demo Aplikasi](#demo-aplikasi)
3. [Instalasi](#instalasi)
    - [Spesifikasi yang Dibutuhkan](#spesifikasi)
    - [Cara Install](#cara-install)
    - [Login Admin](#cara-install)
4. [Master Data](#master-data)
    - [Users](#users)
    - [Kegiatan](#kegiatan)
5. [Pendaftaran](#alur-daftar)
6. [Alur Kegiatan](#alur-kegiatan)
    - [Tugas](#tugas)
    - [Panitia](#panitia)
    - [Berkas](#berkas)
    - [Peserta](#peserta)
7. [Screenshots](#screenshots)
8. [Lisensi](#license)

<hr>

## Fitur

Fitur pada Aplikasi ini meliputi:

1. Akun Login
    - Register Melalui Admin atau [Telegram](#alur-daftar)
    - Login dan Logout
    - Ingat Saya
    - Ganti Password
    - Ganti Profil
    - Multi Users
2. Master Users
    - Pencarian Users
    - List Seluruh Users
    - List Pengurus dan Peserta
    - Input Update dan Delete Users
    - Report ke Admin
3. Master Kegiatan
    - Pencarian Kegiatan
    - Input Update dan Delete Kegiatan
    - Report ke Admin
4. Master Berkas
    - Pencarian Berkas
    - List Berkas Kegiatan
    - Download Berkas
    - Input Update dan Delete Berkas
    - Report ke Admin
5. Pengaturan Aplikasi
    - Tautkan dengan Telegram
    - Atur Notifikasi
    - Ubah Profil Pengguna
    - Cek Kegiatan yang Diikuti
6. Manajemen Kegiatan
    - List Kegiatan
    - Ikuti Kegiatan
    - Atur Panitia Kegiatan
    - Atur Task/Tugas Kegiatan
    - Atur Peserta Kegiatan
    - Log Aktifitas Kegiatan
    - Input, Update dan Delete Kegiatan
    - Input dan Delete Berkas

<hr>

## Demo Aplikasi

| URL | https://skripsi.riyanris.my.id |
| --- | --- |
| username | kodokkayang |
| password | kodokkayang |

## INSTALASI

### Spesifikasi
- PHP ^7.2
- Code Igniter 4^
- Database MySQL atau MariaDB
- Browser Terbaru

### Cara Install

- Clone atau download repo ini.
- Buka terminal arahkan ke direktori folder.
- Jalankan ```composer update```.
- Buat **database** bernama `pra_skripsi`.
- Rename env menjadi .env (ada titik didepan).
- Jalankan ```php spark migrate```.
- Jalankan `php spark db:seed MySeeder`.
- Jalankan `php spark serve`.
- Buka `localhost:8080` pada browser.

### Login Admin
```
Username: kodokkayang
Password: kodokkayang
```

<hr>

## Master Data

### Users

**ROLE** : `Admin`, `Pengawas`, `Pengurus`, `Peserta`

```
Admin::akses(){
  Admin mendapat full akses dari sistem ini.
}
```
```
Pengawas::akses()
{
  Pengawas memiliki akses ke seluruh fitur kegiatan dan users.
}
```
```
Pengurus::akses()
{
  Pengurus memiliki akses ke suluruh fitur kegiatan dan hanya memiliki akses ke peserta.
}
```
```
Peserta::akses()
{
  Peserta hanya dapat mengakses detail kegiatan, jika peserta masuk kedalam kepanitian, dia memiliki akses ke beberapa fitur kegiatan seperti menambah tugas dan peserta kegiatan.
}
```

### Kegiatan

Kegiatan memiliki 3 jenis, `Umum`, `Internal` dan `Khusus Pengurus`
`Satu Kegiatan` memiliki `Satu Penanggung Jawab` yang berasal dari pengurus ataupun pengawas.

Status kegiatan ada 2 yaitu `aktif` dan `sudah selesai`

Notifikasi akan otomatis dikirim kepada `panitia kegiatan dan admin` ketika ada perubahan pada kegiatan terkait.

## Alur Daftar
Pendaftaran dapat melalui admin (tanpa linked ke telegram atau menggunakan telegram)

### Alur Daftar Melalui Admin
- Admin harus login kedalam sistem
- Masuk ke navigasi Pengguna -> Semua Pengguna
- Klik `tambah data`
- Isi biodata pengguna
- Klik simpan untuk menyimpan

### Alur Daftar Melalui Akun Telegram
- Masuk kedalam bot [@kegiatan_ukmik_bot](https://t.me/kegiatan_ukmik_bot)
- Tulis pesan ```Daftar``` lalu kirim
- Maka akan mendapat balasan berupa username dan password untuk login kedalam sistem.  

#### Contoh
![pendafataran berhasil](https://i.ibb.co/JsXdLqD/Screenshot-from-2021-11-19-19-56-11.png)
Ketika mengetikkan `daftar` akan mendapat pesan berhasil, dan mendapat akun username dan password untuk masuk kedalam sistem.

![akun sudah terdaftar](https://i.ibb.co/vLgQGB0/Screenshot-from-2021-11-19-19-51-08.png)
Akun sudah terdaftar, ketika mengetikkan daftar akan mendapat pesan bahwa kamu telah melakukan pendaftaran.

## Alur Kegiatan

Kegiatan dapat dibuat oleh user yang memiliki role `admin, pengurus ataupun pengawas`. Dengan cara membuka halaman kegiatan dan klik `Buat Kegiatan Baru`. Lalu isi form pembuatan kegiatan dan klik `Simpan`

Ketika membuat kegiatan, pesan otomatis akan masuk ke seluruh user bahwa ada kegiatan baru.

Kegiatan dapat menyimpan task/tugas, panitia, berkas dan peserta.

### Tugas

Tugas adalah task kecil untuk setiap kegiatan yang perlu dikerjakan oleh panitia demi kelancaran acara.

### Panitia

### Berkas

### Peserta

<hr>

## Screenshots

gambar gambar

## Lisensi

Project ini open source di bawah [lisensi MIT](LICENSE).


