<form id="form-zone" method="post" autocomplete="off" class="h-100">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-info">
                <?php if (isset($zone)) : ?>
                    <i class="feather icon-edit">&nbsp;</i>
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= $zone->id ?>">
                <?php else : ?>
                    <i class="feather icon-plus">&nbsp;</i>
                    <input type="hidden" name="action" value="create">
                <?php endif; ?>
                <?= isset($zone) ? 'Editar' : 'Registar' ?> <span class="text-lowercase"><?='Zona / bairro'?></span>
            </h5>
        </div>
        <div class="modal-body bg-gray-200">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><?= $this->lang->line('name') ?></label>
                        <input type="text" id="name" name="name" class="form-control" required value="<?=isset($zone)?$zone->name:'' ?>">
                    </div>
                    <br>
                    <div class="form-group inputBox no-icon">
                        <select name="district_id" class="form-control select2-no-search" id="district_id" style="width: 100%">
                            <option value=""><?= $this->lang->line('select') ?></option>
                            <?php foreach (get_all('district',null,['name','ASC']) as $item): ?>
                                <option value="<?= $item->id ?>"
                                    <?=isset($zone)?($zone->district_id == $item->id?'selected':''):(isset($from_district)?$from_district==$item->id?'selected':'':'') ?>><?= $item->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="district_id">Distrito</label>
                    </div>

                    <?php if (isset($zone)): ?>
                        <div class="d-flex justify-content-end">
                            <br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="active_1" name="active" value="1"
                                       class="custom-control-input" <?= $zone->active == 1 ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="active_1">Activo</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="active_2" name="active" value="0"
                                       class="custom-control-input" <?= $zone->active == 0 ? 'checked' : '' ?>>
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
