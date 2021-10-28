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
                  <div class="col-md-4">
                    <label class="switch-input">
                      <input type="checkbox" id="myCheckbox" name="switch-login" <?= ($setting_notif->login == 1 ? 'checked=""' : "") ?>>
                      <i data-swon-text="ON" data-swoff-text="OFF"></i>
                      Notifikasi Login
                    </label>
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
    // $("input[name='switch-login']").click(() => {
    //   if($(this).is(':checked')){
    //     alert("on")
    //   } else {
    //     alert("off");
    //   }
    // })
    const checkbox = document.getElementById('myCheckbox')

    checkbox.addEventListener('change', (event) => {
      if (event.currentTarget.checked) {
        $.ajax({
          url: "<?= site_url("home/notifikasi/login/on") ?>",
          method: "get",
          success: function(){
            // alert("done");
          }
        });
      } else {
        $.ajax({
          url: "<?= site_url("home/notifikasi/login/off") ?>",
          method: "get",
          success: function(){
            // alert("done");
          }
        });
      }
    })
  </script>
  <!-- Plugins -->

</body>

</html>