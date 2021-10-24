    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
      <nav>
        <ul class="nav" id="sidebar-nav-menu">
          <li class="menu-group">Main</li>
          <li><a class="<?= nav('Dashboard',@$title) ?>" href="<?= site_url('home/dashboard') ?>" class=""><i class="ti-dashboard"></i> <span class="title">Dashboard</span></a></li>
          <li class="panel">
            <a href="#navkegiatan" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="false" class="<?= nav('Kegiatan',@$title) ?> collapsed"><i class="ti-calendar"></i> <span class="title">Kegiatan</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="navkegiatan" class="collapse <?= navshow('Kegiatan',@$title) ?>" style="">
              <ul class="submenu">
                <li><a href="<?= site_url("home/kegiatan/semua") ?>" class="<?= nav('semua',@$subnav) ?>">Semua Kegiatan</a></li>
                <li><a href="<?= site_url("home/kegiatan/umum") ?>" class="<?= nav('umum',@$subnav) ?>">Umum</a></li>
                <li><a href="<?= site_url("home/kegiatan/internal") ?>" class="<?= nav('internal',@$subnav) ?>">Internal</a></li>
              </ul>
            </div>
          </li>

          <li><a class="<?= nav('Notifikasi',@$title) ?>" href="#" class=""><i class="ti-light-bulb"></i> <span class="title">Pengingat</span></a></li>

          <li class="menu-group">Master Data</li>
          <li><a class="<?= nav('Master Kegiatan',@$title) ?>"  href="<?= site_url("home/kegiatan/master") ?>" class=""><i class="ti-calendar"></i> <span class="title">Master Kegiatan</span></a></li>
          <li class="panel">
            <a href="#pengguna" data-toggle="collapse" data-parent="#sidebar-nav-menu" aria-expanded="false" class="<?= nav('Pengguna',@$title) ?> collapsed"><i class="ti-user"></i> <span class="title">Pengguna</span> <i class="icon-submenu ti-angle-left"></i></a>
            <div id="pengguna" class="collapse <?= navshow('Pengguna',@$title) ?>" style="">
              <ul class="submenu">
                <li><a href="<?= site_url("home/pengguna") ?>" class="<?= nav('pengguna',@$subnav) ?>">Semua Pengguna</a></li>
                <li><a href="<?= site_url("home/pengurus") ?>" class="<?= nav('pengurus',@$subnav) ?>">Pengurus</a></li>
                <li><a href="<?= site_url("home/peserta") ?>" class="<?= nav('peserta',@$subnav) ?>">Peserta</a></li>
              </ul>
            </div>
          </li>

          <li><a class="<?= nav('Berkas',@$nav) ?>"  href="<?= site_url("home/berkas") ?>" class=""><i class="ti-files"></i> <span class="title">Berkas</span></a></li>
          
          <li class="menu-group">Setting</li>
          <li><a class="<?= nav('Pengaturan',@$nav) ?>" href="<?= site_url("home/setting") ?>" class=""><i class="ti-panel"></i> <span class="title">Dasar</span></a></li>
          <li><a class="<?= nav('Profil',@$nav) ?>" href="<?= site_url("home/profil") ?>" class=""><i class="ti-user"></i> <span class="title">Profil</span></a></li>
          <li><a class="<?= nav('Atur Notifikasi',@$nav) ?>"  href="widgets.html" class=""><i class="ti-bell"></i> <span class="title">Notifikasi</span></a></li>

        </ul>
        <button type="button" class="btn-toggle-minified" title="Toggle Minified Menu"><i class="ti-arrows-horizontal"></i></button>
      </nav>
    </div>
    <!-- END LEFT SIDEBAR -->