<?php $this->load->view('layout/public/header'); ?>
<link href="<?= base_url() ?>public/assets/web/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="<?= base_url() ?>public/assets/web/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="<?= base_url() ?>public/assets/web/lib/typicons.font/typicons.css" rel="stylesheet">
<link href="<?= base_url() ?>public/assets/web/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url() ?>public/assets/web/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="<?= base_url() ?>public/assets/web/lib/select2/css/select2.min.css" rel="stylesheet">

<div class="az-content az-content-mail">
      <div class="container">
        <div class="content-wrapper w-100">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-sm-flex pb-4 mb-4 border-bottom">
                    <div class="d-flex align-items-center">
                      <h5 class="page-title mb-n2">Open Tickets</h5>
                      <p class="mt-2 mb-n1 ms-3 text-muted">230 Tickets</p>
                    </div>
                    <form class="ml-lg-auto d-flex pt-2 pt-md-0 align-items-stretch justify-content-end">
                      <input type="text" class="form-control w-50" placeholder="Search">
                      <button type="submit" class="btn btn-success no-wrap ms-4">Search Ticket</button>
                    </form>
                  </div>
                  <div class="nav-scroller">
                    <ul class="nav nav-tabs tickets-tab-switch" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link rounded active" id="open-tab" data-bs-toggle="tab" href="#open-tickets" role="tab" aria-controls="open-tickets" aria-selected="true">Open Tickets <div class="badge">13</div></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link rounded" id="pending-tab" data-bs-toggle="tab" href="#pending-tickets" role="tab" aria-controls="pending-tickets" aria-selected="false">Pending Tickets <div class="badge">50 </div></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link rounded" id="onhold-tab" data-bs-toggle="tab" href="#onhold-tickets" role="tab" aria-controls="onhold-tickets" aria-selected="false">On-hold Tickets <div class="badge">29 </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="tab-content border-0 tab-content-basic">
                    <div class="tab-pane fade show active" id="open-tickets" role="tabpanel" aria-labelledby="open-tickets">
                      <div class="tickets-date-group"><i class="typcn icon typcn-calendar-outline"></i>Tuesday, 21 May 2019 </div>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8 col-12">
                          <div class="wrapper">
                            <h5>#39033 - Design Admin Dashboard</h5>
                            <div class="badge badge-success">New</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face13.jpg" alt="profile image">
                            <span>Brett Gonzales</span>
                            <span><i class="typcn icon typcn-time"></i>03:34AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6 d-none d-md-block">
                          <img class="img-xs rounded-circle" src="../img/faces/face16.jpg" alt="profile image">
                          <span class="text-muted">Frank Briggs</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6 d-none d-md-block">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Wireframe</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8 col-12">
                          <div class="wrapper">
                            <h5>#39040 - Website Redesign</h5>
                            <div class="badge badge-info">Pro</div>
                          </div>
                          <div class="wrapper text-muted d-none d-lg-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face18.jpg" alt="profile image">
                            <span>Olivia Cross</span>
                            <span><i class="typcn icon typcn-time"></i>04:23AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-12">
                          <img class="img-xs rounded-circle" src="../img/faces/face14.jpg" alt="profile image">
                          <span class="text-muted">Frank Briggs</span>
                        </div>
                        <div class="ticket-float col-lg-2 d-none d-lg-block">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Wireframe</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#39041 - Bootstrap Framework not working</h5>
                            <div class="badge badge-info">Pro</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face11.jpg" alt="profile image">
                            <span>Leah Frank</span>
                            <span><i class="typcn icon typcn-time"></i>04:24AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face10.jpg" alt="profile image">
                          <span class="text-muted">Emilie Barnett</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Deployed</span>
                        </div>
                      </a>
                      <div class="tickets-date-group"><i class="typcn icon typcn-calendar-outline"></i>Tuesday, 20 Apr,2019 </div>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#39045 - Design Admin Dashboard</h5>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face18.jpg" alt="profile image">
                            <span>Luella Sparks</span>
                            <span><i class="typcn icon typcn-time"></i>12:54PM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face6.jpg" alt="profile image">
                          <span class="text-muted">Hunter Garza</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Concept</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#29033 - Set up the marketplace strategy </h5>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face15.jpg" alt="profile image">
                            <span>Mitchell Barber</span>
                            <span><i class="typcn icon typcn-time"></i>4:19AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face7.jpg" alt="profile image">
                          <span class="text-muted">Michael Campbell</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Wireframe</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#29033 - Design Admin Dashboard</h5>
                            <div class="badge badge-success">New</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face13.jpg" alt="profile image">
                            <span>Rhoda Jimenez</span>
                            <span><i class="typcn icon typcn-time"></i>01:27PM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face10.jpg" alt="profile image">
                          <span class="text-muted">Maria Cook</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Deployed</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#29033 - Compose newsletter for the big launch</h5>
                            <div class="badge badge-success">New</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face17.jpg" alt="profile image">
                            <span>Alta Little</span>
                            <span><i class="typcn icon typcn-time"></i>06:16PM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face20.jpg" alt="profile image">
                          <span class="text-muted">Juan Little</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Concept</span>
                        </div>
                      </a>
                    </div>
                    <div class="tab-pane fade" id="pending-tickets" role="tabpanel" aria-labelledby="pending-tickets">
                      <div class="tickets-date-group"><i class="typcn icon typcn-calendar-outline"></i>Tuesday, 21 May 2019 </div>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#39045 - Design Admin Dashboard</h5>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face18.jpg" alt="profile image">
                            <span>Luella Sparks</span>
                            <span><i class="typcn icon typcn-time"></i>12:54PM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face6.jpg" alt="profile image">
                          <span class="text-muted">Hunter Garza</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Concept</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#39033 - Design Admin Dashboard</h5>
                            <div class="badge badge-success">New</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face13.jpg" alt="profile image">
                            <span>Brett Gonzales</span>
                            <span><i class="typcn icon typcn-time"></i>03:34AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face16.jpg" alt="profile image">
                          <span class="text-muted">Frank Briggs</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Wireframe</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#29033 - Compose newsletter for the big launch</h5>
                            <div class="badge badge-success">New</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face17.jpg" alt="profile image">
                            <span>Alta Little</span>
                            <span><i class="typcn icon typcn-time"></i>06:16PM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face20.jpg" alt="profile image">
                          <span class="text-muted">Juan Little</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Concept</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#39040 - Website Redesign</h5>
                            <div class="badge badge-info">Pro</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face18.jpg" alt="profile image">
                            <span>Olivia Cross</span>
                            <span><i class="typcn icon typcn-time"></i>04:23AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face14.jpg" alt="profile image">
                          <span class="text-muted">Frank Briggs</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Wireframe</span>
                        </div>
                      </a>
                      <div class="tickets-date-group"><i class="typcn icon typcn-calendar-outline"></i>Tuesday, 20 Apr,2019 </div>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#29033 - Set up the marketplace strategy </h5>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face15.jpg" alt="profile image">
                            <span>Mitchell Barber</span>
                            <span><i class="typcn icon typcn-time"></i>4:19AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face7.jpg" alt="profile image">
                          <span class="text-muted">Michael Campbell</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Wireframe</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#39041 - Bootstrap Framework not working</h5>
                            <div class="badge badge-info">Pro</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face11.jpg" alt="profile image">
                            <span>Leah Frank</span>
                            <span><i class="typcn icon typcn-time"></i>04:24AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face10.jpg" alt="profile image">
                          <span class="text-muted">Emilie Barnett</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Deployed</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#29033 - Design Admin Dashboard</h5>
                            <div class="badge badge-success">New</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face13.jpg" alt="profile image">
                            <span>Rhoda Jimenez</span>
                            <span><i class="typcn icon typcn-time"></i>01:27PM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face10.jpg" alt="profile image">
                          <span class="text-muted">Maria Cook</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Deployed</span>
                        </div>
                      </a>
                    </div>
                    <div class="tab-pane fade" id="onhold-tickets" role="tabpanel" aria-labelledby="onhold-tickets">
                      <div class="tickets-date-group"><i class="typcn icon typcn-calendar-outline"></i>Tuesday, 21 May 2019 </div>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#39040 - Website Redesign</h5>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face18.jpg" alt="profile image">
                            <span>Olivia Cross</span>
                            <span><i class="typcn icon typcn-time"></i>04:23AM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face14.jpg" alt="profile image">
                          <span class="text-muted">Frank Briggs</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Wireframe</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#29033 - Design Admin Dashboard</h5>
                            <div class="badge badge-success">New</div>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face13.jpg" alt="profile image">
                            <span>Rhoda Jimenez</span>
                            <span><i class="typcn icon typcn-time"></i>01:27PM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face10.jpg" alt="profile image">
                          <span class="text-muted">Maria Cook</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Deployed</span>
                        </div>
                      </a>
                      <a href="#" class="tickets-card row">
                        <div class="tickets-details col-lg-8">
                          <div class="wrapper">
                            <h5>#29033 - Compose newsletter for the big launch</h5>
                          </div>
                          <div class="wrapper text-muted d-none d-md-block">
                            <span>Assigned to</span>
                            <img class="assignee-avatar" src="../img/faces/face17.jpg" alt="profile image">
                            <span>Alta Little</span>
                            <span><i class="typcn icon typcn-time"></i>06:16PM</span>
                          </div>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <img class="img-xs rounded-circle" src="../img/faces/face20.jpg" alt="profile image">
                          <span class="text-muted">Juan Little</span>
                        </div>
                        <div class="ticket-float col-lg-2 col-sm-6">
                          <i class="category-icon typcn icon typcn-folder"></i>
                          <span class="text-muted">Concept</span>
                        </div>
                      </a>
                    </div>
                  </div>
                  <nav class="mt-4">
                    <ul class="pagination">
                      <li class="page-item">
                        <a class="page-link" href="#">
                          <i class="typcn icon typcn-chevron-left-outline"></i>
                        </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">4</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">
                          <i class="typcn icon typcn-chevron-right-outline"></i>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- az-content -->

    <div class="az-mail-compose">
      <div>
        <div class="container">
          <div class="az-mail-compose-box">
            <div class="az-mail-compose-header">
              <span>New Message</span>
              <nav class="nav">
                <a href="" class="nav-link"><i class="fas fa-minus"></i></a>
                <a href="" class="nav-link"><i class="fas fa-compress"></i></a>
                <a href="" class="nav-link"><i class="fas fa-times"></i></a>
              </nav>
            </div><!-- az-mail-compose-header -->
            <div class="az-mail-compose-body">
              <div class="form-group">
                <label class="form-label">To</label>
                <div><input type="text" class="form-control" placeholder="Enter recipient's email address"></div>
              </div><!-- form-group -->
              <div class="form-group">
                <label class="form-label">Subject</label>
                <div><input type="text" class="form-control"></div>
              </div><!-- form-group -->
              <div class="form-group">
                <textarea class="form-control" rows="8" placeholder="Write your message here..."></textarea>
              </div><!-- form-group -->
              <div class="form-group mg-b-0">
                <nav class="nav">
                  <a href="" class="nav-link" data-toggle="tooltip" title="Add attachment"><i class="fas fa-paperclip"></i></a>
                  <a href="" class="nav-link" data-toggle="tooltip" title="Add photo"><i class="far fa-image"></i></a>
                  <a href="" class="nav-link" data-toggle="tooltip" title="Add link"><i class="fas fa-link"></i></a>
                  <a href="" class="nav-link" data-toggle="tooltip" title="Emoticons"><i class="far fa-smile"></i></a>
                  <a href="" class="nav-link" data-toggle="tooltip" title="Discard"><i class="far fa-trash-alt"></i></a>
                </nav>
                <button class="btn btn-primary">Send</button>
              </div><!-- form-group -->
            </div><!-- az-mail-compose-body -->
          </div><!-- az-mail-compose-box -->
        </div><!-- container -->
      </div>
    </div><!-- az-mail-compose -->



<?php $this->load->view('layout/public/footer'); ?>
<script src="<?= base_url() ?>public/assets/web/lib/chart.js/Chart.bundle.min.js"></script>
<script src="<?= base_url() ?>public/assets/web/lib/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/assets/web/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/assets/web/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>public/assets/web/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/assets/web/lib/select2/js/select2.min.js"></script>
<script src="<?= base_url() ?>public/assets/web/js/azia.js"></script>
<script>
  $(function() {
    'use strict'

    $('#order-listing').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      "iDisplayLength": 10,
      "language": {
        search: ""
      }
    });
    $('#order-listing').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });

    // Select2
    $('.dataTables_length select').select2({
      minimumResultsForSearch: Infinity
    });

  });
</script>