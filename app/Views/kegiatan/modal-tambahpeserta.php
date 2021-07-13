<!-- Modal tambah peserta -->
<div class="modal fade" id="tambah-peserta" tabindex="-1" role="dialog" aria-labelledby="TambahPeserta" data-backdrop="static"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahPeserta">Tambah Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('home/kegiatan/aksi/tambah-peserta', ['class' => 'form-tambah-peserta']) ?>
      <div class="modal-body">
        <input type="hidden" name="kegiatan" value="<?= $id ?>">
        <div class="form-group row">
          <label for="pilih-peserta" class="col-md-2 col-form-label">Pilih Peserta*</label>
          <div class="col-md-10">
            <select id="pilih-peserta" class="form-control" style="width:100%" required="true" name="user">
              <option></option>
              <?php foreach ($list as $key) { ?>
                <option value="<?= $key['id'] ?>"><?= $key['nama'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-tambah-peserta">Simpan</button>
      </div>
       <?= form_close(); ?>
    </div>
  </div>
</div>
