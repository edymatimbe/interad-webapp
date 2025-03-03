<?php $this->load->view('layout/public/header'); ?>

<div class="az-content az-content-profile">
    <div class="container ">
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Dasboard</span>
                <span>Publicar</span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="az-content-label alert alert-solid-info mb-2">Form Group Wrapper</div>
                </div>
            </div>
            <form id="form-post" autocomplete="off">
                <div id="wizard2">
                    <h3 class="mb-2">DESCRIÇÃO DA PUBLICIDADE</h3>
                    <section>
                        <div class="row row-sm">
                            <div class="col-md-6 col-lg-6">
                                <label class="form-control-label az-content-label tx-11 tx-medium tx-gray-600">Titulo <span class="tx-danger">*</span></label>
                                <input id="title" class="form-control" value="aaaa" name="title" placeholder="Titulo da publicidade" type="text" required>
                            </div><!-- col -->
                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                <label class="form-control-label az-content-label tx-11 tx-medium tx-gray-600">Link</label>
                                <input id="link" class="form-control" name="link" placeholder="Insrira do video link" type="text" required>
                            </div><!-- col -->
                            <div class="col-sm-12 mg-t-20 mg-sm-t-0 mt-1">
                                <label class="az-content-label tx-11 tx-medium tx-gray-600 ">Descrição <span class="tx-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" cols="80" rows="3"><?= isset($banner) ? $banner->description : '' ?> </textarea>
                            </div><!-- col -->
                        </div><!-- row -->
                    </section>
                    <h3 class="mb-2">ANEXOS DA PUBLICIDADE</h3>
                    <section>

                        <div class="row">

                            <div class="col-sm-12 col-md-6 col-lg-6 text-center  pt-4">
                                <div class="custom-file d-block ">
                                    <label class="custom-file-label az-content-label tx-11  btn  btn-az-primary pt-3 text-white" for="video_name">Selecione o video</label><br>
                                    <input type="file" class="custom-file-input " id="video_name" name="video_name">

                                </div>
                            </div><!-- col -->
                            <div class="col-sm-12 col-md-6 col-lg-6 ">
                                <div class="bg-white rounded mx-auto text-center " style="width:100%">
                                    <input class="col-md-12" type="hidden" id="image_data_banner" name="image">
                                    <input type="file" id="file_image_banner" class="d-none" accept="image/x-png,image/gif,image/jpeg">
                                    <div class="d-flex justify-content-center py-2 col-md-12 ">
                                        <?php if (isset($banner)) : ?>
                                            <?php if (is_file(FCPATH . $banner->image)) : ?>
                                                <img class="shadow-sm img-to-upload col-md-12" src="<?= base_url($banner->image) ?>" alt="image" title="Click to change image" id="image_banner">
                                            <?php else : ?>
                                                <img class="shadow-sm img-to-upload col-md-3" src="<?= base_url('public/img/camera.png') ?>" alt="image" title="Click to change image" id="image_banner">
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <img class="shadow-lg img-to-upload col-md-3 p-0" src="<?= base_url('public/img/camera.png') ?>" alt="image" title="Click to change image" id="image_banner">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div>
                    </section>
                    <h3>PAGAMENTOS</h3>
                    <section>
                        <div class="col-12 col-md-12">
                            <div id="carousel-payment" class="carousel slide" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="card">
                                            <datalist id="bankList">
                                                <?php foreach (get_all('service', ['is_bank' => 1]) as $item) : ?>
                                                    <option value="<?= $item->name ?>"></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                            <div class="card-body card-payment">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <div class="row row-cols-12 row-cols-lg-12 justify-content-center">
                                                            <?php foreach ($this->core_model->get_all('payment_method', array('active' => 1, 'parent_id' => null)) as $item) : ?>
                                                                <div class="col mb-3">
                                                                    <button value="<?= $item->id ?>" id="btn-payment-method-<?= $item->id ?>" class="btn btn-outline-secondary text-nowrap btn-block btn-payment-method bg-gray-200 text-info" style="height: 70pt">
                                                                        <?php if ($item->icon) : ?>
                                                                            <i class="<?= $item->icon ?> icon" id="icon-method-<?= $item->id ?>"></i>
                                                                        <?php else :; ?>
                                                                            <i class="fa fa-mobile fa-2x icon" id="icon-method-<?= $item->id ?>"></i>
                                                                        <?php endif; ?>
                                                                        <br>
                                                                        <span>
                                                                            <?= $item->name ?>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-10 border-left">

                                                        <div id="div-payment-card" class="d-none  rounded p-3">
                                                            <div class="form-group">
                                                                <input type="hidden" id="bank-service">
                                                                <h6 class="f-s-14 text-center bg-gray-200 rounded py-2 text-info f-w-600"><?= $this->lang->line('kind_service') ?></h6>
                                                                <div class="row row-cols-3 justify-content-center">
                                                                    <?php foreach ($this->core_model->get_all('payment_method', array('active' => 1, 'parent_id' => 2, 'id' => 13)) as $item) : ?>
                                                                        <div class="col mb-3">
                                                                            <button value="<?= $item->id ?>" data-parent="2" class="btn btn-outline-secondary text-nowrap btn-block btn-bank-service" style="height: 70pt">
                                                                                <?php if ($item->icon) : ?>
                                                                                    <i class="<?= $item->icon ?>"></i>
                                                                                <?php else :; ?>
                                                                                    <i class="fa fa-credit-card fa-2x"></i>
                                                                                <?php endif; ?>
                                                                                <br>
                                                                                <span>
                                                                                    <?= $item->name ?>
                                                                                </span>
                                                                            </button>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                            <div id="div-input-bank">
                                                                <?php $this->load->view('post/input_check') ?>
                                                            </div>
                                                        </div>
                                                        <div id="div-payment-mobile" class=" rounded">
                                                            <h6 class="f-s-14 text-center bg-gray-200 rounded py-2 text-info f-w-600"><?= $this->lang->line('kind_service') ?></h6>

                                                            <div class="form-group">
                                                                <input type="hidden" id="mobile-service">
                                                                <div class="row row-cols-3 justify-content-center">
                                                                    <?php foreach ($this->core_model->get_all('payment_method', array('active' => 1, 'parent_id' => 4)) as $item) : ?>
                                                                        <div class="col mb-3">
                                                                            <button value="<?= $item->id ?>" data-parent="4" class="btn btn-outline-secondary text-nowrap btn-block btn-mobile-service" style="height: 70pt">
                                                                                <i class="fa fa-mobile-alt fa-2x mb-2"></i>
                                                                                <br>
                                                                                <span>
                                                                                    <?= $item->name ?>
                                                                                </span>
                                                                            </button>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="mobile_number"><?= $this->lang->line('phone') ?>
                                                                            <span class="text-danger">&nbsp;*</span></label>
                                                                        <input type="text" class="form-control" id="mobile_number" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>

        </div>
    </div><!-- az-content -->
