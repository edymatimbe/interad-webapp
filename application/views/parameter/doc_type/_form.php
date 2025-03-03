<form id="form-doc-type" autocomplete="off" class="h-100">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-micro">
                <?php if (isset($doc_type)): ?>
                    <i class="feather icon-edit">&nbsp;</i>
                    Editar o tipo de docmento
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= $doc_type->id ?>">
                <?php else: ?>
                    <i class="feather icon-plus">&nbsp;</i>
                    Registar tipo de documento
                    <input type="hidden" name="action" value="create">
                <?php endif; ?>
            </h5>
        </div>
        <div class="modal-body bg-gray-200">
            <div class="card mb-3">
                <div class="card-body pb-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name"><?= "Nome do documento" ?></label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="<?= (isset($doc_type) ? $doc_type->name : '') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="character"><?= "Número de caracteres " ?></label>
                                <input type="text" class="form-control" id="character" name="character"
                                       value="<?= (isset($doc_type) ? $doc_type->character : '') ?>">
                            </div>
                        </div>

                        <?php if (isset($doc_type)): ?>
                            <div class="col-md-6 pt-md-2">
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="active_1" name="active" value="1"
                                           class="custom-control-input" <?= $doc_type->active == 1 ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="active_1">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="active_2" name="active" value="0"
                                           class="custom-control-input" <?= $doc_type->active == 0 ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="active_2">Inactivo</label>
                                </div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="active" value="1">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <div class="d-flex justify-content-between w-100">
                <button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">
                    <i class="fa fa-arrow-left">&nbsp;</i><?= $this->lang->line('cancel') ?>
                </button>
                <button type="submit" class="btn btn-sm btn-success" id="btn-modal-submit">
                    <i class="feather icon-save">&nbsp;</i><?= $this->lang->line('save') ?>
                </button>
            </div>
        </div>
    </div>
</form>
