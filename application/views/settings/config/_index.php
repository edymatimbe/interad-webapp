<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card border shadow-none position-relative">
                            <?php if ($this->core_model->is_granted('config_update')): ?>
                                <button type="button" class="btn btn-sm btn-dark position-absolute"
                                        onclick="set_config()"
                                        style="right: 10px; top: -18px">
                                    <i class="feather icon-edit mr-2"></i>Editar
                                </button>
                            <?php endif; ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h6 class="mb-0 f-w-600"><?= 'Hora de entrada' ?></h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary text-right">
                                        <?= $setting->time_in ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h6 class="mb-0 f-w-600"><?= 'Hora de saída' ?></h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary text-right">
                                        <?= $setting->time_out ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h6 class="mb-0 f-w-600"><?= 'Hora inicial do intervalo' ?></h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary text-right">
                                        <?= $setting->interval_begin ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h6 class="mb-0 f-w-600"><?= 'Hora final do intervalo' ?></h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary text-right">
                                        <?= $setting->interval_end ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h6 class="mb-0 f-w-600"><?= 'Hora de entrada no sábado' ?></h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary text-right">
                                        <?= $setting->time_in_saturday ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h6 class="mb-0 f-w-600"><?= 'Hora de saída no sábado' ?></h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary text-right">
                                        <?= $setting->time_out_saturday ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <h6 class="mb-0 f-w-600"><?= 'Horas de trabalho' ?></h6>
                    </div>
                    <div class="col-sm-4 text-secondary text-right">
                        <?= get_time_worked_db() ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8">
                        <h6 class="mb-0 f-w-600"><?= 'Tempo de intervalo' ?></h6>
                    </div>
                    <div class="col-sm-4 text-secondary text-right">
                        <?= get_time_lunch_db() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><i class="feather icon-calendar mr-2"></i>Definição de dias úteis</h5>
            </div>
            <div class="card-body pb-0">
                <select multiple id="select-day">
                    <?php foreach (days_of_week() as $item): ?>
                        <option <?= $this->setting_model->is_working_day($item['id']) == -1 ? '' : 'selected' ?>
                                value="<?= $item['id'] ?>"><?= $item['text'] ?></option>
                    <?php endforeach; ?>
                </select>
                <hr>
                <button class="btn btn-outline-primary mb-3 float-right" id="btn-save-days" disabled
                        onclick="save_days()"><i class="feather icon-save mr-2"></i>Salvar
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><i class="feather icon-calendar mr-2"></i>Salário mínimo para cálculo de IRPS 
                </h5>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-6">
                        <input type="hidden" id="irps_min_salary_old"
                               value="<?= this_number_format(get_setting()->irps_min_salary) ?>">
                        <input type="text" id="irps_min_salary" class="form-control"
                               value="<?= this_number_format(get_setting()->irps_min_salary) ?>">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-outline-primary mb-3 float-right" id="btn-save-irps-salary"
                                onclick="update_irps_salary()"><i class="feather icon-save mr-2"></i>Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" autocomplete="off" id="form-currency-format">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-money mr-2"></i>Formato de valores monetários</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 pt-3">
                            <div class="inputBox no-icon mb-1">
                                <input id="currency_decimals" name="currency_decimals" type="number" min="2" max="10"
                                       class="input-currency"
                                       value="<?= $setting->currency_decimals ?>">
                                <label for="currency_decimals">Nº de casa decimais</label>
                            </div>
                            <div class="inputBox no-icon">
                                <select id="currency_dec_point" name="currency_dec_point"
                                        class="select2-no-search input-currency"
                                        style="width: 100%">
                                    <option value="." <?= $setting->currency_dec_point == '.' ? 'selected' : '' ?>>.
                                    </option>
                                    <option value="," <?= $setting->currency_dec_point == ',' ? 'selected' : '' ?>>,
                                    </option>
                                </select>
                                <label for="currency_dec_point">Separador de dezenas</label>
                            </div>
                            <br>
                            <div class="inputBox no-icon">
                                <select id="currency_thousand_sep" name="currency_thousand_sep"
                                        class="select2-no-search input-currency"
                                        style="width: 100%">
                                    <option value="." <?= $setting->currency_thousand_sep == '.' ? 'selected' : '' ?>>.
                                    </option>
                                    <option value="," <?= $setting->currency_thousand_sep == ',' ? 'selected' : '' ?>>,
                                    </option>
                                </select>
                                <label for="currency_thousand_sep">Separador de decimais</label>
                            </div>
                            <br>
                            <div class="inputBox no-icon">
                                <select id="currency_code" name="currency_code" class="my-select2 input-currency"
                                        style="width: 100%">
                                    <?php foreach (get_all('currency') as $currency): ?>
                                        <option value="<?= $currency->code ?>" <?= $currency->code == $setting->currency_code ? 'selected' : '' ?>>
                                            <?= $currency->name . ' (' . $currency->code . ')  [' . $currency->symbol . ']' ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="currency_code">Moeda (code) [symbol]</label>
                            </div>
                        </div>
                        <div class="col-md-8">

                            <div class="d-flex justify-content-between">

                                <div class="custom-control custom-checkbox mb-4 pt-3">
                                    <input type="checkbox" class="custom-control-input input-currency"
                                           id="show_currency" name="show_currency" value="1"
                                        <?= $setting->show_currency == 1 ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="show_currency">Mostrar moeda</label>
                                </div>

                                <fieldset style="width: 65%"
                                          class="alert pt-0 pb-1 alert-light border mb-3 d-flex justify-content-between">
                                    <legend class="f-s-13 mb-0">Code or symbol</legend>
                                    <label class="custom-radio-input">
                                        <input type="radio" name="show_currency_code_symbol" class="input-currency"
                                               value="code" <?= $setting->show_currency_code_symbol == 'code' ? 'checked' : '' ?> >
                                        <span class="check-mark"></span>
                                        <span>Code</span>
                                    </label>
                                    <label class="custom-radio-input">
                                        <input type="radio" name="show_currency_code_symbol" class="input-currency"
                                               value="symbol" <?= $setting->show_currency_code_symbol == 'symbol' ? 'checked' : '' ?> >
                                        <span class="check-mark"></span>
                                        <span>Symbol</span>
                                    </label>
                                </fieldset>
                            </div>

                            <fieldset class="alert pt-0 pb-1 alert-light border  mb-3 d-flex justify-content-between">
                                <legend class="f-s-13 mb-0">Posição da moeda</legend>
                                <label class="custom-radio-input">
                                    <input type="radio" name="currency_code_position" class="input-currency"
                                           value="start" <?= $setting->currency_code_position == 'start' ? 'checked' : '' ?> >
                                    <span class="check-mark"></span>
                                    <span>No início</span>
                                </label>
                                <label class="custom-radio-input">
                                    <input type="radio" name="currency_code_position" class="input-currency"
                                           value="end" <?= $setting->currency_code_position == 'end' ? 'checked' : '' ?> >
                                    <span class="check-mark"></span>
                                    <span>No fim</span>
                                </label>
                            </fieldset>

                            <br>
                            <div class="inputBox no-icon">
                                <input type="text" id="input-result-currency-format" class="f-s-47 text-right f-w-600"
                                       readonly
                                       value="<?= this_number_format(10000.87) ?>">
                                <label for="input-result-currency-format">Formato</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-primary float-right" type="submit">
                        <i class="feather icon-save mr-2"></i>Salvar
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
    <input type="hidden" name="action" value="1" id="currency_is_save">