</div>
<?php $this->load->view('layout/public/footer'); ?>
<script src="<?= base_url() ?>public/assets/web/lib/jquery-steps/jquery.steps.min.js"></script>
<script src="<?= base_url() ?>public/assets/web/lib/parsleyjs/parsley.min.js"></script>
<script>
    cropImage(
        'image_banner',
        'file_image_banner',
        'image_data_banner',
        'modal-image',
        'div-cropper', 300, 410
    );

    let method_active = 1;
    $(document).on('click', '.btn-payment-method', function() {
        const type = parseInt($(this).val());
        method_active = type;
        if (type === 1) {
            $('#div-payment-card').addClass('d-none');
            $('#div-payment-cheque').addClass('d-none');
            $('#div-payment-numeric').removeClass('d-none');
            $('#div-payment-mobile').addClass('d-none');
        } else if (type === 2) {
            $('#div-payment-card').removeClass('d-none');
            $('#div-payment-cheque').addClass('d-none');
            $('#div-payment-numeric').addClass('d-none');
            $('#div-payment-mobile').addClass('d-none');
        } else if (type === 3) {
            $('#div-payment-card').addClass('d-none');
            $('#div-payment-cheque').removeClass('d-none');
            $('#div-payment-numeric').addClass('d-none');
            $('#div-payment-mobile').addClass('d-none');
        } else if (type === 4) {
            $('#div-payment-card').addClass('d-none');
            $('#div-payment-cheque').addClass('d-none');
            $('#div-payment-numeric').addClass('d-none');
            $('#div-payment-mobile').removeClass('d-none');
        }
        $('.btn-payment-method').removeClass('bg-gray-200 text-info');
        $(this).addClass('bg-gray-200 text-info');
        const parent = $(this).data('parent');
        console.log('type: ' + type);

        $('#btn-payment-method-' + parent).addClass('bg-gray-200 text-info')

        $('.icon').removeClass('text-info');
        $('#icon-method-' + type).addClass('text-info')
    });


    //bank service
    $(document).on('click', '.btn-bank-service', function() {
        const varx = $(this).val();
        console.log('bank: ' + varx);
        $('#bank-service').val(varx);
        $('.btn-bank-service').removeClass('bg-gray-200 text-info');
        $(this).addClass('bg-gray-200 text-info');
        const parent = $(this).data('parent');
        $('#btn-payment-method-' + parent).addClass('bg-gray-200 text-info')

        $.ajax({
            type: 'POST',
            data: {
                id: varx
            },
            url: "<?= base_url('request/getInputs') ?>",
            success: function(data) {
                $('#div-input-bank').html(data)
            }
        })
    });
    //mobile service
    $(document).on('click', '.btn-mobile-service', function() {
        $('#mobile-service').val($(this).val());

        if ($(this).val() == 11) {
            $('#mobile_reference').removeAttr('required');
            $('#div-reference').addClass('d-none');
        } else {
            $('#div-reference').removeClass('d-none');
            $('#mobile_reference').prop('required', true);
        }

        $('.btn-mobile-service').removeClass('bg-gray-200 text-info');
        $(this).addClass('bg-gray-200 text-info');
        const parent = $(this).data('parent');
        $('#btn-payment-method-' + parent).addClass('bg-gray-200 text-info')
    });


    $(function() {
        'use strict'

        $('#wizard1').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
        });

        $('#wizard2').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
            onStepChanging: function(event, currentIndex, newIndex) {
                if (currentIndex < newIndex) {
                    // Step 1 form validation
                    if (currentIndex === 0) {
                        var title = $('#title').parsley();
                        var description = $('#description').parsley();

                        if (title.isValid() && description.isValid()) {
                            return true;
                        } else {
                            title.validate();
                            description.validate();
                        }
                    }

                    // Step 2 form validation
                    if (currentIndex === 1) {
                        var video_name = $('#video_name').parsley();
                        if (video_name.isValid()) {
                            return true;
                        } else {
                            video_name.validate();
                        }
                    }
                    // Always allow step back to the previous step even if the current step is not valid.
                } else {
                    return true;
                }
            }
        });

        $('#wizard3').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
            stepsOrientation: 1
        });
    });
</script>