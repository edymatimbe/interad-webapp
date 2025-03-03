<style>
    #form-tax .select2-container--default .select2-selection--single {
        padding-left: 0 !important;
    }
</style>
<form id="form-newspaper" method="post" autocomplete="off" class="h-100" enctype="multipart/form-data">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-agata">
                <?php if (isset($newspaper)) : ?>
                    <input type="hidden" name="id" value="<?= $newspaper->id ?>">
                    <input type="hidden" id="action" name="action" value="update">
                    <i class="feather icon-edit mr-2"></i><?= $this->lang->line('edit') . ' ' ?>

                <?php else : ?>
                    <input type="hidden" id="action" name="action" value="create">
                    <i class="feather icon-plus mr-2"></i><?= $this->lang->line('add') . ' ' ?>

                <?php endif; ?>
                <span class="text-lowercase">Jornal digital</span>
            </h5>
        </div>
        <div class="modal-body bg-gray-200">
            <div class="tab-content" id="tab-content">
                <div class="tab-pane transition fade top active show" id="tab-pane-tax">
                    <input type="hidden" name="id" value="<?= isset($newspaper) ? $newspaper->id : '' ?>">
                    <input type="hidden" name="action" value="<?= isset($newspaper) ? 'update' : 'create' ?>">
                    <div class="row">
                        <div class="col-12">
                            <div class="card pb-0">
                                <div class="card-body p-0 pt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nome do jornal<span class="text-danger">&nbsp;*</span></label>
                                            <input type="text" id="name" name="name" class="form-control" required value="<?= isset($newspaper) ? $newspaper->name : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="publish_date">Data da publicacao<span class="text-danger">&nbsp;*</span></label>
                                            <input type="date" id="publish_date" name="publish_date" class="form-control" required value="<?= isset($newspaper) ? $newspaper->name : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pdf_file">upload do Jornal(pdf)<span class="text-danger">&nbsp;*</span></label>
                                            <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept="application/pdf" required>
                                        
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="d-flex justify-content-between w-100">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <?= $this->lang->line('cancel') ?>
                </button>
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="feather icon-save">&nbsp;</i><?= $this->lang->line('save') ?>
                </button>
            </div>
        </div>
    </div>
</form>