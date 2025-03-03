<form action="" id="form-banner">
    <input type="hidden" name="action" value="<?= isset($banner) ? 'update' : 'create'  ?>">
    <?php if (isset($banner)) : ?>
        <input type="hidden" name="id" value="<?= $banner->id  ?>">
    <?php endif; ?>
    <?php if (isset($contest_id)) : ?>
        <input type="hidden" name="contest_id" value="<?= $contest_id ?>">
    <?php endif; ?>


    <div class="col-md-12 ">
        <div class="form-group inputBox">
            <select id="select-tax" class="form-control" name="tax_id" style="width: 100%!important;">
                <option value="">Todos</option>
                <?php foreach (get_all('tax', ['active' => 1]) as $tax) : ?>
                    <option value="<?= $tax->id ?>" <?= isset($banner) ? ($banner->tax_id == $tax->id ? 'selected' : '') : '' ?>><?= $tax->name ?></option>
                <?php endforeach; ?>
            </select>
            <label for="select-tax">Responavel do tax</label>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="form-group inputBox no-icon">
            <input type="text" class="form-control" id="title" name="title" value="<?= isset($banner) ? $banner->title : '' ?>" autofocus>
            <label for="title"><?= 'Titulo' ?> <span class="text-danger">&nbsp;*</span></label>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="form-group inputBox no-icon">
            <textarea class="form-control" id="description" name="description" cols="30" rows="3"><?= isset($banner) ? $banner->title : '' ?> </textarea>
            <label for="description"><?= 'Descrição' ?> <span class="text-danger">&nbsp;*</span></label>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="form-group inputBox no-icon">
            <input type="text" class="form-control" id="link" name="link" value="<?= isset($banner) ? $banner->link : '' ?>" autofocus>
            <label for="link"><?= 'Link' ?> <span class="text-danger">&nbsp;*</span></label>
        </div>
    </div>
    <div class="card shadow-none border position-relative mx-3">
        <h6 class="position-absolute bg-white f-w-500 p-2 rounded-top border-top" style="top: -13px; left: 15px">Carregar video</h6>
        <div class="card-body pb-1">
            <div class="col-md-12 mt-3">
                <div class="form-group inputBox no-icon">
                    <input class="form-control" id="video_name" name="video_name" value="<?= isset($banner) ? $banner->path : '' ?>" autofocus readonly="readonly" type="file">
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-none border position-relative mx-3">
        <h6 class="position-absolute bg-white f-w-500 p-2 rounded-top border-top" style="top: -13px; left: 15px">Imagem (1920x600)</h6>
        <div class="card-body pb-1">
            <div class="col-md-12">
                <div class="bg-white rounded " style="width:100%">
                    <input class="col-md-12" type="hidden" id="image_data_banner" name="image">
                    <input type="file" id="file_image_banner" class="d-none" accept="image/x-png,image/gif,image/jpeg">
                    <div class="d-flex justify-content-center py-2 col-md-12">
                        <?php if (isset($banner)) : ?>
                            <?php if (is_file(FCPATH . $banner->image)) : ?>
                                <img class="shadow-sm img-to-upload col-md-12" src="<?= base_url($banner->image) ?>" alt="image" title="Click to change image" id="image_banner">
                            <?php else : ?>
                                <img class="shadow-sm img-to-upload col-md-6" src="<?= base_url('gallery/ads.png') ?>" alt="image" title="Click to change image" id="image_banner">
                            <?php endif; ?>
                        <?php else : ?>
                            <img class="shadow-lg img-to-upload col-md-6 p-0" src="<?= base_url('gallery/ads.png') ?>" alt="image" title="Click to change image" id="image_banner">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-sm btn-success">
            <i class="fa fa-save">&nbsp;</i><?= $this->lang->line('save') ?>
        </button>

    </div>
</form>
<script>
    $("#select-tax").select2({
        "language": {
            "noResults": function() {
                return "Sem resultado encontrado";
            }
        }
    })
</script>