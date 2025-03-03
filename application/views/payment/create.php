<?php $this->load->view('layout/header') ?>


<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2">
            <i class="fa fa-money-check text-micro border-right pr-2"></i>
            <label for="" class=""><?= 'Novo pagamento' ?></label>
        </div>
        <div class="col-6">

        </div>
    </div>
</div>

<div id="div-render">
    <?php $this->load->view('payment/_create') ?>
</div>
<br>
<br>
<br>
<br>
<script src="<?= base_url() ?>public/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script !src="">
    $('#menu-payment').addClass('active pcoded-trigger');
    $('#menu-payment .create').addClass('active');
    $('#menu-payment .pcoded-submenu').css('display', 'block');


    $(document).ready(function () {
        $("#select-customer").select2({
            "language": {
                "noResults": function () {
                    return "Sem resultado encontrado";
                }
            }
        })
    });
    let customer = 0;
    $(document).on('change', '#select-customer', function () {
        const id = $(this).val();
        customer = id;
        $.ajax({
            type: 'POST',
            data: {id: id},
            url: '<?=base_url('payment/getPendingInvoice')?>',
            beforeSend: function () {
                show_loader()
            },
            success: function (data) {
                $('#div-render').html(data);
                $("#select-customer").select2({
                    "language": {
                        "noResults": function () {
                            return "Sem resultado encontrado";
                        }
                    }
                });
                $('#amount-before').focus();
                updateSelect2NoSearch();
                close_loader();
            }
        })
    });
    let change = 0;
    let installParceledID = 0;
    let later = false;
    let is_debt_2 = 0;

    function savePayment() {
        const amount = $('#amount').val();
        if (!amount) {
            show_toast_warning('insira o valor a pagar');
            return;
        }

        const total_debt = $('#total_debt').val();

    

        const data = getMethod()[1];
        const canSave = getMethod()[0];
        data['loan_id'] = $('#loan_id').val();
        data['is_debt_2'] = is_debt_2;
        data['payment_date'] =  $('#payment_date').val();
        data['customer_id'] =  $('#customer_id').val();
        data['controller_id'] =  $('#controller_id').val();

        
        if (canSave) {
            Swal.fire({
                title: "", 
                text: "Confirmar",
                icon: "question",
                confirmButtonColor: "#00a897",
                confirmButtonText: "<i class='feather icon-save mr-2'></i>Sim",
                cancelButtonText: "<i class='feather icon-x mr-2'></i>Cancelar",
                showCancelButton: true,
            }).then(function (rs) {
                if (rs.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        data: data,
                        url: '<?=base_url('payment/save')?>',
                        beforeSend: function () {
                            show_loader()
                        },
                        success: function (data) {
                            console.log(data);
                            close_loader();
                            if (data.ok) {
                                show_toast_success(data.message);
                                window.location.reload();
                            }
                        },
                        error: function () {
                            close_loader();
                            show_toast_error(data.message);
                        }
                    })
                }
            })
        }
    }

    let method_active = 1;
    $(document).on('click', '.btn-payment-method', function () {
        const type = parseInt($(this).val());
        method_active = type;
        if (type === 1) {
            $('#div-payment-card').addClass('d-none');
            $('#div-payment-cheque').addClass('d-none');
            $('#div-payment-numeric').removeClass('d-none');
            $('#div-payment-mobile').addClass('d-none');
        } else if (type === 2) {
            $('#div-payment-card').removeClass('d-none');
            $('#div-payment-cheque').addClass('d-none');
            $('#div-payment-numeric').addClass('d-none');
            $('#div-payment-mobile').addClass('d-none');
        } else if (type === 3) {
            $('#div-payment-card').addClass('d-none');
            $('#div-payment-cheque').removeClass('d-none');
            $('#div-payment-numeric').addClass('d-none');
            $('#div-payment-mobile').addClass('d-none');
        } else if (type === 4) {
            $('#div-payment-card').addClass('d-none');
            $('#div-payment-cheque').addClass('d-none');
            $('#div-payment-numeric').addClass('d-none');
            $('#div-payment-mobile').removeClass('d-none');
        }
        $('.btn-payment-method').removeClass('bg-gray-200 text-info');
        $(this).addClass('bg-gray-200 text-info');
        const parent = $(this).data('parent');
        console.log('type: ' + type);

        $('#btn-payment-method-' + parent).addClass('bg-gray-200 text-info')

        $('.icon').removeClass('text-info');
        $('#icon-method-' + type).addClass('text-info')
    });

    //bank service
    $(document).on('click', '.btn-bank-service', function () {
        const varx = $(this).val();
        console.log('bank: ' + varx);
        $('#bank-service').val(varx);
        $('.btn-bank-service').removeClass('bg-gray-200 text-info');
        $(this).addClass('bg-gray-200 text-info');
        const parent = $(this).data('parent');
        $('#btn-payment-method-' + parent).addClass('bg-gray-200 text-info')

        $.ajax({
            type: 'POST',
            data: {id: varx},
            url: baseURL + 'payment/getInputs',
            success: function (data) {
                $('#div-input-bank').html(data)
            }
        })
    });
    //mobile service
    $(document).on('click', '.btn-mobile-service', function () {
        $('#mobile-service').val($(this).val());

        if ($(this).val() == 11) {
            $('#mobile_reference').removeAttr('required');
            $('#div-reference').addClass('d-none');
        } else {
            $('#div-reference').removeClass('d-none');
            $('#mobile_reference').prop('required', true);
        }

        $('.btn-mobile-service').removeClass('bg-gray-200 text-info');
        $(this).addClass('bg-gray-200 text-info');
        const parent = $(this).data('parent');
        $('#btn-payment-method-' + parent).addClass('bg-gray-200 text-info')
    });

    $(document).on('input', '#total-paid', function () {
        const amount = parseFloat($('#amount').val());
        const total_paid = parseFloat($(this).val());
        const change = (total_paid - amount);
        if (change > 0) {
            $('#change').val(change.toFixed(2));
            $('#change_s').text(formatValue(change));
            $('#btn-pay').removeClass('disabled')
        } else {
            $('#change').val(0);
            $('#change_s').text(0);
            $('#btn-pay').addClass('disabled')
        }
        // console.log('change: '+change)
    });

    function getMethod() {
        let methodJSON;
        const amount = $('#amount').val();
        var canSave = true;

        if (method_active === 1) {
            const total_paid = $('#total-paid').val();
            const change = $('#change').val();
            methodJSON = {
                'method_id': 1,
                'amount': amount,
                'total_paid': total_paid ? total_paid : amount,
                'change': change
            }
        }
        // if (method_active === 2) {
        // 	const method_id = parseInt($('#payment-type-card').val());
        // 	methodJSON = {'method_id': method_id, 'amount': amount}
        // }
        //check
        if (method_active === 2) {
            const check_number = $('#check_number');
            // const check_value = $('#check_value')
            const check_bank = $('#check_bank');
            const mobile_holder = $('#check_holder');
            const check_account = $('#check_account');
            const check_nib = $('#check_nib');

            const s = [];
            s.push(checkInput(check_number, 'Insira o numero do check'));
            // s.push(checkInput(check_value, 'Insira o valor do check'))
            s.push(checkInput(check_bank, 'Insira o nome do banco do check'));
            s.push(checkInput(mobile_holder, 'Insira o nome do propretario da conta'));
            s.push(checkInput(check_account, 'Insira o número da conta'));
            s.push(checkInput(check_nib, 'Insira o NIB'));

            if (s.includes(false)) {
                canSave = false;
                show_toast_warning('error')
            }

            const method_id = $('#bank-service').val();
            if (!method_id) {
                canSave = false;
                show_toast_warning('seleciona o tipo de serviço')
            }
            methodJSON = {
                'method_id': method_id,
                'amount': amount,
                'check_number': check_number.val(),
                // 'check_value': check_value.val(),
                'check_bank': check_bank.val(),
                'mobile_holder': mobile_holder.val(),
                'check_account': check_account.val(),
                'check_nib': check_nib.val(),
                'is_bank': true
            }
        }
        // mobile service
        if (method_active === 4) {
            const mobile_number = $('#mobile_number');
            const mobile_reference = $('#mobile_reference')
            const mobile_holder = $('#mobile_holder')

            const s = [];
            s.push(checkInput(mobile_number, 'Insira o numero do telefone'))
            if (mobile_reference.prop('required')) {
                s.push(checkInput(mobile_reference, 'Insira a referencia'))
            }
            s.push(checkInput(mobile_holder, 'Insira o nome do propretario da conta'))

            if (s.includes(false)) {
                canSave = false
            }
            const method_id = $('#mobile-service').val();
            if (!method_id) {
                canSave = false;
                show_toast_warning('seleciona o tipo de serviço')
            }
            methodJSON = {
                'id': 0,
                'method_id': method_id,
                'amount': amount,
                'reference': mobile_reference.val(),
                'mobile_number': mobile_number.val(),
                'holder': mobile_holder.val(),
                'is_mobile': true
            }
        }
        return [canSave, methodJSON];
    }

    $(document).on('change', '#select-payment', function () {
        let total_debt = $('#debt').val();
        let total_debt_tex = $('#debt').data('value');

        if (parseInt($(this).val()) === 1) {
            total_debt = $('#debt_2').val();
            total_debt_tex = $('#debt_2').data('value');
            $('#amount').prop('readonly', true).val(total_debt);
            $('#amount-before').prop('readonly', true).val(total_debt);
            is_debt_2 = 1
        } else {
            is_debt_2 = 0;
            $('#amount').removeAttr('readonly').val('');
            $('#amount-before').removeAttr('readonly').val('')
        }
        $('#total_debt').val(total_debt);
        $('#total_debt_text').text(total_debt_tex);

        console.log(total_debt);
    });

    $(document).on('change', '#check-all-instalment', function () {
        $("input.input-check-instalment:checkbox").prop('checked', $(this).prop("checked"));
        calculate_to_pay();
    });

    $(document).on('change', '.input-check-instalment', function () {
        const index = $(this).data('index');

        for (let i = 0; i < index; i++) {
            $('#check-' + i).prop('checked', true);
        }

        const greater = $('.input-check-instalment').length;
        for (let g = index + 1; g < greater; g++) {
            $('#check-' + g).prop('checked', false);
        }

        if ($('.input-check-instalment:not(:checked)').length === 0) {
            $('#check-all-instalment').prop('checked', true)
        } else {
            $('#check-all-instalment').prop('checked', false)
        }
        calculate_to_pay();
    });

    let instalments = [];

    function calculate_to_pay() {
        const checksChecked = $('.input-check-instalment:checked');
        instalments = [];
        let total_all = 0;
        let total_fine = 0;
        let total_instalment = 0;
        checksChecked.each(function () {
            const id = $(this).attr('data-id');
            const total_debt = parseFloat($('#debt_instalment_fine_' + id).val());
            const total_fine_line = parseFloat($('#debt_fine_' + id).val());
            const total_instalment_line = parseFloat($('#debt_instalment_' + id).val());
            total_all += total_debt;
            total_fine += total_fine_line;
            total_instalment += total_instalment_line
        });
        if(total_all > 0){
            $('#amount-before').val(total_all).trigger('input');
        }else{
            $('#amount-before').val("");
        }
        $('#total_to_pay_fine').text(number_format(total_fine, 2));
        $('#total_to_pay_instalment').text(number_format(total_instalment, 2));
    }

    $(document).on('input', '#amount-before', function () {
        const total_to_pay = parseFloat($(this).val());
        $('#amount').val($(this).val());
        $('#total_to_pay_all').text(number_format($(this).val(), 2));

        const all_checks = $('.input-check-instalment');
        let total_fines = 0;
        // all_checks.each(function () {
        //     const id = $(this).data('id');
        //     const index = $(this).data('index');
        //     const fine_line = parseFloat($('#debt_fine_' + id).val());
        //     const total_debt = parseFloat($('#debt_instalment_fine_' + id).val());
        //
        //     if(total_to_pay){
        //
        //     }
        //
        //     if(fine_line){
        //         if(fine_line <= total_to_pay){
        //             total_fines += fine_line
        //         }else {
        //             total_fines = total_to_pay
        //         }
        //     }
        // });
        $('#total_to_pay_fine').text(total_fines);
        calculateInstalments();
    });

    function calculateInstalments() {
        change = 0;
        later = false;
        installParceledID = 0;
        let value = parseFloat($('#amount-before').val());
        $('.current').each(function () {
            let currentValue = parseFloat($(this).val()).toFixed(2);
            const id = $(this).data('index');

            if (value >= currentValue) {
                $('#check-' + id).prop('checked', true);
                value -= currentValue;
                change = value;
            } else {
                $('#check-' + id).prop('checked', false);
            }
        });
        const i = $('.input-check-instalment:checked').length; //input checked
        $('.change').remove();
        const lineParceled = $('#tr-' + i);
        installParceledID = lineParceled.attr('data-id');

        if (change > 0) {
            // const lineParceled = $('#tr-'+i);
            lineParceled.before('<tr class="change bg-light f-w-700"><td>Parcela</td><td>--------------</td><td>--------------</td>' +
                '<td><span id="parcela" data-value="'+change+'">' + formatValue(change) + '</span></td>' +
                '<td><label class="f-s-21"><i class="fa fa-check-square"></i></label></td></tr>')
        } else if (value) {
            later = true;
            change = value; //i use changeValue when save payments
            lineParceled.before('<tr class="change bg-light f-w-700"><td>Parcela</td><td>--------------</td><td>--------------</td>' +
                '<td><span id="parcela" data-value="'+change+'">' + formatValue(value) + '</span></td>' +
                '<td><label class="f-s-21"><i class="fa fa-check-square"></i></label></td></tr>')
        }
    }
</script>


<?php $this->load->view('layout/footer') ?>
