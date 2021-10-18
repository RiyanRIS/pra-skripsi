                  <div class="table-responsive">
                    <table class="table table-striped table-project-tasks">
                      <thead>
                        <tr>
                          <th>TUGAS</th>
                          <th>DEADLINE</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($list_tugas as $key) {
                        $stt = "warning"; 
                        if($key['status'] == 1){
                          $stt = "success";
                        } else {
                          if($key['deadline'] <= time()){
                            $stt = "danger";
                          }
                        }
                        ?>
                        <tr>
                          <td><span class="task-indicator <?= $stt ?>"></span> <?= ucwords($key['tugas']) ?></td>
                          <td><?= date("d F Y", $key['deadline']) ?></td>
                          <td>
                            <span class="actions">
                              <!-- <a href="#"><i class="fa fa-eye"></i></a> -->
                              <a href="javascript:void(0)" title="Edit Tugas" id="btn-edit-tugas" data-id="<?= $key['id'] ?>" data-url="<?= site_url('home/kegiatan/modal/edit-tugas') ?>"><i class="fa fa-pencil"></i></a>
                              <a onclick="confirmation(event)" href="<?= site_url("home/kegiatan/aksi/hapus-tugas/".encrypt_url($key['id'])."/".encrypt_url($id)) ?>" title="Hapus Tugas"><i class="fa fa-trash"></i></a>
                            </span>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>