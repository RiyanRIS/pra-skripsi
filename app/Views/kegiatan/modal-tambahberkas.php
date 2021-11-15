<!-- Modal tambah berkas -->
<div class="modal fade" id="tambah-berkas" tabindex="-1" role="dialog" aria-labelledby="TambahBerkas" data-backdrop="static"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahBerkas">Tambah Berkas Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('home/kegiatan/aksi/tambah-berkas', ['class' => 'form-tambah-berkas']) ?>
      <div class="modal-body">
        <input type="hidden" name="kegiatan" value="<?= $id ?>">
        <div class="form-group row">
          <label for="input-berkas-nama" class="col-md-2 col-form-label">Nama Berkas*</label>
          <div class="col-md-10">
            <input type="text" name="nama" class="form-control" id="input-berkas-nama" placeholder="Misal. Time Schedule Fix" required="true">
          </div>
        </div>

        <div class="form-group row">
          <label for="input-berkas-file" class="col-md-2 col-form-label">File*</label>
          <div class="col-md-10">
            <input type="file" name="berkas" class="dropify" data-max-file-size="5000K" required="true">
            <span class="text-muted small">*max file 5MB</span>
          </div>
        </div>

        <div class="form-group row">
          <label for="input-berkas-permission" class="col-md-2 col-form-label">Permission*</label>
          <div class="col-md-10">
            <select name="permission" id="input-berkas-permission" class="form-control" required="true">
              <option value="umum">Umum</option>
              <option value="panitia" selected="true">Hanya Panitia</option>
            </select>
            <span class="text-muted small">*atur siapa yang bisa mengakses file ini</span>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-tambah-berkas">Simpan</button>
      </div>  
       <?= form_close(); ?>
    </div>
  </div>
</div>
