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
          <!-- your content goes here -->
          <div class="row">
                <div class="col-md-4">
                  <div class="widget widget-metric_8">
                    <div class="heading clearfix">
                      <span class="title">TOTAL KEGIATAN</span>
                      <!-- <div class="dropdown">
                        <a href="#" class="toggle-dropdown" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#"><i class="fa fa-refresh"></i> Refresh</a></li>
                          <li><a href="#"><i class="fa fa-pencil"></i> Modify</a></li>
                        </ul>
                      </div> -->
                    </div>
                    <i class="ti-truck custom-text-blue4"></i> <span class="value">12</span>
                    <div class="progress progress-transparent custom-color-blue4" style="height: 5px;">
                      <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <!-- <p class="info">115 miles remanining</p> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="widget widget-metric_8">
                    <div class="heading clearfix">
                      <span class="title">TOTAL PENGGUNA</span>
                      <!-- <div class="dropdown">
                        <a href="#" class="toggle-dropdown" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#"><i class="fa fa-refresh"></i> Refresh</a></li>
                          <li><a href="#"><i class="fa fa-pencil"></i> Modify</a></li>
                        </ul>
                      </div> -->
                    </div>
                    <i class="ti-package custom-text-purple"></i> <span class="value">94</span>
                    <div class="progress progress-transparent custom-color-purple" style="height: 5px;">
                      <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                    <!-- <p class="info">You have 522 free space</p> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="widget widget-metric_8">
                    <div class="heading clearfix">
                      <span class="title">TOTAL PESAN</span>
                      <!-- <div class="dropdown">
                        <a href="#" class="toggle-dropdown" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#"><i class="fa fa-refresh"></i> Refresh</a></li>
                          <li><a href="#"><i class="fa fa-pencil"></i> Modify</a></li>
                        </ul>
                      </div> -->
                    </div>
                    <i class="ti-settings custom-text-green3"></i> <span class="value">1340</span>
                    <div class="progress progress-xs progress-transparent custom-color-green3" style="height: 5px;">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <!-- <p class="info"><i class="ti-arrow-up icon-change"></i> +15% than last month</p> -->
                  </div>
                </div>
              </div>
        </div>
      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN -->

    <?= view("_template/footer.php") ?>
  <!-- LETAKKAN JAVASCRIPT TAMBAHAN DISINI -->

  
</body>

</html>