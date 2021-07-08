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
            <div class="col-md-8">
              <div class="card">
                <div class="project-heading">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="media">
                      <?php if($kegiatan['banner'] == null){ ?>
                        <img height="64px" src="<?= urlImg('banner-kegiatan.png', "banner-kegiatan") ?>" class="mr-2" alt="Banner Kegiatan">
                      <?php }else{ ?>
                        <img height="64px" src="<?= urlImg($kegiatan['banner'], "banner-kegiatan") ?>" class="mr-2" alt="Banner Kegiatan">
                      <?php } ?>
                        <div class="media-body">
                          <h2 class="project-title"><?= $kegiatan['nama'] ?></h2>
                          <span class="badge badge-success status">Aktif</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 text-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Tambah <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                          <li><a href="#">Tahapan</a></li>
                          <li><a href="#">Tugas Harian</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="project-subheading">
                    <div class="layout-table project-metrics">
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">TANGGAL</span>
                          <span class="value"><?= date("d F Y", $kegiatan['tanggal']) ?></span>
                        </div>
                      </div>
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">TEMPAT</span>
                          <span class="value"><?= $kegiatan['lokasi'] ?></span>
                        </div>
                      </div>
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">EST. VALUE</span>
                          <span class="value">$21,847</span>
                        </div>
                      </div>
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">PROGRESS</span>
                          <div id="project-progress" class="progress progress-transparent custom-color-orange2">
                            <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width:85%;">85%</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="project-info">
                    <h3 class="info-heading">DESKRIPSI</h3>
                    <p class="project-description"><?= $kegiatan['deskripsi'] ?></p>
                    <p><b>Contact Person: </b><?= $kegiatan['cp1'] ?></p>
                    <p><b>Link: </b><?= $kegiatan['link1'] ?></p>
                  </div>

                  <div class="project-info">
                    <h3 class="info-heading">TAHAPAN KEGIATAN</h3>
                    <div class="panel-group accordion project-accordion" id="project-accordion">

                     <?= view("kegiatan/detail-tahapan") ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <?= view("kegiatan/detail-kepanitiaan") ?>
              <?= view("kegiatan/detail-berkas") ?>
              <?= view("kegiatan/detail-statistik") ?>
              
            </div>
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN -->

    <?= view("_template/footer.php") ?>
  <!-- LETAKKAN JAVASCRIPT TAMBAHAN DISINI -->
  <script src="<?= site_url('assets/js/detail.js') ?>"></script>
</body>

</html>