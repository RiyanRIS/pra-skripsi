<?= view("_template/atas.php") ?>
<!-- LETAKKAN STYLE TAMBAHAN DISINI -->

    <?= view("_template/navbar.php") ?>
    <?= view("_template/sidebar.php") ?>

    <!-- MAIN -->
    <div class="main">

      <!-- MAIN CONTENT -->
      <div class="main-content">

        <?= view("_template/contenthead.php") ?>

        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- TASKS -->
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                <?php if(punyaAkses(['admin'])){ ?>
                  <a href="<?= site_url("home/kegiatan/".$subnav."/tambah") ?>" title="Tambah Data" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                <?php } ?>
                </div>
                <div class="card-body">
                  <!-- <div class="table-responsive"> -->
                    <table id="datatable" class="table table-hover table-bordered">
                      <thead class="thead-light">
                        <tr>
                          <th>Nama</th>
                          <th>Tanggal</th>
                          <th>Lokasi</th>
                          <th>Banner</th>
                          <th>Kontak</th>
                          <?php if(punyaAkses(['admin'])){ ?>
                          <th>#</th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($kegiatans as $kegiatan):?>
                        <tr>
                          <td><h4><a href="<?= site_url('home/kegiatan/detail/'.encrypt_url($kegiatan['id'])) ?>"><?= $kegiatan['nama'] ?></a></h4> </br><?= $kegiatan['deskripsi'] ?> </td>
                          <td style="min-width:150px"><?= date("d F Y H:i", $kegiatan['tanggal']) ?></td>
                          <td><?= $kegiatan['lokasi'] ?></td>
                          <td><img width="64px" src="<?= urlImg($kegiatan['banner'], "banner-kegiatan") ?>" alt=""></td>
                          <td>cp: <?= $kegiatan['cp1'] ?> </br>link: <?= $kegiatan['link1'] ?> </td>
                          <?php if(punyaAkses(['admin'])){ ?>
                          <td style="min-width:120px">
                            <a href="<?= site_url('home/kegiatan/'.$subnav.'/ubah/'.encrypt_url($kegiatan['id'])) ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a onclick="confirmation(event)" href="<?= site_url('home/kegiatan/'.$subnav.'/hapus/'.$kegiatan['id']) ?>" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          </td>
                          <?php } ?>
                        </tr>
                        <?php endforeach;?>
                      <tbody>
                    </table>
                  <!-- </div> -->
                </div>
              </div>
              <!-- END TASKS -->
            </div>
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN -->

    <?= view("_template/footer.php") ?>
  <!-- LETAKKAN JAVASCRIPT TAMBAHAN DISINI -->
  <!-- Plugins -->

</body>

</html>