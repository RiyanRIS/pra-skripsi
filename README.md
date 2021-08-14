# SISTEM INFORMASI MANAJEMEN KEGIATAN UKM INFORMATIKA DAN KOMPUTER

Sistem ini dibuat untuk memenuhi tugas ahir skripsi. Solusi yang ditawarkan adalah dengan membuat sistem yang terintegrasi dengan Bot sebagai pengingat.




### Users

ROLE:

Admin, Pengurus, Pengawas, Peserta

Admin::akses(){
  Admin mendapat full fitur dari sistem ini.
}

Pengurus::akses()
{
  Pengurus kegiatan memiliki akes ke seluruh aktivias kegiatan, termasuk menghapus. namun pengurus hanya memiliki akses ke kegiatan yang sedang dia urus.
}

Pengawas::akses()
{
  Pengawas hanya bisa melihat detail ataupun aktivitas kegiatan yang sedang berjalan.
}

Peserta::akses()
{
  Peserta hanya dapat mengakses detail kegiatan yang sedang atau pernah dia ikuti. Peserta akan mendapat pesan perkembangan kegiatan atau informasi lain terkait kegiatan yang diadakan oleh UKM.
}

## INSTALASI
- Clone repo ini.
- Buka terminal arahkan ke direktori folder.
- Jalankan ```composer update```.
- Buat **database** bernama `pra_skripsi`.
- Rename env menjadi .env(ada titik didepan).
- Jalankan ```php spark migrate```.
- Jalankan `php spark db:seed MySeeder`.

