<?= view("_template/atas.php") ?>
<!-- LETAKKAN STYLE TAMBAHAN DISINI -->
  <!-- Uploader Styles -->
  <link href="<?= base_url() ?>/assets/plugins/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.css">

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
                  <a href="<?= site_url('home/kegiatan/'.$subnav) ?>" title="Kembali" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                  <?= form_open_multipart(uri_string()) ?>
                   <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $nama['label'] ?>*</label>
                      <div class="col-md-10">
                        <input type="text" name="<?= $nama['name'] ?>" id="<?= $nama['name'] ?>" class="form-control <?= (@$errors['nama']?'is-invalid':'') ?>" placeholder="<?= $nama['placeholder'] ?>" required="true" autofocus="true" value="<?= $nama['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['nama'] ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $deskripsi['label'] ?></label>
                      <div class="col-md-10">
                        <textarea name="<?= $deskripsi['name'] ?>" id="<?= $deskripsi['name'] ?>" class="form-control <?= (@$errors['deskripsi']?'is-invalid':'') ?>" placeholder="<?= $deskripsi['placeholder'] ?>" cols="10" rows="5"><?= $deskripsi['value'] ?></textarea>
                        <div class="invalid-feedback">
                          <?= @$errors['deskripsi'] ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $lokasi['label'] ?>*</label>
                      <div class="col-md-10">
                        <input type="text" name="<?= $lokasi['name'] ?>" id="<?= $lokasi['name'] ?>" class="form-control <?= (@$errors['lokasi']?'is-invalid':'') ?>" placeholder="<?= $lokasi['placeholder'] ?>" required="true" value="<?= $lokasi['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['lokasi'] ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $tanggal['label'] ?>*</label>
                      <div class="col-md-10">
                        <input type="text" autocomplete="off" name="<?= $tanggal['name'] ?>" id="<?= $tanggal['name'] ?>" class="form-control <?= (@$errors['tanggal']?'is-invalid':'') ?>" placeholder="<?= $tanggal['placeholder'] ?>" required="true" value="<?= $tanggal['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['tanggal'] ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $penanggungjawab['label'] ?>*</label>
                      <div class="col-md-10">
                        <select required="true" name="<?= $penanggungjawab['name'] ?>" class="form-control">
                        <option value="">-- Penanggungjawab --</option>
                        <?php foreach ($list_penanggungjawab as $key) { ?>
                          <option <?= ($penanggungjawab['value']!=$key['id']?:'selected') ?> value="<?= $key['id'] ?>"><?= $key['nama'] ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $cp1['label'] ?>*</label>
                      <div class="col-md-10">
                        <input type="text" name="<?= $cp1['name'] ?>" id="<?= $cp1['name'] ?>" class="form-control <?= (@$errors['cp1']?'is-invalid':'') ?>" placeholder="<?= $cp1['placeholder'] ?>" required="true" value="<?= $cp1['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['cp1'] ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $link1['label'] ?>*</label>
                      <div class="col-md-10">
                        <input type="text" name="<?= $link1['name'] ?>" id="<?= $link1['name'] ?>" class="form-control <?= (@$errors['link1']?'is-invalid':'') ?>" placeholder="<?= $link1['placeholder'] ?>" required="true" value="<?= $link1['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['link1'] ?>
                        </div>
                      </div>
                    </div>

                    <?php if($subnav=="semua"||$subnav=="master"): ?>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $jenis['label'] ?>*</label>
                      <div class="col-md-10">
                        <select required="true" name="<?= $jenis['name'] ?>" class="form-control">
                          <option <?= ($jenis['value']!='umum'?:'selected') ?> value="umum">Umum</option>
                          <option <?= ($jenis['value']!='internal'?:'selected') ?> value="internal">Internal</option>
                        </select>
                      </div>
                    </div>
                    <?php 
                    elseif($subnav=="umum"):
                      echo form_hidden("jenis", "umum");
                    elseif($subnav=="internal"):
                      echo form_hidden("jenis", "internal");?>
                    <?php endif ?>

                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"><?= $banner['label'] ?></label>
                      <div class="col-md-10">
                        <input type="file" name="<?= $banner['name'] ?>" id="<?= $banner['name'] ?>" class="form-control <?= (@$errors['banner']?'is-invalid':'') ?>" value="<?= $banner['value'] ?>">
                        <div class="invalid-feedback">
                          <?= @$errors['banner'] ?>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
                    <a href="<?= site_url('home/kegiatan/'.$subnav) ?>" class="btn btn-danger"> Batal</a>
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
  <!-- Uploader Plugin -->
  <script src="<?= base_url() ?>/assets/plugins/dropify/js/dropify.min.js"></script>

  <script src="https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.js"></script>
  <script>
  $('#banner').dropify();
  $('#tanggal').datetimepicker({
    format: 'Y-m-d H:i:s',
    formatDate: 'Y/m/d',
	  minDate: '<?= date("Y/m/d") ?>',
  });
  
  </script>
</body>

</html>