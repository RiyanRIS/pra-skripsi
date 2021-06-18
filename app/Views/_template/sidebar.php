    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
      <nav>
        <ul class="nav" id="sidebar-nav-menu">
          <li class="menu-group">Main</li>
          <li><a class="<?= nav('Dashboard',@$title) ?>" href="<?= site_url('home/dashboard') ?>" class=""><i class="ti-widget"></i> <span class="title">Dashboard</span></a></li>
          <li><a class="<?= nav('Kegiatan',@$title) ?>" href="widgets.html" class=""><i class="ti-widget"></i> <span class="title">Kegiatan</span></a></li>
          <li><a class="<?= nav('Notifikasi',@$title) ?>" href="widgets.html" class=""><i class="ti-widget"></i> <span class="title">Notifikasi</span></a></li>
          <li><a class="<?= nav('Chat',@$title) ?>" href="widgets.html" class=""><i class="ti-widget"></i> <span class="title">Chat</span></a></li>

          <li class="menu-group">Master Data</li>
          <li><a class="<?= nav('Pengguna',@$title) ?>" href="<?= site_url("home/pengguna") ?>" class=""><i class="ti-widget"></i> <span class="title">Users</span></a></li>
          <li><a class="<?= nav('Peserta',@$nav) ?>"  href="widgets.html" class=""><i class="ti-widget"></i> <span class="title">Peserta</span></a></li>
          <li><a class="<?= nav('Berkas',@$nav) ?>"  href="widgets.html" class=""><i class="ti-widget"></i> <span class="title">Berkas</span></a></li>

          <li class="menu-group">Setting</li>
          <li><a class="<?= nav('Pengaturan',@$nav) ?>"  href="widgets.html" class=""><i class="ti-widget"></i> <span class="title">Setting</span></a></li>
          <li><a class="<?= nav('Atur Notifikasi',@$nav) ?>"  href="widgets.html" class=""><i class="ti-widget"></i> <span class="title">Notifikasi</span></a></li>

        </ul>
        <button type="button" class="btn-toggle-minified" title="Toggle Minified Menu"><i class="ti-arrows-horizontal"></i></button>
      </nav>
    </div>
    <!-- END LEFT SIDEBAR -->