<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row mb-lg-2 d-flex justify-content-between">
            <div class="col-md-4">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-white"><i class="fa fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control no-focus" id="my-search"
                           placeholder="<?= $this->lang->line('search') ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table data-table table-hover table-bordered" id="table-service">
                <thead>
                <tr>
                    <th class="text-center no-sort" style="width: 5%">#</th>
                    <?php if ($type == 'bank-account'): ?>
                        <th style="width: 20%"><?= $this->lang->line('name') . 'no banco' ?></th>
                        <th style="width: 15%"><?= 'Titular' ?></th>
                        <th style="width: 15%"><?= 'Número' ?></th>
                        <th style="width: 15%"><?= 'NIB' ?></th>
                    <?php else: ?>
                        <th><?= $this->lang->line('name') ?></th>
                    <?php endif; ?>
                    <th style="width: 15%" class="text-center"><?= $this->lang->line('status') ?></th>
                    <th style="width: 15%" class="text-center"><?= $this->lang->line('actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($services as $counter => $service): ?>
                    <tr class="text-nowrap">
                        <td class="text-center"><?= $counter + 1 ?></td>
                        <?php if ($type == 'bank-account'): ?>
                            <td><?= get_by_id('service', ['id' => $service->parent_id])->name ?></td>
                            <td><?= $service->owner ?></td>
                            <td><?= $service->number ?></td>
                            <td><?= $service->nib ?></td>
                        <?php else: ?>
                            <td class="text-left"><?= $service->name ?></td>
                        <?php endif; ?>
                        <td class="text-center">
                            <?php if ($service->active == 1): ?>
                                <button class="btn btn-sm btn-outline-success text-center w-50 disabled" disabled>
                                    Activo
                                </button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-outline-danger text-center w-50 disabled" disabled>
                                    Inactivo
                                </button>
                            <?php endif ?>
                        </td>
                        <td class="text-center">
                            <a title="Show service"
                               class="btn btn-sm btn-outline-primary mr-2"
                               onclick="get_modal(<?= $service->id ?>,'service','small','show')">
                                <i class="fa fa-eye">&nbsp;</i><?= $this->lang->line('show') ?>
                            </a>

                            <a title="Show service"
                               class="btn btn-sm btn-outline-secondary"
                               onclick="get_modal(<?= $service->id ?>,'service','small','edit')">
                                <i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
