<!-- Modal tambah berkas -->
<div class="modal fade" id="tambah-berkas" tabindex="-1" role="dialog" aria-labelledby="TambahBerkas" data-backdrop="static"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahBerkas">Detail Berkas Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-project-tasks">
            <thead>
              <tr>
                <th>NAMA BERKAS</th>
                <th>PERMISSION</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $key) { 
                if($key['permission'] == 'panitia' && !punyaAksesKegiatan(session()->user_id, $id)){
                  continue;
                }      
                ?>
              <tr>
                <td><a href="<?= base_url("assets/berkas/kegiatan/".$key['link']) ?>"> <?= $key['nama'] ?>(<?= formatBytes($key['size']) ?>)</a></td>
                <td><?= ucwords($key['permission']) ?></td>
                <td>
                  <span class="actions">
                    <a onclick="confirmation(event)" href="<?= site_url("home/kegiatan/aksi/hapus-berkas/".encrypt_url($key['id'])."/".encrypt_url($id)) ?>" title="Hapus Berkas"><i class="fa fa-trash"></i></a>
                  </span>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
