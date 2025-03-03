let modalOpen = 0;

function add_category() {
	$.ajax({
		url: 'category/create',
		type: 'GET',
		success: function (data) {
			$('#modal-sm-content').html(data);
			$('#modal-sm').modal('show');
			$('#parent_id').select2({
				"language": {
					"noResults": function () {
						return "Sem resultado encontrado";
					}
				}
			});
			if (modalOpen === 0) {
				cropImage(
					'image_category',
					'file_image_category',
					'image_data_category',
					'modal-image-category',
					'div-cropper-category'
				);
				modalOpen = 1
			}
		},
	});
}

function getAllData() {
	$.ajax({
		url: 'category/getAll',
		type: 'GET',
		success: function (data) {
			reDrawTable(data);
		},
	});
}

function show_category(id) {
	$.ajax({
		url: 'category/show',
		type: 'POST',
		data: {'id': id},
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			$('#modal-sm-content').html(data);
			initDataTable('table-category-products', false, 5)
			$('#modal-sm').modal('show')
		}
	});
}

function delete_category(id) {
	$.ajax({
		url: 'category/delete',
		type: 'POST',
		dataType: "JSON",
		data: {'id': id},
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			if (data.ok) {
				getAllData();
			}
			console.log(data)
		}
	});
}

function edit_category(id) {
	$.ajax({
		url: 'category/edit',
		type: 'POST',
		data: {'id': id},
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			$('#modal-sm-content').html(data);
			$('#modal-sm').modal('show');
			$('#parent_id').select2();
			if (modalOpen === 0) {
				cropImage(
					'image_category',
					'file_image_category',
					'image_data_category',
					'modal-image-category',
					'div-cropper-category'
				)
				modalOpen = 1
			}
		}
	});
}

$(document).on('submit', '#form-category', function (e) {
	e.preventDefault();
	$.ajax({
		url: "category/save",
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		success: function (data) {
			if (data.status.toString() === 'success') {
				show_toast_success(data.message);
				$('#form-category').trigger('reset');
				getAllData();
				$('#modal-sm').modal('toggle')
			}
			if (data.status.toString() === 'error') {
				show_toast_error(data.message);
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			show_toast_error('Error when try save category');
		}
	})
});
