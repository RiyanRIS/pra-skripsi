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
            <div class="col-sm-6">
            <div class="card">
              <div class="card-header">Kode Undangan Telegram</div>
                <div class="card-body">
                  <form>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kode</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control ui-autocomplete-input" id="input-code-64" placeholder="Klik dapatkan kode" autocomplete="off">
                        <button type="button" onClick="getCode()" class="btn btn-primary mt-3">Dapatkan Kode</button>
                      </div>
                    </div>
                  </form>
                </div>
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
  <script>
    function getCode(){
      let url = "<?= site_url("home/setting/getkode") ?>";
      let req = new XMLHttpRequest();
      req.open('GET', url);
      req.onload = function() {
        if (req.status == 200) {
          let kode = this.responseText.split("\"")
          document.getElementById('input-code-64').value = kode[1];
        } else {
          console.log("Error: " + req.status);
        }
      }
      req.send();
    }

  </script>
  
</body>

</html>