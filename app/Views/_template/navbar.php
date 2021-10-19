</head>
<body>
  <!-- WRAPPER -->
  <div id="wrapper">    
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand fixed-top">
      <div class="navbar-brand d-none d-lg-block">
        <a href="javascript:void(0)" class="brand-text">SIM-KETIKA</a>
      </div>
      <div class="container-fluid p-0">
        <button id="tour-fullwidth" type="button" class="btn btn-default btn-toggle-fullwidth"><i class="ti-menu"></i></button>
        <div id="navbar-menu">
          <ul class="nav navbar-nav align-items-center">

            <?= view("_template/notification.php") ?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?= urlImg(session()->user_ava, 'avatar') ?>" class="user-picture"" alt="Avatar"> <span><?= ucwords(session()->user_nama) ?></span></a>
              <ul class="dropdown-menu dropdown-menu-right logged-user-menu">
                <li><a href="<?= site_url("home/profil") ?>"><i class="ti-user"></i> <span>Profil Saya</span></a></li>
                <li><a href="appviews-inbox.html"><i class="ti-email"></i> <span>Message</span></a></li>
                <li><a href="<?= site_url('home/setting') ?>"><i class="ti-settings"></i> <span>Pengaturan</span></a></li>
                <li><a href="<?= site_url("auth/logout") ?>"><i class="ti-power-off"></i> <span>Keluar</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END NAVBAR -->