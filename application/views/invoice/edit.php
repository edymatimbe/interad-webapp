<?php $this->load->view('layout/header') ?>

<style>
    tr.hide-table-padding td {
        padding: 0 !important;
        margin: 0 !important;
        height: 0 !important;
        border-top: none !important;
    }
</style>
<div class="col-12 mb-3">
    <div class="row  bg-white py-2 rounded">
        <div class="col-lg-8">
            <div class="row justify-content-between">
                <div class="col-lg-4 mb-lg-0 pt-2">
                    <i class="feather icon-shopping-cart text-agata border-right pr-2"></i>
                    <label for="" class="text-capitalize"><?= $title ?></label>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-0 position-relative">
                    <select id="select-sale-type-new" name="type_note" class="type_note border w-100 rounded bg-lights pl-4 select2-no-search" data-style="none" data-service="1">
                        <option value="credit" <?= $source == 'credit' ? 'selected' : '' ?>><?= 'Nota de crédito' ?></option>

                        <option value="debit" <?= $source == 'debit' ? 'selected' : '' ?>><?= 'Nota de débito' ?>
                        </option>
                    </select>
                    <i class="feather icon-file-text position-absolute border-right pr-2" style="left: 27px; top: 15px"></i>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0 d-none">
                    <div class="position-relative" style="width: 100%">
                        <select style="width: 100%" id="select-reason" class="f-s-8 pl-5">
                            <?php foreach ($this->core_model->get_all('note_reason', ['active' => 1]) as $item) : ?>
                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <i class="feather icon-edit-1 position-absolute border-right pr-2" style="left: 10px; top: 13px"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex mb-4 mb-lg-0">
            <div style="width: 100%" class="position-relative">
                <select style="width: 100%" id="select-customer" class="f-s-8 pl-5 select_customers">
                    <?php $this->load->view('invoice/service/_customerSelect', array('customer_id' => $customer_id)) ?>
                </select>
                <i class="feather icon-user position-absolute border-right pr-2" style="left: 10px; top: 13px"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title text-agata mb-0">
                    <i class="feather icon-list"></i>
                    Items da factura
                </h6>
            </div>
            <div class="card-body pb-0">
                <div class="list-group">
                    <div class="list-group-item">
                        Nº da factura
                        <span class="float-right"><?= $invoice->number ?></span>
                    </div>
                </div>
                <br>
                <div class="d-flex flex-column justify-content-between h-100">
                    <div class="table-responsive" id="div-table-sm" style="overflow-x: auto; overflow-y: auto">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-capitalize"><?= $this->lang->line(is_service() ? 'service' : 'product') ?></th>
                                    <th class="text-right"><?= $this->lang->line('price') ?></th>
                                    <th class="text-right"><?= $this->lang->line('quantity_sm') ?></th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item) : ?>
                                    <?php $price = $item->other_price == 0 ? $item->price : $item->other_price ?>
                                    <tr>
                                        <td><?= $item->product ?></td>
                                        <td class="text-right"><?= $this->cart->format_number($price) ?></td>
                                        <td class="text-right"><?= $item->quantity ?></td>
                                        <td class="text-right"><?= $this->cart->format_number($price * $item->quantity) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <ul class="list-group list-group-flush mb-lg-4 f-s-15 px-2">
                        <?php if ($invoice->discount > 0) : ?>
                            <li class="list-group-item px-0">
                                <span class="f-w-600 text-capitalize"><?= $this->lang->line('discount') ?></span>
                                <span class="float-right cart-discount"><?= number_format($invoice->discount, 2) ?> MT</span>
                            </li>
                        <?php endif ?>
                        <li class="list-group-item px-0">
                            <span class="f-w-600">Subtotal</span><span class="float-right cart-subtotal"><?= number_format($invoice->subtotal, 2) ?> MT</span>
                        </li>
                        <li class="list-group-item px-0">
                            <span class="f-w-600 text-capitalize"><?= 'Iva ( ' . tax() . ' %)' ?></span><span class="float-right cart-tax"><?= number_format($invoice->total - $invoice->subtotal, 2) ?> MT</span>
                        </li>
                        <li class="list-group-item px-0">
                            <span class="f-w-600">Total</span><span class="float-right cart-total"><?= number_format($invoice->total, 2) ?> MT</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8" id="render-content">

        <?= $this->load->view('invoice/_edit_table', null, true) ?>
    </div>
</div>


