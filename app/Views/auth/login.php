<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
  <title>Login | SIMKETIKA</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <!-- Notifications css -->
  <link href="<?= base_url() ?>/assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="<?= base_url() ?>/assets/css/bootstrap-custom.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url() ?>/favicon.ico">
</head>
<body>
  <!-- WRAPPER -->
  <?php
  $is_inv_username = (@$err['username'] ? 'is-invalid' : '');
  $is_inv_password = (@$err['password'] ? 'is-invalid' : '');
  ?>
  <div id="wrapper" class="d-flex align-items-center justify-content-center">
    <div class="auth-box ">
      <div class="left">
        <div class="content">
          <div class="header">
            <div class="logo text-center"></div>
            <p class="lead">Masuk ke akun anda</p>
          </div>
          <?= form_open('', ["class" => "form-auth-small"]) ?>
            <div class="form-group">
              <label for="signin-username" class="control-label sr-only">Username</label>
              <input type="text" name="username" autofocus="true" autofill="false" class="form-control <?= $is_inv_username ?>" required="true" id="signin-username" placeholder="Username" value="<?= @$username ?>">
              <div class="invalid-feedback">
                Username masih kosong
              </div>
            </div>
            <div class="form-group">
              <label for="signin-password" class="control-label sr-only">Password</label>
              <input type="password" name="password" class="form-control <?= $is_inv_password ?>" id="signin-password" required="true" placeholder="Password">
              <div class="invalid-feedback">
                Password masih kosong
              </div>
            </div>
            <div class="form-group">
              <label class="fancy-checkbox element-left custom-bgcolor-blue">
                <input type="checkbox" name="ingatsaya">
                <span class="text-muted">Ingat saya</span>
              </label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Masuk</button>
            <div class="bottom">
              <span class="helper-text d-block">Belum memiliki akun? <a href="<?= site_url("auth/daftar") ?>">Daftar</a></span>
              <span class="helper-text"><i class="fa fa-lock"></i> <a href="<?= site_url("auth/lupa-password") ?>">Lupa password?</a></span>
            </div>
          <?= form_close() ?>
        </div>
      </div>
      <div class="right">
        <div class="overlay"></div>
        <div class="content text">
          <h1 class="heading">SIM KETIKA</h1>
          <p>(Sistem Informasi Manajemen Kegiatan UKM Informatika & Komputer)</p>
        </div>
      </div>
    </div>
  </div>
  <!-- END WRAPPER -->

  <!-- Vendor -->
  <script src="<?= base_url() ?>/assets/js/vendor.min.js"></script>

  <!-- Notifications Plugin -->
  <script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>

  <script>
  <?php if(session()->has('msg')){
    if(session()->get('msg')[0] == 1){ ?>
        toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
    <?php }elseif(session()->get('msg')[0] == 0){ ?>
        toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
    <?php }
  } ?>
  </script>
</body>

</html>