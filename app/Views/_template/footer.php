    <div class="clearfix"></div>
    
    <!-- footer -->
    <footer>
      <div class="container-fluid">
        <p class="copyright">&copy; <?= date('Y') ?> <a href="https://t.me/kodokkayang" target="_blank">simketika</a>. v1.0.0</p>
      </div>
    </footer>
    <!-- end footer -->

  </div>
  <!-- END WRAPPER -->

  <!-- Vendor -->
  <script src="<?= base_url() ?>/assets/js/vendor.min.js"></script>
  
  <!-- Datables Core -->
  <script src="<?= base_url() ?>/assets/plugins/datatables.net/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.js"></script>
  
  <!-- Sweet Alerts Plugin -->
  <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Select2 Plugin -->
  <script src="<?= base_url() ?>/assets/plugins/select2/select2.min.js"></script>

  <!-- Notifications Plugin -->
  <script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>

  <!-- App -->
  <script src="<?= base_url() ?>/assets/js/app.min.js"></script>

  <script>
  $("#datatable").DataTable({order:[]});

  <?php if(session()->has('msg')){
    if(session()->get('msg')[0] == 1){ ?>
        toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
    <?php }elseif(session()->get('msg')[0] == 0){ ?>
        toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
    <?php }
  } ?>
  
  function confirmation(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');
    Swal.fire({
      title: 'Apakah kamu yakin?',
      text: "Tindakan ini tidak dapat dibatalkan..",
      icon: 'warning',
      showCancelButton: true,
    })
    .then(function(t){
      if(t.value){
        window.location.href=urlToRedirect
      }else{

      }
    });
  }


  </script>