<script>
    $('.table-collapse').on('hidden.bs.collapse', function() {
        // do something...
    });
    $(document).ready(function() {

        <?php if (is_service()) : ?>
            $('#menu-service').addClass('active pcoded-trigger');
            $('#menu-service .invoice').addClass('active');
            $('#menu-service .pcoded-submenu').css('display', 'block');

        <?php else : ?>
        <?php endif; ?>

        setFullHeight('#div-table', 100);
        setFullHeight('#div-table-sm', 45);

        $('#select-reason').select2({
            "language": {
                "noResults": function() {
                    return "Sem resultado encontrado";
                }
            }
        }).on('select2:select', function(e) {
            // setCustomer(e.params.data.id, false)
        });

        $("#select-customer").select2({
            "language": {
                "noResults": function() {
                    return "Sem resultado encontrado";
                }
            }
        }).on('select2:select', function(e) {
            // setCustomer(e.params.data.id, false)
        });
    });

    $(document).on('submit', '.form-item', function(e) {
        e.preventDefault();
        const quantity_element = $(this).find('input.quantity');
        const price_element = $(this).find('input.price');
        const old_quantity = quantity_element.data('value');
        const new_quantity = quantity_element.val();

        const old_price = price_element.data('value');
        const new_price = price_element.val();

        if (parseInt(old_quantity) === parseInt(new_quantity) && parseFloat(old_price) === parseFloat(new_price)) {
            show_toast_warning('Nao foi alterado nenhum  dado')
        } else {
            $.ajax({
                url: "<?= base_url('invoice/update_item_edit') ?>",
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'JSON',
                beforeSend: function() {
                    show_loader();
                },
                success: function(data) {
                    close_loader();
                    if (data.ok) {
                        show_toast_success(data.message);
                        update_edit_table();
                    }
                }
            });
        }
    });

    $(document).on('click', '.btn-remove', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        Swal.fire({
            title: "",
            text: "Confirmar",
            icon: "question",
            confirmButtonColor: "#f6354c",
            confirmButtonText: "<i class='feather icon-trash mr-2'></i>Sim",
            cancelButtonText: "<i class='feather icon-x mr-2'></i>Cancelar",
            cancelButtonClass: 'bg-dark',
            showCancelButton: true,
        }).then(function(rs) {
            if (rs.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    data: {
                        'id': id
                    },
                    dataType: "JSON",
                    url: "<?= base_url('invoice/remove_item_from_edit') ?>",
                    success: function(data) {
                        update_edit_table();
                    }
                });
            }
        })
    });

    // select-sale-type-new
    $('#select-sale-type-new').on('change', function() {
        var render = '';

        if (this.value === 'credit') {
            render = '<h6 class="card-title text-agata mb-0">' +
                '<i class="feather icon-list"></i>' +
                ' Items da Nota de credito</h6>';
        } else {
            render = '<h6 class="card-title text-agata mb-0">' +
                '<i class="feather icon-list"></i>' +
                ' Items da Nota de debito</h6>';
        }

        $('#render_type').html(render)
    });




    $(document).on('input', '#reason_note', function() {
        $.ajax({
            url: "<?= base_url('invoice/set_my_cookie') ?>",
            type: 'POST',
            data: {
                target: 'reason_note',
                value: $(this).val()
            }
        });
    });

    function update_edit_table() {
        $.ajax({
            type: 'GET',
            url: "<?= base_url('invoice/update_edit_table') ?>",
            success: function(data) {
                $('#render-content').html(data.table);
                setFullHeight('#div-table', 100);
            }
        });
    }

    $(document).on('input', '.quantity', function() {
        const id = $(this).data('id');
        const old_value = parseInt($(this).data('value'));
        let value = parseInt($(this).val());
        const source = $('#source').val().toString();
        var type_note = $('.type_note').val();

        if (type_note === 'credit') {
            if (old_value < value) {
                $(this).val(old_value);
                value = old_value;
            }
        } else if (source === 'debit') {
            if (old_value < value) {
                $(this).val(old_value);
                value = old_value;
            }
        }

        const price = parseFloat($('#price-' + id).val());
        $('#subtotal-' + id).val((value * price).toFixed(2));
    });

    $(document).on('input', '.price', function() {
        const id = $(this).data('id');
        const old_value = parseFloat($(this).data('value'));
        let value = parseFloat($(this).val());
        const source = $('#source').val().toString();
        var type_note = $('.type_note').val();

        if (type_note === 'credit') {
            if (old_value < value) {
                $(this).val(old_value);
                value = old_value;
            }
        } else if (source === 'debit') {
            if (old_value > value) {
                $(this).val(old_value);
                value = old_value;
            }
        }

        const qty = parseInt($('#quantity-' + id).val());
        $('#subtotal-' + id).val((value * qty).toFixed(2));
    });

    function save_note(text) {
        Swal.fire({
            title: "",
            text: text + " ?",
            icon: "question",
            confirmButtonColor: "#00a897",
            confirmButtonText: "<i class='feather icon-printer mr-2'></i>Sim",
            cancelButtonText: "<i class='feather icon-x mr-2'></i>Cancelar",
            cancelButtonClass: 'bg-dark',
            showCancelButton: true,
        }).then(function(rs) {
            if (rs.isConfirmed) {


                var type_note = $('.type_note').val()
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: "<?= base_url('invoice/save_note') ?>",
                    data: {
                        'type_note': type_note
                    },
                    beforeSend: function() {
                        show_loader();
                    },
                    success: function(data) {
                        console.log(data)
                        close_loader();
                        if (data.ok) {
                            // printJS({
                            //     printable: data.b64Doc,
                            //     type: 'pdf',
                            //     base64: true
                            // });
                            localStorage.setItem('note_saved', '<?= is_service() ?>');
                            if (data.service == 1) {
                                window.location.href = "<?= base_url('invoices-service') ?>";
                            } else {
                                localStorage.setItem("link_history", 'note');
                                window.location.href = "<?= base_url('sales') ?>";
                            }

                            show_toast_success(data.message);
                        } else {
                            show_toast_warning(data.message)
                        }
                    },
                    error: function() {
                        close_loader();
                        show_toast_error('erro ao tentar salvar factura')
                    }
                })
            }
        });
    }
</script>

<?php $this->load->view('layout/footer') ?>