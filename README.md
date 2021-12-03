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
    - [Peserta](#)
7. [List Perintah BOT](#list-perintah-bot)
8. [Screenshots](#screenshots)
9. [Lisensi](#license)

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
6. Otomatisasi Bot Telegram
7. Manajemen Kegiatan
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
| username | admin |
| password | admin |

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
Username: admin
Password: admin
```

<hr>

## Master Data

### Users

- Role Pengguna pada sistem terdiri dari `Admin`, `Anggota` dan `Peserta`
- Admin mendapat full akses(semua fitur) dari sistem ini.
- Anggota memiliki akses informasi kegiatan, mendapat notifikasi kegiatan yang diikuti. Anggota dapat dipilih menjadi panitia kegiatan sehingga memiliki akses kedalam detail kegiatan yang dia pegang. Kedepanya, role anggota akan memiliki hak istimewa ketimbang peserta, seperti diskon ketika ada kegiatan yang berbayar, atau hal lainya.
- Peserta hanya dapat mengakses detail kegiatan, peserta akan mendapat notifikasi pemberitahuan terhadap kegiatan yang sedang dia ikuti.

### Kegiatan

- Kegiatan UKM I&K memiliki 2 jenis, `Umum` dan `Internal`
- `Satu Kegiatan` memiliki `Satu Penanggung Jawab` yang berasal dari admin.
- Status kegiatan ada 2 yaitu `aktif` dan `sudah terlaksana`
- Notifikasi akan otomatis dikirim kepada `admin`, `panitia` dan `peserta` ketika ada perubahan pada kegiatan terkait.

## Alur Daftar
Pendaftaran dapat melalui admin (tanpa linked ke telegram atau menggunakan telegram)

### Alur Daftar Melalui Admin
- Admin harus login kedalam sistem
- Masuk ke navigasi Pengguna -> Semua Pengguna
- Klik `tambah data`
- Isi biodata pengguna
- Klik simpan untuk menyimpan

Ketika daftar melalui admin, user yang baru saja terdaftar **harus** mentautkan akun dengan telegram yang dia miliki.

### Alur Mentautkan Akun Baru dengan Telegram
- Masuk kedalam bot [@kegiatan_ukmik_bot](https://t.me/kegiatan_ukmik_bot)
- Klik `start`
- Lalu klik `sudah ada akun`
- Baca Intruksi yang diberikan BOT, lalu klik `masukkan kode`
- Login kedalam sistem [sim ketika](https://skripsi.riyanris.my.id) dengan akun yang baru saja kamu buat, lalu buka `Setting -> Dasar` klik `Dapatkan kode`
- Kembali ke telegram lalu masukkan kode undanganmu

Contoh liat gambar di bawah
![Fitur sudah ada akun selesai](https://i.ibb.co/GtKTm3m/Screenshot-from-2021-11-19-21-06-00.png)

Lokasi Kode undangan dapat dilihat di bawah
![Kode Undangan](https://i.ibb.co/1bX0bVB/Screenshot-from-2021-11-19-21-07-22.png)

### Alur Daftar Melalui Akun Telegram
- Masuk kedalam bot [@kegiatan_ukmik_bot](https://t.me/kegiatan_ukmik_bot)
- Klik `start`
- Lalu klik `Daftar`
- Maka akan mendapat balasan berupa username dan password untuk login kedalam sistem.

Contoh daftar melalui telegram
![pendafataran berhasil](https://i.ibb.co/JsXdLqD/Screenshot-from-2021-11-19-19-56-11.png)
Ketika mengeklik `daftar` akan mendapat pesan berhasil, dan mendapat akun username dan password untuk masuk kedalam sistem.

![akun sudah terdaftar](https://i.ibb.co/vLgQGB0/Screenshot-from-2021-11-19-19-51-08.png)
Akun sudah terdaftar, ketika mengetikkan daftar akan mendapat pesan bahwa kamu telah melakukan pendaftaran.

### Alur Jika Lupa Password
- Admin harus login kedalam sistem
- Masuk ke navigasi Pengguna -> Semua Pengguna
- Cari pengguna yang bermasalah
- Klik tombol ![ubah data](https://i.ibb.co/WyqmTR6/Screenshot-from-2021-11-29-16-34-30.png)
- Lalu isikan password baru pada form `Password` dan `Konfirmasi Password`
- Klik simpan dan pastikan mendapat pesan berhasil.
- Berikan password baru kepada user yang bermasalah tadi

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


## List Perintah Bot
- `daftar` => Mendaftar akun pada sistem melalui BOT.
- `sudah ada akun` => Digunakan ketika ingin mentautkan akun dengan telegram, perintah ini akan memberikan bantuan untuk memperoleh kode undangan.
- `masukkan kode` => Digunakan setelah user mendapat kode undangan untuk mentautkan akun.
- `lihat kegiatan` => Melihat list Kegiatan yang terdaftar sesuai role.


## Screenshots

gambar gambar

## Lisensi

Project ini open source di bawah [lisensi MIT](LICENSE).


