
<div class="container-xl">
    <div class="row row-cards">
        <?php foreach ($campaign as $ads) : ?>
            <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                    <a href="#" class="d-block border">
                        <video  controls class="card-img-top video-js" id="my-video" controls preload="auto" width="640" height="264" data-setup='{}'>
                            <source src="<?= base_url($ads->path) ?>" type="application/x-mpegURL">
                            Your browser does not support HTML video.
                        </video>
                    </a>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="col-auto">
                                <?php


                                if ($ads->status == 'pago') {
                                    $status_ads = 'status-green status-indicator-animated';
                                } elseif ($ads->status == 'pendente') {
                                    $status_ads = 'status-warning status-indicator-animated';
                                } else {
                                    $status_ads = 'status-danger';
                                }

                                ?>
                                <span class="status-indicator <?= $status_ads ?>  ">
                                    <span class="status-indicator-circle"> </span>
                                    <span class="status-indicator-circle"></span>
                                    <span class="status-indicator-circle"></span>
                                </span>
                            </div>
                            <div>
                                <div> <strong><?= $ads->title ?></strong></div>
                                <div class="text-muted">3 days ago</div>
                            </div>
                            <div class="ms-auto">
                                <a href="#" class="text-muted">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                    <?= $this->setting_model->controller_tax(['controller_tax.controller_id' => $ads->controller_id])->views ?>

                                </a>
                                <a href="#" class="ms-3 text-muted">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                    <i class="fas fa-taxi"></i>
                                    <?= $this->setting_model->controller_tax(['controller_tax.controller_id' => $ads->controller_id,])->total_tax ?>
                                </a>
                                <a href="<?= base_url('show-details') . '/' . $ads->controller_id ?>" class="ms-3 text-muted">
                                    <i class="feather icon-layers"></i>Detalhes

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex mt-2 ">
        <?php echo $this->pagination->create_links(); ?>

    </div>
    <div class="d-flex mt-2 d-none">
        <ul class="pagination ms-auto">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 6l-6 6l6 6" />
                    </svg>
                    prev
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item">
                <a class="page-link" href="#">
                    next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</div>