</form>

<script>
    function update_irps_salary() {
        const value = $("#irps_min_salary").val();
        if (value) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('settings/update_irps_salary')?>",
                dataType: 'JSON',
                data: {value: value},
                success: function (data, textStatus) {
                    show_message(data.message, data.status);
                    $('#nav-link-other-config').trigger('click')
                }, error: function () {
                    show_message('Error', 'error')
                }
            });
        }
    }

    var days = '';
    $(document).ready(function () {
        $('#select-day').bootstrapDualListbox({
            filterTextClear: 'Limpar',
            filterPlaceHolder: 'Pesquisar',
            moveAllLabel: 'Mover todos',
            infoText: '',
            infoTextEmpty: '',
            selectorMinimalHeight: 115,
            btnClass: 'btn-primary',
            btnMoveAllText: '<i class="fa fa-chevron-right"></i>',
            btnRemoveAllText: '<i class="fa fa-chevron-left"></i>',
        }).on('change', function () {
            days = JSON.stringify($('#select-day').val());
            if (days) {
                $('#btn-save-days').removeAttr('disabled')
            }
        });
        $('.bootstrap-duallistbox-container select').addClass('rounded-bottom border-light shadow-sm pt-2 pl-2');

        setUpDualBox('box1', 'Dias não úteis');
        setUpDualBox('box2', 'Dias úteis');
        $('.box1').addClass('w-100')
    });

    function save_days() {
        if (days) {
            set_working_days(days)
        }
    }

    function switch_dot(val) {
        if (val === ',') {
            return '.'
        } else {
            return ','
        }
    }

    $(document).on('change', '.input-currency', function () {

        if ($(this).attr('id') === 'currency_dec_point') {
            if ($('#currency_thousand_sep').val() === $(this).val()) {
                $('#currency_thousand_sep').val(switch_dot($(this).val()))
            }
        }
        if ($(this).attr('id') === 'currency_thousand_sep') {
            if ($('#currency_dec_point').val() === $(this).val()) {
                $('#currency_dec_point').val(switch_dot($(this).val()))
            }
        }
        format_currency();
    });

    function format_currency() {
        $('#currency_is_save').val('0');
        $('#form-currency-format').trigger('submit');
    }

    $(document).on('submit', '#form-currency-format', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('settings/set_currency_format')?>",
            dataType: 'JSON',
            data: $(this).serialize(),
            success: function (data, textStatus) {
                if (data.action === 0) {
                    $('#currency_is_save').val('1');
                    $('#input-result-currency-format').val(data.format)
                } else {
                    show_message(data.message, data.status)
                }
            }, error: function () {
                show_message('Error', 'danger')
            }
        });
    })
</script>

