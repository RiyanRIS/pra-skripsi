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
            <div class="col-12">
              <!-- TASKS -->
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  Atur Notifikasi
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <p>Umum</p>
                      <label class="switch-input">
                        <input type="checkbox" onclick="login(this)" id="sw-login" name="switch-login" <?= ($setting_notif->login == 1 ? 'checked=""' : "") ?>>
                        <i data-swon-text="ON" data-swoff-text="OFF"></i>
                        Notifikasi Login
                      </label>
                    </div>
                    <div class="col-md-4">
                      <p>Notifikasi Kegiatan</p>
                      <label class="switch-input">
                        <input type="checkbox" onclick="kegpan(this)" id="sw-kegpan" name="switch-kegpan" <?= ($setting_notif->keg_pan == 1 ? 'checked=""' : "") ?>>
                        <i data-swon-text="ON" data-swoff-text="OFF"></i>
                        Kepanitiaan
                      </label>
                      <label class="switch-input">
                        <input type="checkbox" onclick="kegtug(this)" id="sw-kegtug" name="switch-kegtug" <?= ($setting_notif->keg_tug == 1 ? 'checked=""' : "") ?>>
                        <i data-swon-text="ON" data-swoff-text="OFF"></i>
                        Tugas/task
                      </label>
                      <label class="switch-input">
                        <input type="checkbox" onclick="kegber(this)" id="sw-kegber" name="switch-kegber" <?= ($setting_notif->keg_ber == 1 ? 'checked=""' : "") ?>>
                        <i data-swon-text="ON" data-swoff-text="OFF"></i>
                        Berkas update
                      </label>
                      <label class="switch-input">
                        <input type="checkbox" onclick="kegpes(this)" id="sw-kegpes" name="switch-kegpes" <?= ($setting_notif->keg_pes == 1 ? 'checked=""' : "") ?>>
                        <i data-swon-text="ON" data-swoff-text="OFF"></i>
                        Peserta
                      </label>
                    </div>
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
  <script>
    toastr.options = {
      "timeOut": "3000",
    }

    function login(e){
      if (e.checked) {
        $.ajax({
          url: "<?= site_url("home/notifikasi/login/on") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi login telah diaktifkan", 'Berhasil');
          }
        });
      } else {
        $.ajax({
          url: "<?= site_url("home/notifikasi/login/off") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi login telah dinonaktifkan", 'Berhasil');
          }
        });
      }
    }

    function kegpan(e){
      if (e.checked) {
        $.ajax({
          url: "<?= site_url("home/notifikasi/kegiatan/panitia/on") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi panitia kegiatan telah diaktifkan", 'Berhasil');
          }
        });
      } else {
        $.ajax({
          url: "<?= site_url("home/notifikasi/kegiatan/panitia/off") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi panitia kegiatan telah dinonaktifkan", 'Berhasil');
          }
        });
      }
    }

    function kegtug(e){
      if (e.checked) {
        $.ajax({
          url: "<?= site_url("home/notifikasi/kegiatan/tugas/on") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi tugas/task kegiatan telah diaktifkan", 'Berhasil');
          }
        });
      } else {
        $.ajax({
          url: "<?= site_url("home/notifikasi/kegiatan/tugas/off") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi tugas/task kegiatan telah dinonaktifkan", 'Berhasil');
          }
        });
      }
    }

    function kegber(e){
      if (e.checked) {
        $.ajax({
          url: "<?= site_url("home/notifikasi/kegiatan/berkas/on") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi berkas kegiatan telah diaktifkan", 'Berhasil');
          }
        });
      } else {
        $.ajax({
          url: "<?= site_url("home/notifikasi/kegiatan/berkas/off") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi berkas kegiatan telah dinonaktifkan", 'Berhasil');
          }
        });
      }
    }

    function kegpes(e){
      if (e.checked) {
        $.ajax({
          url: "<?= site_url("home/notifikasi/kegiatan/peserta/on") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi peserta kegiatan telah diaktifkan", 'Berhasil');
          }
        });
      } else {
        $.ajax({
          url: "<?= site_url("home/notifikasi/kegiatan/peserta/off") ?>",
          method: "get",
          success: function(){
            toastr.info("Notifikasi peserta kegiatan telah dinonaktifkan", 'Berhasil');
          }
        });
      }
    }
  </script>
  <!-- Plugins -->

</body>

</html>