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
5. [Alur Kegiatan](#alur-kegiatan)
    - [Tugas](#tugas)
    - [Panitia](#panitia)
    - [Berkas](#berkas)
    - [Peserta](#peserta)
6. [Screenshots](#screenshots)
7. [Lisensi](#license)

<hr>

## Fitur

Fitur pada Aplikasi ini meliputi:

1. Akun Login
    - Register Melalui Admin atau [Telegram](#reg-tele)
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

| URL | http://grosir-obat.nafies.id/login |
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

## Alur Kegiatan

Kegiatan dapat dibuat oleh user yang memiliki role `admin, pengurus ataupun pengawas`. Dengan cara membuka halaman kegiatan dan klik `Buat Kegiatan Baru`. Lalu isi form pembuatan kegiatan dan klik `Simpan`

### Tugas

Tugas adalah task kecil untuk setiap kegiatan yang perlu dikerjakan oleh panitia.
    
### Panitia

### Berkas

### Peserta

### Reg Tele
- Masuk kedalam bot [@kegiatan_ukmik_bot](https://t.me/kegiatan_ukmik_bot)
- Tulis pesan ```Daftar``` lalu kirim
- 


