            <!-- resource files -->
              <div class="card">
                <h3 class="card-header">Resource Files</h3>
                <div class="card-body">
                  <ul class="list-unstyled list-justify list-file-simple">
                  <?php if(count(@$list_berkas)>0){ 
                      foreach ($list_berkas as $key) { 
                        if($key['size'] > 10)  
                      ?>
                    <li><a href="<?= base_url("assets/berkas/kegiatan/".$key['link']) ?>"><i class="fa fa-file-word-o"></i><?= $key['nama'] ?></a> <span><?= formatBytes($key['size']) ?></span></li>
                    <?php } }else{
                      echo "<h5 style=\"color:red\">Belum ada berkas tersimpan</h5>";
                    } ?>
                  </ul>
                </div>
                <div class="card-footer text-right">
                  <button type="button" class="btn btn-primary btn-sm" title="Tambah Berkas" id="btn-tambah-berkas" data-id="<?= $id ?>" data-url="<?= site_url('home/kegiatan/modal/tambah-berkas') ?>"><i class="fa fa-cloud-upload"></i> UPLOAD FILE</button>
                </div>
              </div>
              <!-- end resource files -->