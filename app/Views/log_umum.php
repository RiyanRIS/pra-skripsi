<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIM KETIKA LOG</title>
</head>
<body>
  <h1>Log Sistem Manajemen Kegiatan</h1>
  <table border="1px">
    <tr>
      <td>Waktu</td>
      <td><?= date("d F Y, H:i", $data['time']) ?></td>
    </tr>
    <tr>
      <td>Users</td>
      <td><?= $nama ?></td>
    </tr>
    <tr>
      <td>Kegiatan yang dilakukan</td>
      <td><?= ucfirst($data['keterangan']) ?></td>
    </tr>
    <tr>
      <td>Sumber / Asal data</td>
      <td><?= $data['asal'] ?></td>
    </tr>
    <tr>
      <td>Table yang terpengaruh</td>
      <td><?= $data['nama_tabel'] ?></td>
    </tr>
    <tr>
      <td>Sebelum</td>
      <td><pre><?= $data['sebelum'] ?></pre></td>
    </tr>
    <tr>
      <td>Setelah</td>
      <td><pre><?= $data['sesudah'] ?></pre></td>
    </tr>
  </table>
</body>
</html>