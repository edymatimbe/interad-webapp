$(document).ready(function () {

	// $('#sidebarToggle').trigger('click');
	// $('#menu-sale').find('a:first,i').addClass('text-white');

	$("#select-customer").select2({
		"language": {
			"noResults": function () {
				return "Sem resultado encontrado";
			}
		}
	}).on('select2:select', function (e) {
		setCustomer(e.params.data.id, false)
	});
	// initDataTable('table-items');

	$('#ul-summary').find('#btn-open-modal-payment').remove();

	discount();
	note();
	inputSpinneR();
	// printReceipt();
	setFullHeight('#div-item-to-sale',-200)
	setFullHeight('#list-selected-items',15)
});

function deniedSale() {
	setCustomer(null,false)
	$('#select-customer').val('').trigger('change')
}

function setCustomer(id, isNew) {
	var type_sale = $('#select-sale-type-new').val();
	$.ajax({
		type: 'GET',
		data: { id: id},
		url: baseURL+'sale/setCustomer',
		success: function (data) {
			if (data.ok) {
				console.log(data.message);
			}
			if (isNew) {
				$('#select-customer').html(data.select)
			}
			if(type_sale.toString() === 'invoice'){
				if(data.debit_expired > 0  || data.debit_pendent > 0){
					$('#modal-debit .modal-content').html(data.modal_debit)
					$('#modal-debit').modal({
						show:true,
						backdrop:'static'
					})
				}
			}
			if(parseInt(data.is_service) === 0){
				update_cart(data.message, data.ok)
			}else{
				update_cart_service();
			}
		}
	})
}

function inputSpinneR() {
	$('.input-spinner').inputSpinner();
	$('.btn-minus').css('min-width', '1.5rem');
	$('.btn-plus').css('min-width', '1.5rem');
}

function setDiscount_popover() {
	$('#btn-discount').popover({
		title: '<span>&nbsp;</span> <span class="text-danger btn btn-xs btn-default border shadow-sm float-right cursor-pointer btn-close-popover" style="margin-top: -5pt">x</span>',
		container: 'body',
		html: true,
		placement: 'top',
		sanitize: false,
		content: function () {
			return $('#div-popover-discount').html()
		},
	});
}

function discount() {

	setDiscount_popover();

	$(document).on('click', '#btn-set-discount', function () {
		const value = $('.popover-body #discount-value').val();
		const percent = $('.popover-body #discount-percent').val();
		setDiscount(1, value,percent);
		$('.li-discount').popover('hide');
	});

	$(document).on('input','#discount-percent',function () {
		const value = $(this).val();
		const subtotal = $('#subtotal_cart').val();
		let discount_value = 0;
		if(value > 0 && value < 100){
			discount_value = subtotal * value / 100
		}
		$('.popover-body #discount-value').val(discount_value.toFixed(2));
	});

	$(document).on('input','#discount-value',function () {
		const value = $(this).val();
		const subtotal = $('#subtotal_cart').val();
		let discount_percent = 0;
		if(value > 0 && value < 100){
			discount_percent = (value * 100) / subtotal
		}
		$('.popover-body #discount-percent').val(discount_percent.toFixed(2));
	});

	function setDiscount(type, value, percent) {
		$.ajax({
			type: 'POST',
			url: 'sale/setDiscount',
			dataType: "JSON",
			data: {'type': type, 'value': value, percent:percent},
			success: function (data) {
				$('#btn-discount').popover('hide');
				$('#btn-note').popover('hide');
				update_cart(data.message, data.ok)
				console.log(data);
			}
		});
	}
}

$('#select-sale-type-new').on('change',function () {
	const value = $(this).val();
	const is_service = $(this).data('service');
	$.ajax({
		type: 'POST',
		url: 'sale/setSourceAJAX',
		dataType: "JSON",
		data: {'value': value,is_service:is_service},
		success: function (data) {
			if(is_service){
				update_cart_service()
			}else{
				update_cart();
			}
		}
	});
});

$(document).on('click', '.btn-close-popover', function () {
	$('#btn-discount').popover('hide');
	$('#btn-note').popover('hide');
});

$(document).on('click', '#btn-discount', function () {
	$('#btn-note').popover('hide');
})

$(document).on('click', '#btn-note', function () {
	$('#btn-discount').popover('hide');
})

function setNote_popover() {
	$('#btn-note').popover({
		title: '<span>&nbsp;</span> <span class="text-danger btn btn-xs btn-default border shadow-sm float-right cursor-pointer btn-close-popover" style="margin-top: -5pt">x</span>',
		container: 'body',
		html: true,
		placement: 'top',
		sanitize: false,
		content: function () {
			return $('#div-popover-note').html()
		},
	});
}

