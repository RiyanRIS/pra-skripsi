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
            <div class="col-md-8">
              <div class="card">
                <div class="project-heading">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="media">
                        <img src="assets/images/project-logo.png" class="mr-2 project-logo" alt="Project Logo">
                        <div class="media-body">
                          <h2 class="project-title"><?= $kegiatan['nama'] ?></h2>
                          <span class="badge badge-success status">RUNNING</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 text-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">ADD NEW <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                          <li><a href="#">Milestone</a></li>
                          <li><a href="#">Task</a></li>
                          <li><a href="#">People</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="project-subheading">
                    <div class="layout-table project-metrics">
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">DATE START</span>
                          <span class="value">Jul 23, 2017</span>
                        </div>
                      </div>
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">DATE END</span>
                          <span class="value">Oct 01, 2017</span>
                        </div>
                      </div>
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">EST. VALUE</span>
                          <span class="value">$21,847</span>
                        </div>
                      </div>
                      <div class="cell">
                        <div class="main-info-item">
                          <span class="title">PROGRESS</span>
                          <div id="project-progress" class="progress progress-transparent custom-color-orange2">
                            <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width:85%;">85%</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="project-info">
                    <h3 class="info-heading">DESCRIPTION</h3>
                    <p class="project-description">Audire saperet necessitatibus no eam. No impedit postulant scribentur quo. Choro quidam mel id, pri te brute velit propriae, et cum sint latine docendi. Cu sed mutat posidonium, et duo exerci graece. No aliquip lobortis sit. Alii rebum ei mei. Eu tollit putent has, consul impedit accusata quo ad, veri mazim has id. Tamquam vocibus oportere ex mei, oporteat convenire cotidieque eu eos.</p>
                  </div>

                  <div class="project-info">
                    <h3 class="info-heading">MILESTONES</h3>
                    <div class="panel-group accordion project-accordion" id="project-accordion">
                      <!-- project milestone -->
                      <div class="card project-milestone">
                        <div class="card-header">
                          <h4 class="card-title">
                            <a href="#collapse1" data-toggle="collapse" data-parent="#project-accordion">
                              <span class="milestone-title"><i class="fa fa-check icon-indicator text-success"></i> Research on eCommerce Trends</span> <span class="badge badge-success">PAID</span> 
                              <i class="fa fa-minus-circle toggle-icon"></i>
                            </a>
                          </h4>
                        </div>
                        <div id="collapse1" class="collapse show">
                          <div class="card-body">
                            <div class="milestone-section">
                              <h4 class="milestone-heading">DESCRIPTION</h4>
                              <p class="milestone-description">Velit elitr dolore eu pri, ut has vero imperdiet dissentiet, sit magna blandit reformidans in. Alia commune disputationi vis no, natum rebum melius in ius.</p>
                            </div>
                            <div class="milestone-section layout-table project-metrics">
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DATE START</span>
                                  <span class="value">Jul 23, 2017</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DATE END</span>
                                  <span class="value">Aug 01, 2017</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">EST. VALUE</span>
                                  <span class="value">$1,200</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DELIVERABLE</span>
                                  <span class="value">
                                    <i class="fa fa-file-pdf-o"></i>
                                    <a href="#">Research_FINAL.pdf</a>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="milestone-section">
                              <div class="table-responsive">
                                <table class="table table-striped table-project-tasks">
                                  <thead>
                                    <tr><th>TASK</th><th>DEADLINE</th><th>PROGRESS</th><th>ACTIONS</th></tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td colspan="4" class="divider">COMPLETED TASK</td>
                                    </tr>
                                    <tr>
                                      <td><span class="task-indicator success"></span> Functional Specs</td>
                                      <td>Jul 30, 2017</td>
                                      <td>100%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><span class="task-indicator success"></span> Design Specs</td>
                                      <td>Aug 01, 2017</td>
                                      <td>100%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- end project milestone -->

                      <!-- project milestone -->
                      <div class="card project-milestone">
                        <div class="card-header">
                          <h4 class="card-title">
                            <a href="#collapse2" data-toggle="collapse" data-parent="#project-accordion" class="collapsed">
                              <span class="milestone-title"><i class="fa fa-check icon-indicator text-success"></i> Business Requirements</span> <span class="badge badge-danger label-transparent">DUE</span>
                              <i class="fa fa-plus-circle toggle-icon"></i>
                            </a>
                          </h4>
                        </div>
                        <div id="collapse2" class="collapse">
                          <div class="card-body">
                            <div class="milestone-section">
                              <h4 class="milestone-heading">DESCRIPTION</h4>
                              <p class="milestone-description">Velit elitr dolore eu pri, ut has vero imperdiet dissentiet, sit magna blandit reformidans in. Alia commune disputationi vis no, natum rebum melius in ius.</p>
                            </div>
                            <div class="milestone-section layout-table project-metrics">
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DATE START</span>
                                  <span class="value">Aug 01, 2017</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DATE END</span>
                                  <span class="value">Sep 15, 2017</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">EST. VALUE</span>
                                  <span class="value">$15,600</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DELIVERABLE</span>
                                  <span class="value">
                                    <i class="fa fa-file-archive-o"></i>
                                    <a href="#">BusinessReqs_FINAL.zip</a>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="milestone-section">
                              <div class="table-responsive">
                                <table class="table table-striped table-project-tasks">
                                  <thead>
                                    <tr><th>TASK</th><th>DEADLINE</th><th>PROGRESS</th><th>ACTIONS</th></tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td colspan="4" class="divider">COMPLETED TASK</td>
                                    </tr>
                                    <tr>
                                      <td><span class="task-indicator success"></span> Functional Gathering</td>
                                      <td>Jul 30, 2017</td>
                                      <td>100%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><span class="task-indicator success"></span> Features and Specs</td>
                                      <td>Aug 10, 2017</td>
                                      <td>100%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <a href="#" class="btn btn-outline-light"><i class="fa fa-pencil"></i> EDIT MILESTONE</a>
                            <a href="#" class="btn btn-outline-light"><i class="fa fa-cloud-upload"></i> UPLOAD</a>
                            <a href="#" class="btn btn-success"><i class="fa fa-file"></i> VIEW INVOICE</a>
                          </div>
                        </div>
                      </div>
                      <!-- end project milestone -->

                      <!-- project milestone -->
                      <div class="card project-milestone">
                        <div class="card-header">
                          <h4 class="card-title">
                            <a href="#collapse3" data-toggle="collapse" data-parent="#project-accordion" class="collapsed">
                              <span class="milestone-title"><i class="fa fa-spinner icon-indicator custom-text-blue3"></i> Phase 1 Project Delivery</span> <span class="note">7 days until deadline</span> 
                              <i class="fa fa-plus-circle toggle-icon"></i>
                            </a>
                          </h4>
                        </div>
                        <div id="collapse3" class="collapse">
                          <div class="card-body">
                            <div class="milestone-section">
                              <h4 class="milestone-heading">DESCRIPTION</h4>
                              <p class="milestone-description">Velit elitr dolore eu pri, ut has vero imperdiet dissentiet, sit magna blandit reformidans in. Alia commune disputationi vis no, natum rebum melius in ius.</p>
                            </div>
        
                            <div class="milestone-section layout-table project-metrics">
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DATE START</span>
                                  <span class="value">Jul 23, 2017</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DATE END</span>
                                  <span class="value">Oct 01, 2017</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">EST. VALUE</span>
                                  <span class="value">$21,847</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DELIVERABLE</span>
                                  <span class="value">
                                    <i class="fa fa-file-archive-o"></i>
                                    <a href="#">project_source_main.zip</a>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <a href="#" class="btn btn-outline-light"><i class="fa fa-pencil"></i> EDIT MILESTONE</a>
                            <a href="#" class="btn btn-outline-light"><i class="fa fa-cloud-upload"></i> UPLOAD</a>
                            <a href="#" class="btn btn-success"><i class="fa fa-file"></i> CREATE INVOICE</a>
                          </div>
                        </div>
                      </div>
                      <!-- end project milestone -->

                      <!-- project milestone -->
                      <div class="card project-milestone">
                        <div class="card-header">
                          <h4 class="card-title">
                            <a href="#collapse4" data-toggle="collapse" data-parent="#project-accordion" class="collapsed">
                              <span class="milestone-title"><i class="fa fa-spinner icon-indicator custom-text-blue3"></i> UI Design</span> 
                              <i class="fa fa-minus-circle toggle-icon"></i>
                            </a>
                          </h4>
                        </div>
                        <div id="collapse4" class="collapse show">
                          <div class="card-body">
                            <div class="milestone-section">
                              <h4 class="milestone-heading">DESCRIPTION</h4>
                              <p class="milestone-description">Velit elitr dolore eu pri, ut has vero imperdiet dissentiet, sit magna blandit reformidans in. Alia commune disputationi vis no, natum rebum melius in ius.</p>
                            </div>
                            <div class="milestone-section layout-table project-metrics">
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DATE START</span>
                                  <span class="value">Jul 23, 2017</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DATE END</span>
                                  <span class="value">Oct 01, 2017</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">EST. VALUE</span>
                                  <span class="value">$21,847</span>
                                </div>
                              </div>
                              <div class="cell">
                                <div class="main-info-item">
                                  <span class="title">DELIVERABLE</span>
                                  <span class="value">
                                    <i class="fa fa-file-archive-o"></i>
                                    <a href="#">project_source_main.zip</a>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="milestone-section">
                              <div class="table-responsive">
                                <table class="table table-striped table-project-tasks">
                                  <thead>
                                    <tr><th>TASK</th><th>DEADLINE</th><th>PROGRESS</th><th>ACTIONS</th></tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td><span class="task-indicator warning"></span> Wireframing</td>
                                      <td>Jul 27, 2017 <span class="text-muted">(9 days)</span></td>
                                      <td>95%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><span class="task-indicator warning"></span> Create style guide</td>
                                      <td>Jul 23, 2017 <span class="text-muted">(2 days)</span></td>
                                      <td>75%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><span class="task-indicator danger"></span> Design Draft</td>
                                      <td>Jul 12, 2017 <span class="text-danger">(+5 days)</span></td>
                                      <td>80%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="4" class="divider">COMPLETED TASK</td>
                                    </tr>
                                    <tr>
                                      <td><span class="task-indicator success"></span> Functional Specs</td>
                                      <td>Jul 27, 2017</td>
                                      <td>100%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><span class="task-indicator success"></span> Design Specs</td>
                                      <td>Jul 27, 2017</td>
                                      <td>100%</td>
                                      <td>
                                        <span class="actions">
                                          <a href="#"><i class="fa fa-eye"></i></a>
                                          <a href="#"><i class="fa fa-pencil"></i></a>
                                          <a href="#"><i class="fa fa-trash"></i></a>
                                        </span>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <a href="#" class="btn btn-outline-light"><i class="fa fa-pencil"></i> EDIT MILESTONE</a>
                            <a href="#" class="btn btn-outline-light"><i class="fa fa-cloud-upload"></i> UPLOAD</a>
                            <a href="#" class="btn btn-success"><i class="fa fa-file"></i> CREATE INVOICE</a>
                          </div>
                        </div>
                      </div>
                      <!-- end project milestone -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <!-- project team -->
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Project Team</h3>
                    <div class="right">
                      <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled list-contacts">
                      <li>
                        <div class="media">
                          <img src="assets/images/people/female3.png" class="picture" alt="">
                          <span class="status online"></span>
                        </div>
                        <div class="info">
                          <span class="name">Theresa Santos</span>
                          <span class="title">Team Leader</span>
                        </div>
                        <div class="controls">
                          <a href="#"><i class="fa fa-commenting-o"></i></a>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="picture custom-bg-blue3">MB</div>
                          <span class="status"></span>
                        </div>
                        <div class="info">
                          <span class="name">Michael Bradley</span>
                          <span class="email">Business Analyst</span>
                        </div>
                        <div class="controls">
                          <a href="#"><i class="fa fa-commenting-o"></i></a>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <img src="assets/images/people/male1.png" class="picture" alt="">
                          <span class="status online"></span>
                        </div>
                        <div class="info">
                          <span class="name">Bruce Bowman</span>
                          <span class="email">UI Designer</span>
                        </div>
                        <div class="controls">
                          <a href="#"><i class="fa fa-commenting-o"></i></a>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <img src="assets/images/people/female4.png" class="picture" alt="">
                          <span class="status"></span>
                        </div>
                        <div class="info">
                          <span class="name">Karen Price</span>
                          <span class="email">Legal</span>
                        </div>
                        <div class="controls">
                          <a href="#"><i class="fa fa-commenting-o"></i></a>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <img src="assets/images/people/female5.png" class="picture" alt="">
                          <span class="status online"></span>
                        </div>
                        <div class="info">
                          <span class="name">Martha Mendoza</span>
                          <span class="email">Full-Stack Developer</span>
                        </div>
                        <div class="controls">
                          <a href="#"><i class="fa fa-commenting-o"></i></a>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              <!-- end project team -->

              <!-- resource files -->
              <div class="card">
                <h3 class="card-header">Resource Files</h3>
                <div class="card-body">
                  <ul class="list-unstyled list-justify list-file-simple">
                    <li><a href="#"><i class="fa fa-file-word-o"></i>Proposal.docx</a> <span>4 MB</span></li>
                    <li><a href="#"><i class="fa fa-file-pdf-o"></i>Final_Presentation.ppt</a> <span>20 MB</span></li>
                    <li><a href="#"><i class="fa fa-file-zip-o"></i>Phase1_AllFiles.zip</a> <span>315 MB</span></li>
                    <li><a href="#"><i class="fa fa-file-excel-o"></i>Meeting_Schedule.xls</a> <span>1 MB</span></li>
                  </ul>
                </div>
                <div class="card-footer text-right">
                  <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-cloud-upload"></i> UPLOAD FILE</a>
                </div>
              </div>
              <!-- end resource files -->

              <!-- project statistic -->
              <div class="card">
                <h4 class="card-header">Project Statistic</h4>
                <div class="card-body">
                  <ul class="list-unstyled list-widget-vertical no-border">
                    <li>
                      <div class="widget-metric_7">
                        <i class="fa fa-tasks icon custom-text-blue3"></i>
                        <div class="right">
                          <span class="value">89 / 142</span>
                          <span class="title">Task Delivered</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="widget-metric_7">
                        <i class="fa fa-money icon custom-text-green"></i>
                        <div class="right">
                          <span class="value">$5,834 / $21,847</span>
                          <span class="title">Payment made</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="widget-metric_7">
                        <i class="fa fa-calendar-o icon custom-text-orange"></i>
                        <div class="right">
                          <span class="value">165 / 312</span>
                          <span class="title">Days elapsed</span>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- end project statistic -->
            </div>
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN -->

    <?= view("_template/footer.php") ?>
  <!-- LETAKKAN JAVASCRIPT TAMBAHAN DISINI -->
  <!-- Plugins -->

</body>

</html>