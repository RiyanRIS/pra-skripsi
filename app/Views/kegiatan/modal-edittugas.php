<!-- Modal edit tugas -->
<div class="modal fade" id="edit-tugas" tabindex="-1" role="dialog" aria-labelledby="EditTugas" data-backdrop="static"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditTugas">Edit Tugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('home/kegiatan/aksi/edit-tugas', ['class' => 'form-edit-tugas']) ?>
      <div class="modal-body">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="kegiatan" value="<?= $kegiatan ?>">
        <div class="form-group row">
          <label for="input-tugas-tugas" class="col-md-2 col-form-label">Tugas*</label>
          <div class="col-md-10">
            <input type="text" name="tugas" class="form-control" id="input-tugas-tugas" placeholder="Nama Tugas" required="true" value="<?= $ftugas ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="input-tugas-deadline" class="col-md-2 col-form-label">Deadline*</label>
          <div class="col-md-10">
            <input type="date" name="deadline" class="form-control" id="input-tugas-deadline" placeholder="Deadline Tugas" required="true" value="<?= $fdeadline ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="input-tugas-deadline" class="col-md-2 col-form-label">Status</label>
          <div class="col-md-10">
            <label class="fancy-checkbox custom-bgcolor-green"><input name="status" <?= ($fstatus==0?:"checked") ?> type="checkbox" value="1"><span> Selesai?</span></label>
          </div>
        </div>

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-edit-tugas">Simpan</button>
      </div>
       <?= form_close(); ?>
    </div>
  </div>
</div>
