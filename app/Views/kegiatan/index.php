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
            <div class="col-md-6 col-lg-4">
              <div class="card project-item">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title"><a href="#">SEO and Growth Project</a></h3>
                  <div class="right">
                    <span class="badge badge-success">RUNNING</span>
                  </div>
                </div>
                <div class="card-body">
                  <div class="left">
                    <div class="info">
                      <span class="title">DURATION</span>
                      <span class="value">Jul 23, 2017 - Oct 01, 2017</span>
                    </div>
                    <div class="info">
                      <span class="title">ESTIMATED VALUE</span>
                      <span class="value">$21,847</span>
                    </div>
                    <div class="info">
                      <span class="title">LEADER</span>
                      <span class="value"><img src="assets/images/people/male1.png" class="leader-picture" alt=""> Stephen Burke</span>
                    </div>
                  </div>
                  <div class="right">
                    <div class="progress-chart easy-pie-chart" data-percent="65">
                      <span class="percent">65%</span>
                    </div>
                    <div class="task">
                      <div class="task-progress">14/60 tasks completed</div>
                      <a href="#" class="btn btn-outline-light btn-sm"><i class="fa fa-plus"></i> Add Task</a>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="controls">
                    <a href="#"><i class="fa fa-eye"></i>View Details</a>
                    <a href="#"><i class="fa fa-cloud-download"></i>Download Project File</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <!-- TASKS -->
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <a href="<?= site_url("home/kegiatan/".$subnav."/tambah") ?>" title="Tambah Data" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-bordered">
                      <thead class="thead-light">
                        <tr>
                          <th>Nama</th>
                          <th>Tanggal</th>
                          <th>Lokasi</th>
                          <th>Banner</th>
                          <th>Kontak</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($kegiatans as $kegiatan):?>
                        <tr>
                          <td><?= $kegiatan['nama'] ?> </br><?= $kegiatan['deskripsi'] ?> </td>
                          <td><?= date("d F Y H:i", $kegiatan['tanggal']) ?></td>
                          <td><?= $kegiatan['lokasi'] ?></td>
                          <td><?= $kegiatan['banner'] ?></td>
                          <td>cp: <?= $kegiatan['cp1'] ?> </br>link: <?= $kegiatan['link1'] ?> </br></td>
                          <td>
                            <a href="<?= site_url('home/kegiatan/'.$subnav.'/ubah/'.$kegiatan['id']) ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a onclick="confirmation(event)" href="<?= site_url('home/kegiatan/'.$subnav.'/hapus/'.$kegiatan['id']) ?>" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach;?>
                      <tbody>
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

  <script src="<?= base_url() ?>/assets/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>

  <script>
  !function(o){"use strict";var t=function(){};t.prototype.init=function(){0<o(".progress-chart").length&&o(".progress-chart").easyPieChart({size:110,barColor:"#45AEEF",trackColor:"rgba(160, 174, 186, .2)",scaleColor:!1,lineWidth:6,lineCap:"round",animate:800}),0<o(".project-accordion").length&&o('.project-accordion [data-toggle="collapse"]').on("click",function(){o(this).find(".toggle-icon").toggleClass("fa-minus-circle fa-plus-circle")})},o.AppViewsProjects=new t,o.AppViewsProjects.Constructor=t}(window.jQuery),function(o){"use strict";window.jQuery.AppViewsProjects.init()}();
  </script>
  
</body>

</html>