<!-- Modal tambah panitia -->
<div class="modal fade" id="gabung1" tabindex="-1" role="dialog" aria-labelledby="TambahPanitia" data-backdrop="static"  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahPanitia">Ingin Bergabung Pada Kegiatan Ini??</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('home/kegiatan/aksi/gabung', ['class' => 'form-tambah-panitia']) ?>
        <input type="hidden" name="kegiatan" value="<?= $id ?>">
        <input type="hidden" name="user" value="<?= session()->user_id ?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-primary btn-tambah-panitia">Ya</button>
      </div>
       <?= form_close(); ?>
    </div>
  </div>
</div>
