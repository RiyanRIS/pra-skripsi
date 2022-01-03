<!-- Modal pesan broadcast -->
<div class="modal fade" id="pesan-broadcast" tabindex="-1" role="dialog" aria-labelledby="PesanBroadcast" data-backdrop="static"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PesanBroadcast">Pesan Broadcast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('home/kegiatan/aksi/pesan-broadcast', ['class' => 'form-tambah-tugas']) ?>
      <div class="modal-body">
        <input type="hidden" name="kegiatan" value="<?= $id ?>">
        <div class="form-group row">
          <label for="input-broadcast" class="col-md-2 col-form-label">Pesan</label>
          <div class="col-md-10">
            <textarea class="form-control" name="pesan" id="input-broadcast" rows="3" placeholder="Tulis pesan"></textarea>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-tambah-tugas">Kirim</button>
      </div>
       <?= form_close(); ?>
    </div>
  </div>
</div>
