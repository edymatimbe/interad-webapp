
$(document).ready(function () {
	calculateByCheck();
	$(".select-cs").select2({
		"language": {
			"noResults": function () {
				return "Sem resultado encontrado";
			}
		}
	})
});
let target  = '';

$(document).on('change','#select-type-payment',function () {
	target = $(this).val();
	console.log(target);
	$.ajax({
		type: 'POST',
		data: {value:target},
		url: baseURL+'payment/setPaymentType', 
		success: function (data) {
			$.ajax({
				type: 'POST',
				url: baseURL + 'payment/getInvoices',
				beforeSend: function () {
					show_loader()
				},
				success: function (data) {
					$('#div-render').html(data);
					$(".select-cs").select2({
						"language": {
							"noResults": function () {
								return "Sem resultado encontrado";
							}
						}
					});
					updateSelect2NoSearch();
					setInputFilter(document.getElementById('input-value-to'), function (value) {
						return /^\d*\.?\d*$/.test(value);
					});

					close_loader();

				}
			})
		}
	})
});

let customer = 0;
$(document).on('change', '.select-cs', function () {
	const id = $(this).val();
	customer = id;
	$.ajax({
		type: 'POST',
		data: {id: id,target:target},
		url: baseURL + 'payment/getInvoices',
		beforeSend: function () {
			show_loader()
		},
		success: function (data) {
			$('#div-render').html(data);
			$(".select-cs").select2({
				"language": {
					"noResults": function () {
						return "Sem resultado encontrado";
					}
				}
			});

			updateSelect2NoSearch();
			close_loader();

			setInputFilter(document.getElementById('input-value-to'), function (value) {
				return /^\d*\.?\d*$/.test(value);
			});
		}
	})
});
let change = 0;
let installParceledID = 0;
let later = false;

function calculateInstalments() {
	change = 0;
	later = false;
	installParceledID = 0;
	let value = parseFloat($('#input-value-to').val());
	$('.current').each(function () {
		let currentValue = parseFloat($(this).val()).toFixed(2);
		const id = $(this).attr('data-id');

		if (value >= currentValue) {
			$('#check-' + id).prop('checked', true);
			value -= currentValue;
			change = value;
		} else {
			$('#check-' + id).prop('checked', false);
		}
	});
	const i = $('.input-check:checked').length; //input checked
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

function calculateByCheck() {
	$(document).on('change', '#check-all', function () {
		$("input:checkbox").prop('checked', $(this).prop("checked"));
		$('.input-check').trigger('change')
	});

	$(document).on('change', '.input-check', function () {

		let total = 0;
		const checksChecked = $('.input-check:checked');

		checksChecked.each(function () {
			const id = $(this).attr('data-id');
			const value = parseFloat($('#line-value-' + id).val());
			total += value;
		});

		$('.change').remove();
		change = 0;
		later = false;
		installParceledID = 0;

		if (total !== 0) {
			$('#input-value-to').val(total)
		} else {
			$('#input-value-to').val('');
		}

		if (!$(this).prop("checked")) {
			$('#check-all').prop('checked', false)
		}
		if ($('.input-check:not(:checked)').length === 0) {
			$('#check-all').prop('checked', true)
		}
	});
}

function setInputFilter(textbox, inputFilter) {
	["input", "change", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
		textbox.addEventListener(event, function () {
			if (inputFilter(this.value)) {
				if (this.value === '.') {
					this.value = '';
					return false
				}
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
				calculateInstalments()
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
		});
	});
}

function openModal() {
	if (customer === 0) {
		show_toast_warning('Seleciona o cliente !')
		return
	}
	if (!$('#input-value-to').val()) {
		show_toast_warning('Seleciona a(s) factura(s) a pagar!')
		return;
	}
	$('.amount').val($('#input-value-to').val());

	let total_amount = 0;
	$('.input-check:checked').each(function () {
		const id = $(this).attr('data-id');
		const value = parseFloat($('#line-value-' + id).val());
		total_amount += value;
	});


	if($('#parcela').length){
		total_amount+= $('#parcela').data('value');
	}
	$('#amount').val(total_amount);
	$('#total-paid').trigger('input')
	getMethod()[1]['amount']=total_amount;
	$('#modal-payment').modal('show');
}

function saveMultiPayment() {

	let invoices = [];

	invoices = [];

	$('.input-check:checked').each(function () {
		const id = $(this).attr('data-id');
		const value = parseFloat($('#line-value-' + id).val());

		const line = {'id': id, 'value': value, 'part': false};
		invoices.push(line)
	});
	if (change !== 0) {
		const line = {'id': installParceledID, 'value': change, 'part': true};
		invoices.push(line);
	}
	invoices = JSON.stringify(invoices);
	// console.log('data: ' + invoices);

	const data = getMethod()[1];
	const canSave = getMethod()[0];
	data['invoices'] = invoices;
	data['type'] = target;

	if(target.toString() === 'purchase'){
		data['supplier_id'] = $('#select-supplier').val();
	}else {
		data['customer_id'] = $('#select-customer').val();
	}

	if (canSave) {

		Swal.fire({
			title: "",
			text: "Confirmar",
			icon: "question",
			confirmButtonColor: "#00a897",
			confirmButtonText: "<i class='feather icon-save mr-2'></i>Sim",
			cancelButtonText: "<i class='feather icon-x mr-2'></i>Cancelar",
			cancelButtonClass: 'bg-dark',
			showCancelButton: true,
		}).then(function (rs) {
			if (rs.isConfirmed) {
				$.ajax({
					type: 'POST',
					data: data,
					url: baseURL + 'payment/save',
					beforeSend: function () {
						show_loader()
					},
					success: function (data) {
						close_loader();
						if (data.ok) {
							show_toast_success(data.message);
							if(target.toString() === 'purchase'){
								$('#select-supplier').val($('#select-supplier').val()).trigger('change');
							}else{
								$('#select-customer').val($('#select-customer').val()).trigger('change');
							}
							$('#modal-payment').modal('toggle');

							get_payment_receipt(data.id,'print')
						}
					},
					error:function () {
						close_loader();
						show_toast_error(data.message);
					}
				})
			}
		})
	}
}

