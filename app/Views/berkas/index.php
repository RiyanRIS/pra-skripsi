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
                  Master Berkas
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>KEGIATAN</th>
                        <th>NAMA BERKAS</th>
                        <th>PERMISSION</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($berkas as $key) { ?>
                      <tr>
                        <td><?= getKegiatanById($key['kegiatan'])['nama'] ?></td>
                        <td><a href="<?= base_url("assets/berkas/kegiatan/".$key['link']) ?>"> <?= $key['nama'] ?>(<?= formatBytes($key['size']) ?>)</a></td>
                        <td><?= ucwords($key['permission']) ?></td>
                        <td>
                          <a onclick="confirmation(event)" href="<?= site_url('home/berkas/hapus/' . encrypt_url($key['id'])) ?>" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
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