              <!-- project team -->
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Kepanitiaan Kegiatan</h3>
                    <div class="right">
                      <button type="button" class="btn btn-primary btn-sm" title="Tambah Panitia" id="btn-tambah-panitia" data-id="<?= $id ?>" data-url="<?= site_url('home/kegiatan/modal/tambah-panitia') ?>"><i class="fa fa-user-plus"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled list-contacts">

                    <?php if(count(@$list_panitia)>0){ 
                      foreach ($list_panitia as $key) { ?>
                      <li>
                        <div class="media">
                          <img src="<?= base_url("assets/images/avatar/".$key['ava']) ?>" class="picture" alt="">
                          <span class="status online"></span>
                        </div>
                        <div class="info">
                          <span class="name"><?= $key['nama'] ?></span>
                          <span class="title"><?= $key['posisi'] ?></span>
                        </div>
                        <div class="controls">
                          <a onclick="confirmation(event)" href="<?= site_url("home/kegiatan/aksi/hapus-panitia/".encrypt_url($key['id'])."/".encrypt_url($id)) ?>" title="Hapus Panitia"><i class="fa fa-trash-o"></i></a>
                        </div>
                      </li>
                    <?php } }else{
                      echo "<h5 style=\"color:red\">Belum ada panitia</h5>";
                    } ?>
                    
                    </ul>
                  </div>
                </div>
              <!-- end project team -->

              <div class="viewmodal" style="display: none;"></div>

              
