<?= view("_template/atas.php") ?>
<!-- LETAKKAN STYLE TAMBAHAN DISINI -->

    <?= view("_template/navbar.php") ?>
    <?= view("_template/sidebar.php") ?>

    <!-- MAIN -->
    <div class="main">

      <!-- MAIN CONTENT -->
      <div class="main-content">

        <?= view("_template/contenthead.php") ?>

        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- TASKS -->
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <a href="<?= site_url("home/".$subnav."/tambah") ?>" title="Tambah Data" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-bordered">
                      <thead class="thead-light">
                        <tr>
                          <th>Nama</th>
                          <th>Role</th>
                          <th>Kontak</th>
                          <th>Activity</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($users as $user):?>
                        <tr>
                          <td>
                            <?= $user['nama'] ?> </br> <b>Username:</b> <?= $user['username'] ?>
                          </td>
                          <td>
                           <img width="48px" src="<?= base_url("assets/images/avatar/".$user['ava']) ?>" alt="">  <?= ucwords($user['role']) ?>
                          </td>
                          <td>
                            <img width="16px" src="<?= base_url("assets/images/wa.png") ?>" alt=""><a href="https://wa.me/"> <?= ($user['nohp']?:"-") ?></a> </br>
                            <img width="16px" src="<?= base_url("assets/images/tel.png") ?>" alt=""><a href="https://t.me/"> <?= ($user['chat_id']?:"-") ?>
                          </td>
                          <td>
                            <b>CreateAt: </b> <?= date("d F Y H:i", $user['create_at']) ?> </br>
                            <b>LastSeen: </b> <?= ($user['terahir_dilihat']==null?"-":date("d F Y H:i", $user['terahir_dilihat'])) ?>
                          </td>
                          <td>
                            <a href="<?= site_url('home/'.$subnav.'/ubah/'.$user['id']) ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a onclick="confirmation(event)" href="<?= site_url('home/'.$subnav.'/hapus/'.$user['id']) ?>" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach;?>
                      <tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- END TASKS -->
            </div>
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN -->

    <?= view("_template/footer.php") ?>
  <!-- LETAKKAN JAVASCRIPT TAMBAHAN DISINI -->

  
</body>

</html>