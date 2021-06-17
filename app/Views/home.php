<?= view("_template/atas.php") ?>
<style>
  .navbar-brand .brand-text{
    color: #fff;
    letter-spacing: 2px;
    font-weight:700;

  }
</style>
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

    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
      <nav>
        <ul class="nav" id="sidebar-nav-menu">
          <li class="menu-group">Main</li>
          <li class="panel">
            <a href="#dashboards" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="" class=""><i class="ti-dashboard"></i> <span class="title">Dashboards</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="dashboards" class="collapse  ">
              <ul class="submenu">
                <li><a href="index-2.html" class="">Dashboard v1</a></li>
                <li><a href="dashboard2.html" class="">Dashboard v2</a></li>
                <li><a href="dashboard3.html" class="">Dashboard v3</a></li>
                <li><a href="dashboard4.html" class="">Dashboard v4</a></li>
              </ul>
            </div>
          </li>
          <li class="panel">
            <a href="#subLayouts" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="" class=""><i class="ti-layout"></i> <span class="title">Layouts</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="subLayouts"  class="collapse  ">
              <ul class="submenu">
                <li><a href="layout-topnav.html" class="">Top Navigation</a></li>
                <li><a href="layout-minified.html" class="">Minified</a></li>
                <li><a href="layout-fullwidth.html" class="">Fullwidth</a></li>
                <li><a href="layout-default.html" class="">Default</a></li>
                <li><a href="layout-grid.html">Grid</a></li>
              </ul>
            </div>
          </li>
          <li class="panel">
            <a href="#forms" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="" class=""><i class="ti-receipt"></i> <span class="title">Forms</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="forms" class="collapse  ">
              <ul class="submenu">
                <li><a href="forms-inputs.html" class="">Inputs</a></li>
                <li><a href="forms-multiselect.html" class="">Multiselect</a></li>
                <li><a href="forms-input-pickers.html" class="">Input Pickers</a></li>
                <li><a href="forms-input-sliders.html" class="">Input Sliders</a></li>
                <li><a href="forms-select2.html" class="">Select2</a></li>
                <li><a href="forms-inplace-editing.html" class="">In-place Editing</a></li>
                <li><a href="forms-dragdropupload.html" class="">Drag and Drop Upload</a></li>
                <li><a href="forms-layouts.html" class="">Form Layouts</a></li>
                <li><a href="forms-validation.html" class="">Form Validation</a></li>
                <li><a href="forms-texteditor.html" class="">Text Editor</a></li>
              </ul>
            </div>
          </li>
          <li class="panel">
            <a href="#appViews" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="" class=""><i class="ti-layout-tab-window"></i> <span class="title">App Views</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="appViews" class="collapse  ">
              <ul class="submenu">
                <li><a href="appviews-project-detail.html" class="">Project Details</a></li>
                <li><a href="appviews-projects.html" class="">Projects</a></li>
                <li><a href="appviews-inbox.html" class="">Inbox <span class="badge badge-danger">8</span></a></li>
                <li><a href="appviews-file-manager.html" class="">File Manager</a></li>
              </ul>
            </div>
          </li>
          <li class="panel">
            <a href="#tables" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="" class=""><i class="ti-layout-grid2"></i> <span class="title">Tables</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="tables" class="collapse  ">
              <ul class="submenu">
                <li><a href="tables-static.html" class="">Static Tables</a></li>
                <li><a href="tables-dynamic.html" class="">Dynamic Tables</a></li>
              </ul>
            </div>
          </li>
          <li class="menu-group">Components</li>
          <li class="panel">
            <a href="#uiElements" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="" class=""><i class="ti-panel"></i> <span class="title">UI Elements</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="uiElements" class="collapse  ">
              <ul class="submenu">
                <li><a href="ui-sweetalert.html" class="">Sweet Alert 2</a></li>
                <li><a href="ui-treeview.html" class="">Tree View</a></li>
                <li><a href="ui-wizard.html" class="">Wizard</a></li>
                <li><a href="ui-dragdrop-panel.html" class="">Drag &amp; Drop Panel</a></li>
                <li><a href="ui-nestable.html" class="">Nestable</a></li>
                <li><a href="ui-gauge.html" class="">Gauge <span class="badge badge-success">NEW</span></a></li>
                <li><a href="ui-panels.html" class="">Panels</a></li>
                <li><a href="ui-progressbars.html" class="">Progress Bars</a></li>
                <li><a href="ui-tabs.html" class="">Tabs</a></li>
                <li><a href="ui-buttons.html" class="">Buttons <span class="badge badge-info">UPDATED</span></a></li>
                <li><a href="ui-bootstrap.html" class="">Bootstrap UI</a></li>
                <li><a href="ui-social-buttons.html" class="">Social Buttons</a></li>
                <li><a href="ui-icons.html" class="">Icons</a></li>
              </ul>
            </div>
          </li>
          <li class="panel">
            <a href="#charts" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="" class=""><i class="ti-pie-chart"></i> <span class="title">Charts</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="charts" class="collapse  ">
              <ul class="submenu">
                <li><a href="charts-chartjs.html" class="">Chart.js</a></li>
                <li><a href="charts-chartist.html" class="">Chartist</a></li>
                <li><a href="charts-flot.html" class="">Flot Chart</a></li>
                <li><a href="charts-sparkline.html" class="" >Sparkline Chart</a></li>
              </ul>
            </div>
          </li>
          <li><a href="widgets.html" class=""><i class="ti-widget"></i> <span class="title">Widgets</span></a></li>
          <li><a href="notifications.html" aria-expanded="" class=""><i class="ti-bell"></i> <span class="title">Notifications</span> <span class="badge badge-danger">15</span></a></li>
          <li class="panel">
            <a href="#maps" data-toggle="collapse" data-parent="#sidebar-nav-menu" class=""><i class="ti-map"></i> <span class="title">Maps</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="maps" class="collapse  ">
              <ul class="submenu">
                <li><a href="maps-jqvmap.html" class="">JQVMap</a></li>
                <li><a href="maps-mapael.html" class="">Mapael</a></li>
              </ul>
            </div>
          </li>
          <li class="menu-group">Extras</li>
          <li class="panel">
            <a href="#subPages" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="true" class="active"><i class="ti-files"></i> <span class="title">Pages</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="subPages" class="collapse show ">
              <ul class="submenu">
                <li><a href="page-profile.html" class="">Profile</a></li>
                <li><a href="page-login.html">Login</a></li>
                <li><a href="page-register.html">Register</a></li>
                <li><a href="page-lockscreen.html">Lockscreen</a></li>
                <li><a href="page-forgot-password.html">Forgot Password</a></li>
                <li><a href="page-404.html">Page 404</a></li>
                <li><a href="page-500.html">Page 500</a></li>
                <li><a href="page-blank.html" class="active">Blank Page</a></li>
              </ul>
            </div>
          </li>
          <li><a href="typography.html" class=""><i class="ti-paragraph"></i> <span class="title">Typography</span></a></li>
          <li class="panel">
            <a href="#" data-toggle="collapse" data-target="#submenuDemo" data-parent="#sidebar-nav-menu"><i class="ti-menu"></i> <span class="title">Multilevel Menu</span><i class="icon-submenu ti-angle-left"></i></a>
            <div id="submenuDemo" class="collapse">
              <ul class="submenu">
                <li class="panel">
                  <a href="#" data-toggle="collapse" data-target="#submenuDemoLv2">Submenu 1 <i class="icon-submenu ti-angle-left"></i></a>
                  <div id="submenuDemoLv2" class="collapse">
                    <ul class="submenu">
                      <li><a href="#">Another menu level</a></li>
                      <li><a href="#" class="active">Another menu level</a></li>
                      <li><a href="#">Another menu level</a></li>
                    </ul>
                  </div>
                </li>
                <li><a href="#">Submenu 2</a></li>
                <li><a href="#">Submenu 3</a></li>
              </ul>
            </div>
          </li>
        </ul>
        <button type="button" class="btn-toggle-minified" title="Toggle Minified Menu"><i class="ti-arrows-horizontal"></i></button>
      </nav>
    </div>
    <!-- END LEFT SIDEBAR -->

    <!-- MAIN -->
    <div class="main">

      <!-- MAIN CONTENT -->
      <div class="main-content">

        <div class="content-heading">
          <div class="heading-left">
            <h1 class="page-title">Blank Page</h1>
            <p class="page-subtitle">Create your new page based on this starter page.</p>
          </div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Parent</a></li>
              <li class="breadcrumb-item active">Current</li>
            </ol>
          </nav>
        </div>

        <div class="container-fluid">
          <!-- your content goes here -->
        </div>
      </div>
      <!-- END MAIN CONTENT -->

      <!-- RIGHT SIDEBAR -->
      <div id="sidebar-right" class="right-sidebar">
        <div class="sidebar-widget">
          <h4 class="widget-heading"><i class="fa fa-calendar"></i> TODAY</h4>
          <p class="date">Wednesday, 22 December</p>

          <div class="row mt-4">
            <div class="col-4">
              <a href="#">
                <div class="icon-transparent-area custom-color-blue first">
                  <i class="fa fa-tasks"></i> <span>Tasks</span>
                  <span class="badge">5</span>
                </div>
              </a>
            </div>
            <div class="col-4">
              <a href="#">
                <div class="icon-transparent-area custom-color-green">
                  <i class="fa fa-envelope"></i> <span>Mail</span>
                  <span class="badge">12</span>
                </div>
              </a>
            </div>
            <div class="col-4">
              <a href="#">
                <div class="icon-transparent-area custom-color-orange last">
                  <i class="fa fa-user-plus"></i> <span>Users</span>
                  <span class="badge">24</span>
                </div>
              </a>
            </div>
          </div>
        </div>
  
        <div class="sidebar-widget">
          <div class="widget-header">
            <h4 class="widget-heading">YOUR APPS</h4>
            <a href="#" class="show-all">Show all</a>
          </div>
          <div class="row">
            <div class="col-3">
              <a href="#" class="icon-app" title="Dropbox" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-dropbox dropbox-color"></i>
              </a>
            </div>
            <div class="col-3">
              <a href="#" class="icon-app" title="WordPress" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-wordpress wordpress-color"></i>
              </a>
            </div>
            <div class="col-3">
              <a href="#" class="icon-app" title="Drupal" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-drupal drupal-color"></i>
              </a>
            </div>
            <div class="col-3">
              <a href="#" class="icon-app" title="Github" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-github github-color"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="sidebar-widget">
          <div class="widget-header">
            <h4 class="widget-heading">MY PROJECTS</h4>
            <a href="#" class="show-all">Show all</a>
          </div>
          <ul class="list-unstyled list-project-progress">
            <li>
              <a href="#" class="project-name">Project XY</a>
              <div class="progress progress-transparent custom-color-orange">
                <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width:67%;"></div>
              </div>
              <span class="percentage">67%</span>
            </li>
            <li>
              <a href="#" class="project-name">Growth Campaign</a>
              <div class="progress progress-transparent custom-color-blue">
                <div class="progress-bar" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width:23%"></div>
              </div>
              <span class="percentage">23%</span>
            </li>
            <li>
              <a href="#" class="project-name">Website Redesign</a>
              <div class="progress progress-transparent custom-color-green">
                <div class="progress-bar" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width:87%"></div>
              </div>
              <span class="percentage">87%</span>
            </li>
          </ul>
        </div>

        <div class="sidebar-widget">
          <div class="widget-header">
            <h4 class="widget-heading">MY FILES</h4>
            <a href="#" class="show-all">Show all</a>
          </div>
          <ul class="list-unstyled list-justify list-file-simple">
            <li><a href="#"><i class="fa fa-file-word-o"></i>Proposal_draft.docx</a> <span>4 MB</span></li>
            <li><a href="#"><i class="fa fa-file-pdf-o"></i>Manual_Guide.pdf</a> <span>20 MB</span></li>
            <li><a href="#"><i class="fa fa-file-zip-o"></i>all-project-files.zip</a> <span>315 MB</span></li>
            <li><a href="#"><i class="fa fa-file-excel-o"></i>budget_estimate.xls</a> <span>1 MB</span></li>
          </ul>
        </div>

        <p class="text-center"><a href="#" class="btn btn-primary btn-sm">More Widgets</a></p>
      </div>
      <!-- END RIGHT SIDEBAR -->

    </div>
    <!-- END MAIN -->

    <div class="clearfix"></div>
    
    <!-- footer -->
    <footer>
      <div class="container-fluid">
        <p class="copyright">&copy; 2020 <a href="https://www.themeineed.com/" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
      </div>
    </footer>
    <!-- end footer -->

    <!-- DEMO PANEL -->
    	<!-- for demo purpose only, you should remove it on your project directory -->
    	<script type="text/javascript">
    		var toggleDemoPanel = function(e) {
    			e.preventDefault();

    			var panel = document.getElementById( 'demo-panel' );
    			if ( panel.className ) panel.className = '';
    			else panel.className = 'active';
    		}
    	</script>

    	<div id="demo-panel">
    		<a href="#" onclick="toggleDemoPanel(event);"><i class="fa fa-cog fa-spin"></i></a>
    		<iframe src="demo-panel.html"></iframe>
    	</div>
    	<!-- END DEMO PANEL -->

  </div>
  <!-- END WRAPPER -->

  <!-- Vendor -->
  <script src="<?= base_url() ?>/assets/js/vendor.min.js"></script>

  <!-- App -->
  <script src="<?= base_url() ?>/assets/js/app.min.js"></script>
</body>

<!-- Mirrored from demo.thedevelovers.com/dashboard/klorofilpro-v2.0/page-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Apr 2021 12:12:15 GMT -->
</html>