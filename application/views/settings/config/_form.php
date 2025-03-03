<form id="form-config" autocomplete="off" class="h-100">
    <input type="hidden" name="action" value="create">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-micro">
                <i class="feather icon-edit">&nbsp;</i> Outras configurações
            </h5>
        </div>
        <div class="modal-body bg-gray-200">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="time_in"> Hora de entrada </label>
                                <input type="time" value="<?= $config->time_in ?>" name="time_in"
                                       class="form-control"
                                       id="time_in">
                            </div>

                            <div class="form-group">
                                <label for="time_out"> Hora de saída </label>
                                <input type="time" name="time_out" value="<?= $config->time_out ?>"
                                       class="form-control" id="time_out">
                            </div>

                            <div class="form-group">
                                <label for="interval_begin"> Hora inicial do intervalo </label>
                                <input type="time" name="interval_begin" value="<?= $config->interval_begin ?>"
                                       class="form-control" id="interval_begin">
                            </div>

                            <div class="form-group">
                                <label for="interval_end"> Hora final do intervalo </label>
                                <input type="time" name="interval_end" value="<?= $config->interval_end ?>"
                                       class="form-control" id="interval_end">
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="time_in_saturday"> Hora de entrada no sádado</label>
                                <input type="time" value="<?= $config->time_in_saturday ?>" name="time_in_saturday"
                                       class="form-control"
                                       id="time_in_saturday">
                            </div>

                            <div class="form-group">
                                <label for="time_out_saturday"> Hora de saída no sádado</label>
                                <input type="time" name="time_out_saturday" value="<?= $config->time_out_saturday ?>"
                                       class="form-control" id="time_out_saturday">
                            </div>

                        </div>
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
                    <i class="fa fa-save">&nbsp;</i><?= $this->lang->line('update') ?>
                </button>
            </div>
        </div>
    </div>
</form>
