$(document).ready(function () {
	initDataTable('table-supplier')
});

function getAllData() {
	$.ajax({
		url: 'supplier/getAll',
		type: 'GET',
		success: function (data) {
			reDrawTable(data)
		},
	});
}

//begin new supplier
function add_supplier() {
	$.ajax({
		url: 'supplier/create',
		type: 'GET',
		success: function (data) {
			$('#modal-md-content').html(data);
			$('.type_id:first').trigger('change');
			$('#modal-md').modal('show')
		},
	});
}

$(document).on('submit', '#form-supplier', function (e) {
	e.preventDefault();
	$.ajax({
		url: "supplier/save",
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
				show_toast_success(data.message)
				getAllData();
				$('#modal-md').modal('toggle')
			}
			if (data.status.toString() === 'error') {
				show_toast_error(data.message)
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			show_toast_error('Erro ao salvar fornecedor')
		}
	})
});

$(document).on('change', '.type_id', function () {
	const value = $(this).val().toString();
	hideDiv(value)
});

// function hideDiv(value) {
// 	if (value === 'empresa') {
// 		$('#div-responsible').removeClass('d-none').find('input').prop('required', true)
// 		$('#div-group').removeClass('d-none')
// 	} else {
// 		$('#div-group').addClass('d-none').find('select').val('').trigger('change')
// 		$('#div-responsible').addClass('d-none').find('input').val('').prop('required', false)
// 	}
// }

function edit_supplier(id) {
	$.ajax({
		url: 'supplier/edit',
		type: 'GET',
		data: {'id': id},
		success: function (data) {
			$('#modal-md-content').html(data);
			const value = $('input[name=type]:checked').val().toString();
			hideDiv(value);
			$('#modal-md').modal('show')
		},
	});
}
//end new supplier

function show_supplier(id) {
	$.ajax({
		url: 'supplier/show',
		type: 'GET',
		data: {'id': id},
		success: function (data) {
			$('#modal-md-content').html(data);
			$('#modal-md').modal('show')
		},
		error: function (data) {
			console.log('error: ' + data)
		}
	});
}
