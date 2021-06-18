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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="https://i.imgur.com/M701HZb.jpg" class="user-picture"" alt="Avatar"> <span>Samuel</span></a>
              <ul class="dropdown-menu dropdown-menu-right logged-user-menu">
                <li><a href="#"><i class="ti-user"></i> <span>My Profile</span></a></li>
                <li><a href="appviews-inbox.html"><i class="ti-email"></i> <span>Message</span></a></li>
                <li><a href="#"><i class="ti-settings"></i> <span>Settings</span></a></li>
                <li><a href="page-lockscreen.html"><i class="ti-power-off"></i> <span>Logout</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END NAVBAR -->