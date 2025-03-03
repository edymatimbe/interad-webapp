<?php $this->load->view('layout/public/header'); ?>

<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card mb-2 shadow">
                <div class="card-header">
                    <h3 class="card-title">Facturas e pagamentos</h3>
                </div>

            </div>
            <div class="card p-1">
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">

                        <div class="ms-auto text-muted">
                            Pesquisar:
                            <div class="ms-2 d-inline-block ">
                                <input type="text" class="form-control form-control-sm  shadow-sm" aria-label="Search invoice" id="my-search">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table-billing">
                        <thead>
                            <tr>
                                <th class="text-center"><button class="table-sort" data-sort="sort-key">#</button></th>
                                <th><button class="table-sort" data-sort="sort-name">Campanha</button></th>
                                <th class="text-center">Duração</th>
                                <th class="text-center">Spot</th>
                                <th class="text-center">Nr. taxes</th>
                                <th class="text-center">Data Incial</th>
                                <th class="text-center">Data final</button></th>
                                <th class="text-end">Custo</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Estado </th>
                                <th class="text-center">Action</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            <?php foreach ($billings as $key => $bill) : ?>

                                <tr>
                                    <td class="sort-key text-center"><?= $key + 1 ?></td>
                                    <td class="sort-name"><?= $bill->title ?></td>
                                    <td class="sort-city text-center"><?= $bill->periodicity . ' dias' ?></td>
                                    <td class="sort-type text-center"><?= $bill->video_duration . ' min' ?></td>
                                    <td class="sort-score text-center"><button class="btn btn-primary btn-sm btn-square w-100"> <span class=""> <i class="feather icon-layers"></i> &nbsp;&nbsp; <?= $bill->count_tax ?></span></button></td>
                                    <td class="sort-date text-center" data-date="1546512137"><?= date_format(date_create($bill->init_date), "d M Y ") ?></td>
                                    <td class="sort-date text-center" data-date="1546512137"><?= date_format(date_create($bill->final_date), "d M Y ")  ?></td>
                                    <td class="sort-price text-end"><?= number_format($bill->cost, 2) ?> Mt</td>
                                    <td class="sort-price text-end"><?= number_format($bill->cost * 0.16, 2) ?> Mt</td>
                                    <td class="sort-price text-end"><?= number_format($bill->cost + $bill->cost * 0.16, 2) ?> Mt</td>

                                    <td class="sort-status text-center">
                                        <?php if ($bill->status == 'pago') : ?>
                                            <span class="badge badge-outline text-green btn-square w-100 "><?= $bill->status ?><i class="feather icon-check text-end"></i></span>
                                        <?php elseif ($bill->status == 'pendente') : ?>
                                            <span class="badge badge-outline text-yellow btn-square w-100"><?= $bill->status ?> <i class="feather icon-info"></i> </span>
                                        <?php else : ?>
                                            <span class="badge badge-outline  text-red btn-square w-100"><?= $bill->status ?> <i class="feather icon-video-off"></i></span>
                                        <?php endif; ?>

                                    </td>
                                    <td class="sort-progress text-center">
                                    <a href="" class="btn btn-primary" onclick="invoices_pdf(<?=  $bill->controller_id ?>)"> Imprimir&nbsp;<i class="feather icon-printer"></i></a>
                                        <button onclick="quotation(<?= $bill->user_id ?>, <?= $bill->controller_id ?>)" class="btn btn-sm pt-1 btn-light"><i class="feather icon-eye text-danger"></i></button> &nbsp;
                                        <a href="" class="btn btn-sm pt-1 btn-light d-none"><i class="feather icon-video text-danger"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center d-none">
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
                    <ul class="pagination m-0 ms-auto">
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
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
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
        </div>

    </div>
</div>
<?php $this->load->view('layout/public/footer'); ?>
<script>
    function invoices_pdf(id) {
        $.ajax({
            url: "<?= base_url('public/advertiser/get_quotaion') ?>",
            type: 'POST',
            data: { user_id:2,
                controller_id:1 },
            dataType: 'JSON',
            success: function(data) {
              alert(data);
            }
        });
    }




    $(document).ready(function() {
        initDataTable('table-billing');
    });


    function quotation(user_id, controller_id) {
        $.ajax({
            url: "<?= base_url('public/advertiser/get_quotaion') ?>",
            type: 'POST',
            data: {
                user_id,
                controller_id
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data)
                $('.modal-full-width').html(data);
                $('#modal-full-width').modal('show')
            }
        })

    }
</script>