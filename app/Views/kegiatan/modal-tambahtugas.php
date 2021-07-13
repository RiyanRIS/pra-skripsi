<!-- Modal tambah tugas -->
<div class="modal fade" id="tambah-tugas" tabindex="-1" role="dialog" aria-labelledby="TambahTugas" data-backdrop="static"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahTugas">Tambah Tugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('home/kegiatan/aksi/tambah-tugas', ['class' => 'form-tambah-tugas']) ?>
      <div class="modal-body">
        <input type="hidden" name="kegiatan" value="<?= $id ?>">
        <div class="form-group row">
          <label for="input-tugas-tugas" class="col-md-2 col-form-label">Tugas*</label>
          <div class="col-md-10">
            <input type="text" name="tugas" class="form-control" id="input-tugas-tugas" placeholder="Nama Tugas" required="true">
          </div>
        </div>

        <div class="form-group row">
          <label for="input-tugas-deadline" class="col-md-2 col-form-label">Deadline*</label>
          <div class="col-md-10">
            <input type="date" name="deadline" class="form-control" id="input-tugas-deadline" placeholder="Deadline Tugas" required="true">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-tambah-tugas">Simpan</button>
      </div>
       <?= form_close(); ?>
    </div>
  </div>
</div>
