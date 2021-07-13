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
                        }else{
                          $a = date_create(date("Y-m-d", $key['deadline']));
                          $b = date_create(date("Y-m-d", time()));
                          $datediff = date_diff($a, $b);
                          if($datediff->days <= 1){
                            $stt = "danger";
                          }
                        }
                        ?>
                        <tr>
                          <td><span class="task-indicator <?= $stt ?>"></span> <?= ucwords($key['tugas']) ?></td>
                          <td><?= date("d F Y", $key['deadline']) ?></td>
                          <td>
                            <span class="actions">
                              <a href="#"><i class="fa fa-eye"></i></a>
                              <a href="#"><i class="fa fa-pencil"></i></a>
                              <a href="#"><i class="fa fa-trash"></i></a>
                            </span>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>