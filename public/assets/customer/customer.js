$(document).ready(function () {
	initDataTable('table-customer')
});

function getAllData() {
	$.ajax({
		url: 'customer/getAll',
		type: 'GET',
		success: function (data) {
			reDrawTable(data)
		},
	});
}
let modalOpen = 0;

//begin new customer
function add_customer() {
	$.ajax({
		url: 'customer/create',
		type: 'GET',
		success: function (data) {
			$('#modal-sm-2-content').html(data);
			$('.type_id:first').trigger('change');
			$('#modal-sm-2').modal('show');

			if (modalOpen === 0) {
				cropImage(
					'image_customer',
					'file_image_customer',
					'image_data_customer',
					'modal-image',
					'div-cropper'
				);
				modalOpen = 1
			}
		},
	});
}

$(document).on('submit', '#form-customer', function (e) {
	e.preventDefault();
	$.ajax({
		url: "customer/save",
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
				show_toast_success(data.message);
				getAllData();
				$('#modal-sm-2').modal('toggle')
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

// $(document).on('change', '.type_id', function () {
// 	const value = $(this).val().toString();
// 	hideDiv(value)
// })
//
// function hideDiv(value) {
// 	if (value === 'empresa') {
// 		$('#div-responsible').removeClass('d-none').find('input').prop('required', true)
// 		$('#div-group').removeClass('d-none')
// 	} else {
// 		$('#div-group').addClass('d-none').find('select').val('').trigger('change')
// 		$('#div-responsible').addClass('d-none').find('input').val('').prop('required', false)
// 	}
// }

function edit_customer(id) {
	$.ajax({
		url: 'customer/edit',
		type: 'GET',
		data: {'id': id},
		success: function (data) {
			$('#modal-sm-2-content').html(data);
			const value = $('input[name=type]:checked').val();
			console.log('value:'+ value);
			hideDiv(value,1);
			$('#modal-sm-2').modal('show')

			if (modalOpen === 0) {
				cropImage(
					'image_customer',
					'file_image_customer',
					'image_data_customer',
					'modal-image',
					'div-cropper'
				);
				modalOpen = 1
			}
		},
	});
}

//end new customer

function show_customer(id) {
	$.ajax({
		url: 'customer/show',
		type: 'GET',
		data: {'id': id},
		success: function (data) {
			$('#modal-sm-2-content').html(data);
			$('#modal-sm-2').modal('show');
			updateSelect2NoSearch();
			$("#select-sale").select2({
				$dropdownParent: $(this).parent(),
				"language": {
					"noResults": function () {
						return "Sem resultado encontrado";
					}
				}
			}).on('select2:select', function (e) {
				// filter()
			});
		},
		error: function (data) {
			console.log('error: ' + data)
		}
	});
}
