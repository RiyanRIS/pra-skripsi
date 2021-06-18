<?= view("_template/atas.php") ?>
<!-- LETAKKAN STYLE TAMBAHAN DISINI -->
<style>
  /* HIDE RADIO */
  .radioimg { 
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* IMAGE STYLES */
  .radioimg + img {
    cursor: pointer;
  }

  /* CHECKED STYLES */
  .radioimg:checked + img {
    outline: 2px solid #000;
  }
</style>
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
                  <a href="<?= site_url('home/'.$subnav) ?>" title="Kembali" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                  <?= form_open_multipart(uri_string()) ?>
                  <?= form_hidden('id', $id);?>
                   <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $nama['label'] ?></label>
                      <div class="col-md-10">
                        <input type="text" name="<?= $nama['name'] ?>" id="<?= $nama['name'] ?>" class="form-control <?= (@$errors['nama']?'is-invalid':'') ?>" placeholder="<?= $nama['placeholder'] ?>" required="true" value="<?= $nama['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['nama'] ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label">Avatar</label>
                      <div class="col-md-10">
                        <label>
                          <input <?= ($ava!="1.png"?:"checked") ?> type="radio" class="radioimg" required="" name="ava" value="1.png">
                          <img width="64px" src="<?= base_url('assets/images/avatar/1.png') ?>">
                        </label>
                        <label>
                          <input <?= ($ava!="2.png"?:"checked") ?> type="radio" class="radioimg" required="" name="ava" value="2.png">
                          <img width="64px" src="<?= base_url('assets/images/avatar/2.png') ?>">
                        </label>
                        <label>
                          <input <?= ($ava!="3.png"?:"checked") ?> type="radio" class="radioimg" required="" name="ava" value="3.png">
                          <img width="64px" src="<?= base_url('assets/images/avatar/3.png') ?>">
                        </label>
                        <label>
                          <input <?= ($ava!="4.png"?:"checked") ?> type="radio" class="radioimg" required="" name="ava" value="4.png">
                          <img width="64px" src="<?= base_url('assets/images/avatar/4.png') ?>">
                        </label>
                        <label>
                          <input <?= ($ava!="5.png"?:"checked") ?> type="radio" class="radioimg" required="" name="ava" value="5.png">
                          <img width="64px" src="<?= base_url('assets/images/avatar/5.png') ?>">
                        </label>
                        <label>
                          <input <?= ($ava!="6.png"?:"checked") ?> type="radio" class="radioimg" required="" name="ava" value="6.png">
                          <img width="64px" src="<?= base_url('assets/images/avatar/6.png') ?>">
                        </label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $username['label'] ?></label>
                      <div class="col-md-10">
                        <input type="text" name="<?= $username['name'] ?>" id="<?= $username['name'] ?>" class="form-control <?= (@$errors['username']?'is-invalid':'') ?>" placeholder="<?= $username['placeholder'] ?>" required="true" value="<?= $username['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['username'] ?>
                        </div>
                      </div>
                    </div>
                    
                    <?php if($subnav=="pengguna"): ?>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $role['label'] ?></label>
                      <div class="col-md-10">
                        <select required="true" name="<?= $role['name'] ?>" class="form-control">
                          <option <?= ($role['value']!='admin'?:'selected') ?> value="admin">Admin</option>
                          <option <?= ($role['value']!='pengurus'?:'selected') ?> value="pengurus">Pengurus</option>
                          <option <?= ($role['value']!='pengawas'?:'selected') ?> value="pengawas">Pengawas</option>
                          <option <?= ($role['value']!='peserta'?:'selected') ?> value="peserta">Peserta</option>
                        </select>
                      </div>
                    </div>
                    <?php   
                    elseif($subnav=="pengurus"): 
                      echo form_hidden("role", "pengurus");
                    elseif($subnav=="peserta"):
                      echo form_hidden("role", "peserta");
                    endif ?>

                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $nohp['label'] ?></label>
                      <div class="col-md-10">
                        <input type="text" name="<?= $nohp['name'] ?>" id="<?= $nohp['name'] ?>" class="form-control <?= (@$errors['nohp']?'is-invalid':'') ?>" maxlength="16" placeholder="<?= $nohp['placeholder'] ?>" value="<?= $nohp['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['nohp'] ?>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $password['label'] ?></label>
                      <div class="col-md-10">
                      <input type="password" name="<?= $password['name'] ?>" id="<?= $password['name'] ?>" class="form-control <?= (@$errors['password']?'is-invalid':'') ?>" autocapitalize="off" autocomplete="off" placeholder="<?= $password['placeholder'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['password'] ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $password_confirm['label'] ?></label>
                      <div class="col-md-10">
                        <input type="password" name="<?= $password_confirm['name'] ?>" id="<?= $password_confirm['name'] ?>" class="form-control <?= (@$errors['password_confirm']?'is-invalid':'') ?>" placeholder="<?= $password_confirm['placeholder'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['password_confirm'] ?>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
                    <a href="<?= site_url('home/'.$subnav) ?>" class="btn btn-danger"> Batal</a>
                  </div>
                  <?= form_close() ?>
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
  
</body>

</html>