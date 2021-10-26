<?= view("_template/atas.php") ?>
<!-- LETAKKAN STYLE TAMBAHAN DISINI -->
<!-- Uploader Styles -->
  <link href="<?= base_url() ?>/assets/plugins/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

    <?= view("_template/navbar.php") ?>
    <?= view("_template/sidebar.php") ?>

    <!-- MAIN -->
    <div class="main">

      <!-- MAIN CONTENT -->
      <div class="main-content">

        <?= view("_template/contenthead.php") ?>

        <div class="container-fluid">
          <div class="row">
           <?php if(count($kegiatan) == 0){ ?> 
            <div class="col-md-12">
              <h4>Kegiatan yang anda cari tidak ditemukan.</h4>
            </div>
           <?php }else{ ?>
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
                          <h2 class="project-title"><?= ucwords($kegiatan['nama']) ?></h2>
                          <span class="badge badge-success status">Aktif</span>
                        </div>
                      </div>
                    </div>
                    <?php if(punyaAkses(['admin', 'pengawas', 'pengurus'])){ ?>
                      <div class="col-md-3 text-right">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Atur <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li><a href="<?= site_url('home/kegiatan/detail/ubah/'.encrypt_url($id)) ?>">Ubah Kegiatan</a></li>
                            <li><a href="javascript:void(0)" title="Tambah Tugas" id="btn-tambah-tugas" data-id="<?= $id ?>" data-url="<?= site_url('home/kegiatan/modal/tambah-tugas') ?>">Tambah Tugas</a></li>
                            <hr>
                            <li><a href="<?= site_url('home/kegiatan/detail/cek-aktivitas/'.encrypt_url($id)) ?>">Log Aktivitas</a></li>
                          </ul>
                        </div>
                      </div>
                    <?php } else if(punyaAksesKegiatan(session()->user_id, $kegiatan['id'])){ ?>
                      <div class="col-md-3 text-right">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Atur <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li><a href="javascript:void(0)" title="Tambah Tugas" id="btn-tambah-tugas" data-id="<?= $id ?>" data-url="<?= site_url('home/kegiatan/modal/tambah-tugas') ?>">Tambah Tugas</a></li>
                          </ul>
                        </div>
                      </div>
                    <?php } ?>
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
                          <span class="title">PESERTA KEGIATAN</span>
                          <span class="value"><?= $total_peserta ?> orang</span>
                        </div>
                      </div>
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">TOTAL PANITIA</span>
                          <div class="value"><?= $total_panitia ?> orang</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="project-info">
                    <h3 class="info-heading">INFORMASI</h3>
                    <p class="project-description"><?= ($kegiatan['deskripsi']?: "-") ?></p>
                    <h3 class="info-heading">CONTACT PERSON: </h3>
                    <p class="project-description"><?= $kegiatan['cp1'] ?> <br><?= $kegiatan['cp2'] ?> </p>
                    <h3 class="info-heading">LINK: </h3>
                    <p class="project-description"><?= $kegiatan['link1'] ?></p>
                  </div>
                  <?php if(punyaAkses(['admin', 'pengawas', 'pengurus']) || punyaAksesKegiatan(session()->user_id, $kegiatan['id'])){ ?>
                  <?= view("kegiatan/detail-tugas") ?>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <?= view("kegiatan/detail-kepanitiaan") ?>
              <?php if(punyaAkses(['admin', 'pengawas', 'pengurus']) || punyaAksesKegiatan(session()->user_id, $kegiatan['id'])){ ?>
              <?= view("kegiatan/detail-berkas") ?>
              <?php } ?>
              <?= view("kegiatan/detail-peserta") ?>
              
            </div>
          <?php } ?>
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN -->

    <?= view("_template/footer.php") ?>
  <!-- LETAKKAN JAVASCRIPT TAMBAHAN DISINI -->
  <script src="<?= base_url() ?>/assets/plugins/dropify/js/dropify.min.js"></script>
  <script src="<?= site_url('assets/js/detail.js') ?>"></script>
</body>

</html>