
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
$(document).on('click','.btn-bank-service',function () {
	const varx = $(this).val();
	console.log('bank: '+varx);
	$('#bank-service').val(varx);
	$('.btn-bank-service').removeClass('bg-gray-200 text-info');
	$(this).addClass('bg-gray-200 text-info');
	const parent = $(this).data('parent');
	$('#btn-payment-method-' + parent).addClass('bg-gray-200 text-info')

	$.ajax({
		type: 'POST',
		data: {id: varx},
		url: baseURL+'payment/getInputs',
		success: function (data) {
			$('#div-input-bank').html(data)
		}
	})
});
//mobile service
$(document).on('click','.btn-mobile-service',function () {
	$('#mobile-service').val($(this).val());
	$('.btn-mobile-service').removeClass('bg-gray-200 text-info');
	$(this).addClass('bg-gray-200 text-info');
	const parent = $(this).data('parent');
	$('#btn-payment-method-' + parent).addClass('bg-gray-200 text-info')
});

$(document).on('input', '#total-paid', function () {
	const amount = parseFloat($('#amount').val());
	const total_paid = parseFloat($(this).val());
	const change = (total_paid - amount).toFixed(2);
	if (change > 0) {
		$('#change').val(change);
		$('#change_s').text(change);
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

	console.log('method_active: '+method_active);
	if (method_active === 1) {
		const total_paid = $('#total-paid').val();
		const change = $('#change').val();
		methodJSON = {'method_id': 1, 'amount': amount, 'total_paid': total_paid, 'change': change}
	}
	// if (method_active === 2) {
	// 	const method_id = parseInt($('#payment-type-card').val());
	// 	methodJSON = {'method_id': method_id, 'amount': amount}
	// }
	//check
	if (method_active === 2) {
		const method_id = $('#bank-service').val();

		if(!method_id){
			canSave = false;
			show_toast_warning('seleciona o tipo de serviço')
		}

		if(parseInt(method_id) === 3 || parseInt(method_id) === 12){
			const check_number = $('#check_number');
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

			if(s.includes(false)){
				canSave = false
				show_toast_warning('error')
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
				'is_bank':true
			}
		}else{
			const pos_bank = $('#pos_bank');
			const pos_reference = $('#pos_reference');

			const s = [];
			s.push(checkInput(pos_bank, 'Insira o nome do banco'));
			s.push(checkInput(pos_reference, 'Insira a referencia'));

			if(s.includes(false)){
				canSave = false;
				show_toast_warning('preenche campos obrigatrios')
			}

			methodJSON = {
				'method_id': method_id,
				'amount': amount,
				'pos_bank': pos_bank.val(),
				'pos_reference': pos_reference.val(),
				'is_bank':true
			}
		}
	}
	// mobile service
	if (method_active === 4) {
		const mobile_number = $('#mobile_number');
		const mobile_reference = $('#mobile_reference')
		const mobile_holder = $('#mobile_holder')

		const s = [];
		s.push(checkInput(mobile_number, 'Insira o numero do telefone'))
		s.push(checkInput(mobile_reference, 'Insira a referencia'))
		s.push(checkInput(mobile_holder, 'Insira o nome do propretario da conta'))

		if(s.includes(false)){
			canSave = false
		}
		const method_id = $('#mobile-service').val();
		if(!method_id){
			canSave = false
			show_toast_warning('seleciona o tipo de serviço')
		}
		methodJSON = {
			'id':0,
			'method_id': method_id,
			'amount': amount,
			'reference':mobile_reference.val(),
			'mobile_number':mobile_number.val(),
			'holder':mobile_holder.val(),
			'is_mobile':true
		}
	}
	return [canSave, methodJSON];
}
