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
            <div class="col-sm-12 pb-3">
            <?php if(punyaAkses(['admin'])){ ?>
              <a href="<?= site_url("home/kegiatan/".$subnav."/tambah") ?>" title="Tambah Data" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Buat Kegiatan Baru</a>
            <?php } ?>
            <div class="form-row pt-2">
              <div class="col-md-4">
              <input type="date" value="<?= (@$dtawal ?: "") ?>" id="date1" class="form-control">
              </div>
              <div class="col-md-4">
              <input type="date" value="<?= (@$dtahir ?: "") ?>" id="date2" class="form-control">
              </div>
              <div class="col-md-4">
              <button id="btn-filter" class="btn btn-primary">Filter</button>
              <?php if(@$dtawal){ ?>
              <button id="btn-filter-reset" class="btn btn-info">Reset</button>
              <?php } ?>
              </div>
            </div>
            
            </div>
          <?php if(count($kegiatans)!=0){ foreach ($kegiatans as $kegiatan):?>
            <div class="col-md-6 col-lg-4">
              <div class="card project-item">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title"><a href="<?= site_url("home/kegiatan/detail/".encrypt_url($kegiatan['id'])) ?>"><?= $kegiatan['nama'] ?></a></h3>
                  <div class="right">
                    <?= buildStatusKegiatan($kegiatan['tanggal']) ?>
                  </div>
                </div>
                <div class="card-body">
                  <div class="left">
                    <div class="info">
                      <span class="title">WAKTU</span>
                      <span class="value"><?= date("d F Y H:i", $kegiatan['tanggal']) ?></span>
                    </div>
                    <div class="info">
                      <span class="title">TEMPAT</span>
                      <span class="value"><?= $kegiatan['lokasi'] ?></span>
                    </div>
                    <div class="info">
                      <span class="title">PENANGGUNGJAWAB</span>
                      <span class="value"><img src="assets/images/people/male1.png" class="leader-picture" alt=""><?= getUsersById($kegiatan['penanggungjawab'])['nama']; ?></span>
                    </div>
                  </div>
                  <div class="right">
                    <div class="info">
                      <span class="title">PESERTA KEGIATAN</span>
                      <span class="value"><?= getCountPesertaKegiatan($kegiatan['id']) ?> orang</span>
                    </div>
                    <div class="info">
                      <span class="title">TOTAL PANITIA</span>
                      <span class="value"><?= getCountPanitiaKegiatan($kegiatan['id']) ?> orang</span>
                    </div>

                  </div>
                </div>
                <div class="card-footer">
                  <div class="controls">
                    <a href="<?= site_url("home/kegiatan/detail/".encrypt_url($kegiatan['id'])) ?>"><i class="fa fa-eye"></i>Detail Kegiatan</a>
                    <!-- <a href="#"><i class="fa fa-cloud-download"></i>File Kegiatan</a> -->
                    <a href="javascript:void(0)" class="btn-detail-berkas" data-id="<?= $kegiatan['id'] ?>" data-url="<?= site_url('home/kegiatan/modal/detail-berkas') ?>"><i class="fa fa-cloud-download"></i>File Kegiatan</a>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; }else{ ?>
             <div class="col-sm-12 pb-3"> <p class="lead">Data Kegiatan Kosong.</p> </div>
            <?php } ?>
            
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN -->
    <div class="viewmodal"></div>

    <?= view("_template/footer.php") ?>
  <!-- LETAKKAN JAVASCRIPT TAMBAHAN DISINI -->
  <!-- Plugins -->

  <script src="<?= base_url() ?>/assets/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>

  <script>
  $("#btn-filter").click((e) => {
    e.preventDefault();
    const date1 = $("#date1").val()
    const date2 = $("#date2").val()
    window.location.href = "?awal="+ date1 +"&ahir=" + date2;
  })
  $("#btn-filter-reset").click((e) => {
    window.location.href = "?";
  })
  $('.btn-detail-berkas').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('data-url'),
      dataType: "json",
      type: 'POST',
      data: {
        id: $(this).attr('data-id')
      },
      success: function(response) {
        if (response.data) {
          $('.viewmodal').html(response.data).show()
          $('#tambah-berkas').modal('show')
        }
      },
      error: function(xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });
  </script>
  
</body>

</html>