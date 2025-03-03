<div class="card my-3">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 d-flex flex-column justify-content-center">
                <h6 class="mb-0 f-s-13 d-block my-auto"><?= $this->lang->line('created_at') ?>:</h6>
            </div>

            <div class="col-sm-6 text-right">
                <p class="mb-1">
                    <i class="feather icon-calendar mr-2"></i> <?= date_format(date_create($object->created_at), 'd-m-Y H:i') ?>
                </p>
                <p class="mb-0">
                    <i class="feather icon-user mr-2"></i><?= $this->core_model->get_by_id('users', array('id' => $object->created_by))->first_name ?>
                </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 d-flex flex-column justify-content-center">
                <h6 class="mb-0 f-s-13 d-block my-auto"><?= $this->lang->line('updated_at') ?>:</h6>
            </div>

            <div class="col-sm-6 text-right">
                <p class="mb-1">
                    <i class="feather icon-calendar mr-2"></i><?= date_format(date_create($object->updated_at), 'd-m-Y H:i') ?>
                </p>
                <p class="mb-0">
                    <i class="feather icon-user mr-2"></i><?= $this->core_model->get_by_id('users', array('id' => $object->updated_by))->first_name ?>
                </p>
            </div>
        </div>
    </div>
</div>