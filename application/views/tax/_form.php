<style>
    #form-tax .select2-container--default .select2-selection--single {
        padding-left: 0 !important;
    }
</style>
<form id="form-tax" method="post" autocomplete="off" class="h-100">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-agata">
                <?php if (isset($tax)) : ?>
                    <input type="hidden" name="id" value="<?= $tax->id ?>">
                    <input type="hidden" id="action" name="action" value="update">
                    <i class="feather icon-edit mr-2"></i><?= $this->lang->line('edit') . ' ' ?>

                <?php else : ?>
                    <input type="hidden" id="action" name="action" value="create">
                    <i class="feather icon-plus mr-2"></i><?= $this->lang->line('add') . ' ' ?>

                <?php endif; ?>
                <span class="text-lowercase">Tax</span>
            </h5>
        </div>
        <div class="modal-body bg-gray-200">
            <div class="tab-content" id="tab-content">
                <div class="tab-pane transition fade top active show" id="tab-pane-tax">
                    <input type="hidden" name="barcode" value="<?= isset($tax) ? $tax->barcode : '' ?>">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body pb-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Responsavel do carro<span class="text-danger">&nbsp;*</span></label>
                                                <input type="text" id="name" name="name" class="form-control" required value="<?= isset($tax) ? $tax->name : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div-not-service" class="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="brand_id" class="text-capitalize"><?= $this->lang->line('brand') ?><span class="text-danger">&nbsp;*</span></label>
                                                    <div class="input-group">
                                                        <div class="" style="width: 85%">
                                                            <select name="brand_id" class="form-control select" style="width: 100%" required id="brand_id">
                                                                <option value="">Selecione</option>
                                                                <?php foreach ($this->core_model->get_all_order('brand', array('active' => 1)) as $brand) : ?>
                                                                    <option value="<?= $brand->id ?>" <?= isset($tax) ? ($brand->id == $tax->brand_id ? 'selected' : '') : '' ?>><?= $brand->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group-append" style="width: 15%">
                                                            <button data-name="<?= $this->lang->line('new2') . ' ' . $this->lang->line('brand') ?>" data-object="brand" data-target="brand_id" type="button" title="Add brand" class="btn-new btn btn-sm btn-outline-secondary text-nowrap w-100">
                                                                <i class="feather icon-plus">&nbsp;</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="category_id" class="text-capitalize">modelo<span class="text-danger">&nbsp;*</span></label>
                                                    <div class="input-group">
                                                        <div class="" style="width: 85%">
                                                            <select name="category_id" class="form-control select" style="width: 100%" required id="category_id">
                                                                <option value="">Selecione</option>
                                                                <?php foreach ($this->core_model->get_all_order('category', array('active' => 1, 'is_service' => 0)) as $category) : ?>
                                                                    <option value="<?= $category->id ?>" <?= isset($tax) ? ($category->id == $tax->category_id ? 'selected' : '') : '' ?>><?= $category->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group-append" style="width: 15%">
                                                            <button data-name="Adicionar novo modelo" data-object="category" data-target="category_id" type="button" title="Add category" class="btn-new btn btn-sm btn-outline-secondary text-nowrap w-100">
                                                                <i class="feather icon-plus">&nbsp;</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body pb-5 pt-lg-5">
                                    <input type="hidden" id="image_data_tax" name="image">
                                    <input type="file" id="file_image_tax" class="d-none" accept="image/x-png,image/gif,image/jpeg">
                                    <div class="d-flex justify-content-center">
                                        <img class="shadow-sm img-to-upload" src="<?= base_url('public/img/camera.png') ?>" title="Click to change image" id="image_tax" alt="image category">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card pb-0">
                                <div class="card-body p-0 pt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="registration">Matricula<span class="text-danger">&nbsp;*</span></label>
                                            <input type="text" id="registration" name="registration" class="form-control" required value="<?= isset($tax) ? $tax->registration : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="registration">Descrição<span class="text-danger">&nbsp;*</span></label>
                                            <textarea name="description" id="description" class="form-control"><?= isset($tax) ? $tax->description : '' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="access_code">Codigo de acesso<span class="text-danger">&nbsp;*</span></label>
                                            <input type="text" id="access_code" name="access_code" class="form-control" required value="<?= isset($tax) ? $tax->access_code : '' ?>">
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