function note() {
	setNote_popover();

	$(document).on('click', '#btn-set-note', function () {
		const value = $('.popover-body #note').val();
		setNote(value);
		$('#btn-note').popover('hide');
	});

	function setNote(value) {
		$.ajax({
			type: 'POST',
			url: 'sale/setNote',
			dataType: "JSON",
			data: {'value': value},
			success: function (data) {
				$('#btn-discount').popover('hide');
				$('#btn-note').popover('hide');
				update_cart(data.message, data.ok)
			}
		});
	}
}

$(document).on('change', '.input-spinner', function () {
	const value = parseInt($(this).val());
	const last = parseInt($(this).data('last'));
	const id = parseInt($(this).data('id'));
	const rowID = $(this).data('rowid');

	console.log('value: ' + value);
	if (value !== last) {
		add_item(id, value, rowID);
	}
});


function add_item(id, quantity, rowID) {
	console.log(id + ' ' + quantity + ' ' + rowID);
	$.ajax({
		type: 'POST',
		data: {'id': id, 'quantity': quantity, 'rowId': rowID},
		// url: 'addItem',
		url: baseURL+'sale/addItem',
		dataType: "JSON",
		success: function (data) {
			update_cart(data.message, data.ok);
		}
	});
}
function add_item_byBTN(id) {
	const exist = $('#plus-'+id);
	if(exist.length){
		add_item(id,parseInt(exist.val())+1,exist.data('rowid'))
	}else{
		add_item(id,1,null)
	}
}

function removeItem(id) {
	$.ajax({
		type: 'POST',
		data: {'id': id},
		dataType: "JSON",
		url: baseURL+'sale/removeItem',
		success: function (data) {
			update_cart(data.message, data.ok);
		}
	});
}

function update_cart(message = null, status = null) {
	$('.li-discount').popover('hide');

	$.ajax({
		type: 'GET',
		// url: 'updateCart',
		url: baseURL+'sale/updateCart',
		success: function (data) {
			$('#cart').html(data.cart);
			$('#modal-body-payment').html(data.payment);
			$('#div-popover-discount').html(data.discount_popover);
			$('#div-popover-note').html(data.note_popover);
			setDiscount_popover();
			setNote_popover();
			inputSpinneR();
			setFullHeight('#list-selected-items',15)

			if (message) {
				if (status) {
					// show_toast_success(message);
				} else {
					// show_toast_warning(message);
				}
			}
		}
	});
}

const wrapper_height = document.getElementById('wrapper').getBoundingClientRect().height;
$(document).on('click', '#btn-open-modal-payment', function () {
	if (!$(this).hasClass('disabled')) {
		$('.li-discount').popover('hide');
		$('#modal-payment').modal('show');
		console.log('done');
		// setFullHeight('#items-summary')
		setFullHeight('#items-summary',75);
		setFullHeight('#card-payment',75)

		// $('.card-payment').css('height', wrapper_height - 250 + 'px');
	}
});

$(document).on('click', '#btn-pay', function () {
	if (!$(this).hasClass('disabled')) {
		saveSale();
	}
});

$(document).on('click', '#btn-print', function () {
	if (!$(this).hasClass('disabled')) {
		printReceipt();
	}
});

function printReceipt() {
	printJS({
		printable: 'frame',
		type: 'html',
		header: $('#receipt').html(),
		style: '#titlee{color:green};',
		font: "TwCenMT",
		// font_size: "40pt",
	});
	update_cart();
}

//begin new customer
function add_customer() {
	$.ajax({
		url: baseURL + 'customer/create',
		type: 'GET',
		success: function (data) {
			$('#modal-md-content').html(data);
			$('.type_id:first').trigger('change')
			$('#modal-md').modal('show')
		},
	});
}

$(document).on('submit', '#form-customer', function (e) {
	e.preventDefault();
	$.ajax({
		url: baseURL + 'customer/save',
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			// $("#loader").show();
		},
		success: function (data) {
			if (data.status.toString() === 'success') {
				$('#modal-md').modal('toggle')
				show_toast_success(data.message)
				setCustomer(data.last_id, true)
			}

			if (data.status.toString() === 'error') {
				show_toast_error(data.message)
			}

			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			show_toast_error('ocorreu algum erro ao tentar salvar cliente')
		}
	})
});

function showItem(id) {
	$.ajax({
		type: 'POST',
		data: {'id': id},
		url: baseURL+'sale/showItem',
		success: function (data) {
			$('#cart-item-info').html(data);
			$('#carousel-sale').carousel(1)
		}
	});
}


