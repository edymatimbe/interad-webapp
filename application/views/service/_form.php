<form id="form-service" method="post" autocomplete="off" class="h-100">
    <input type="hidden" name="type" value="<?= $type ?>">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-info">
                <?php if (isset($service)) : ?>
                    <i class="feather icon-edit">&nbsp;</i>
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= $service->id ?>">
                <?php else : ?>
                    <i class="feather icon-plus">&nbsp;</i>
                    <input type="hidden" name="action" value="create">
                <?php endif; ?>
                <?= isset($service) ? 'Editar' : 'Registar' ?>
                <?= $type_name ?>
            </h5>
        </div>
        <div class="modal-body bg-gray-200">
            <div class="card">
                <div class="card-body">
                    <?php if ($type == 'bank-account'): ?>
                        <br>
                        <input type="hidden" name="name" value="<?= isset($service) ? $service->name : $this->core_model->code_generator('service',['type'=>'bank-account']) ?>">
                        <div class="inputBox no-icon mb-3">
                            <select name="parent_id" id="parent_id" class="select2-no-search" style="width: 100%" required>
                                <option value="">Selecione</option>
                                <?php foreach (get_all('service', ['type' => 'bank'], ['name', 'ASC']) as $item): ?>
                                    <option value="<?= $item->id ?>" <?= isset($service) ? $service->parent_id==$item->id?'selected':'' : '' ?>><?= $item->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="parent_id">Banco <span class="text-danger">*</span></label>
                        </div>
                        <br>
                        <div class="inputBox no-icon mb-3">
                            <input type="text" name="owner" id="owner" required value="<?= isset($service) ? $service->owner : '' ?>">
                            <label for="owner">Titular <span class="text-danger">*</span></label>
                        </div>
                        <div class="inputBox no-icon mb-3">
                            <input type="text" name="number" id="number" required value="<?= isset($service) ? $service->number : '' ?>">
                            <label for="number">Núumero <span class="text-danger">*</span></label>
                        </div>
                        <div class="inputBox no-icon">
                            <input type="text" name="nib" id="nib" required value="<?= isset($service) ? $service->nib : '' ?>">
                            <label for="nib">NIB <span class="text-danger">*</span></label>
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <label for="name"><?= $this->lang->line('name') ?></label>
                            <input type="text" id="name" name="name" class="form-control" required
                                   value="<?= isset($service) ? $service->name : '' ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (isset($service)): ?>
                        <div class="d-flex justify-content-end">
                            <br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="active_1" name="active" value="1"
                                       class="custom-control-input" <?= $service->active == 1 ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="active_1">Activo</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="active_2" name="active" value="0"
                                       class="custom-control-input" <?= $service->active == 0 ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="active_2">Inactivo</label>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="d-flex justify-content-between w-100">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <?= $this->lang->line('cancel') ?>
                </button>
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fa fa-save">&nbsp;</i><?= $this->lang->line('save') ?>
                </button>
            </div>
        </div>
    </div>
</form>
