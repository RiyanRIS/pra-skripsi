            <!-- project statistic -->
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title">Peserta</h3>
                  <div class="right">
                    <button type="button" class="btn btn-primary btn-sm" title="Tambah Peserta" id="btn-tambah-peserta" data-id="<?= $id ?>" data-url="<?= site_url('home/kegiatan/modal/tambah-peserta') ?>"><i class="fa fa-user-plus"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-minimal table-no-border m-0" id="table-peserta">
                    <thead id="theadilang">
                      <tr>
                        <th>Nama</th>
                        <th style="min-width:110px">#</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list_peserta as $key) { ?>
                      <tr>
                        <td><?= $key['nama'] ?></td>
                        <td><a href="#" class="btn btn-info btn-sm" title="Hadir"><i class="fa fa-check"></i></a> <a onclick="confirmation(event)" href="<?= site_url("home/kegiatan/aksi/hapus-peserta/".encrypt_url($key['id'])."/".encrypt_url($id)) ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash-o"></i></a></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- end project statistic -->