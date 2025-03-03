$(document).ready(function () {
	// initDataTable('table-product');

	$(".select-filter").select2({
		"language": {
			"noResults": function () {
				return "Sem resultado encontrado";
			}
		}
	}).on('select2:select', function (e) {
		filter()
	});
});


let modalOpen = 0;

function successProduct(data) {
	close_loader();
	$('#modal-sm-content').html(data);
	$('#description').summernote({
		height: 170,
		tabSize: 0,
		toolbar: [
			['style', ['bold', 'italic']],
			['fontsize', ['fontsize']],
			['height', ['height']],
			['color', ['color']],
			['para', ['ul', 'paragraph']]
		],
	});
	$('.note-editor.note-frame').css('border', 'none').addClass('border');
	$('.select').select2({
		"language": {
			"noResults": function () {
				return "Sem resultado encontrado";
			}
		}
	});
	if (modalOpen === 0) {
		cropImage(
			'image_product',
			'file_image_product',
			'image_data_product',
			'modal-image-product',
			'div-cropper-product'
		);
		modalOpen = 1
	}

	$('#modal-sm').modal('show');
}

function add_product(is_service) {
	$.ajax({
		url: 'product/create',
		data:{is_service:is_service},
		type: 'GET',
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			successProduct(data)
			// console.log(data);
		}, error: function () {
			close_loader();
			show_toast_error('error')
		}
	});
}

function edit_product(id) {
	$.ajax({
		url: 'product/edit',
		type: 'GET',
		data: {'id': id},
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			// $('#modal-sm').modal('hide');
			successProduct(data)
		}, error: function () {
			close_loader();
			show_toast_error('error')
		}
	});
}

function show_product(id) {
	$.ajax({
		url: 'product/show',
		type: 'GET',
		data: {'id': id},
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			$('#modal-sm-content').html(data);
			$('#modal-sm').modal('show')
		}, error: function () {
			close_loader()
			show_toast_error('error')
		}
	});
}

$(document).on('submit', '#form-product', function (e) {
	e.preventDefault();
	$.ajax({
		url: "product/save",
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			$("#loader").show();
		},
		success: function (data) {
			close_loader();
			if (data.status.toString() === 'success') {
				show_toast_success(data.message);
				$('#form-product').trigger('reset');
				get_data()
				$('#modal-sm').modal('toggle')
			}
			if (data.status.toString() === 'error') {
				show_toast_error(data.message)
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			//$("#loader").hide();
			console.log(status);
			Swal.fire({
				title: "",
				text: 'Error when try save product',

				icon: "error",
				timer: 6000
			});
			console.log(JSON.stringify(error))
		}
	})
});
//
let object, target_object, is_service = 0;
$(document).on('click', '.btn-new', function () {
	object = $(this).data('object');
	target_object = $(this).data('target');
	if($(this).data('service')){
		is_service = 1;
	}
	var name = $(this).data('name');
	$('#modal-new-title').html('<i class="fa fa-pencil-alt">&nbsp;</i>' + name);
	$('#modal-new').modal('show');
});

$(document).on('click', '.btn-close-new', function () {
	$('#modal-new').modal('toggle');
});

$(document).on('click', '#btn-save-new', function () {
	const name = $('#new_name').val();
	if (name) {
		$.ajax({
			type: 'POST',
			url: 'product/saveNew',
			dataType: "JSON",
			data: {'object': object, 'name': name, is_service:is_service},
			success: function (data) {
				console.log(data);
				if (data.status.toString() === 'success') {
					$('#' + target_object).html(data.select);
					$('#modal-new').modal('toggle');
					$('#new_name').val('');
					show_toast_success(data.message)
				}
			}
		})
	} else {
		alert('insert name')
	}
});

  
function submitThisForm() {
	// const who_submit = $('#tab-pane-product').contains()
	if ($('#tab-pane-product').hasClass('active show')) {
		$('#btn-hidden-s-product').trigger('click');
	} else {
		$('#btn-hidden-s-supplier').trigger('click');
	}
}


let firstDate = moment().subtract(5, 'year').format('YYYY-MM-DD');
let lastDate = moment().format('YYYY-MM-DD');

$(function () {
	$('#select-date').daterangepicker({
		ranges: {
			'Todos': [moment().subtract(5, 'year'), moment()],
			'Hoje': [moment(), moment()],
			'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Últimos 7 Dias ': [moment().subtract(6, 'days'), moment()],
			'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
			'Este Mês': [moment().startOf('month'), moment().endOf('month')],
			'Mês Passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		showDropdowns: true,
		startDate: moment().subtract(5, 'year'),
		endDate: moment(),
		locale: {
			applyLabel: "Aplicar",
			cancelLabel: 'Cancelar',
			startLabel: 'Date initiale',
			endLabel: 'Date limite',
			customRangeLabel: 'Customizar',
			daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
			monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
			firstDay: 1
		}
	}, function (start, end, label) {

		firstDate = start.format('YYYY-MM-DD');
		lastDate = end.format('YYYY-MM-DD');
		// $('#select-date span').html(start.format('D.MMM.YYYY') + ' - ' + end.format('D.MMM.YYYY'))
		$('#select-date span').html(label);
		filter()
	});
});


