function add_brand() {
	$.ajax({
		url: 'brand/create',
		type: 'GET',
		success: function (data) {
			$('#modal-sm-content').html(data);
			$('#modal-sm').modal('show');
		},
	});
}

function getAllData() {
	$.ajax({
		url: 'brand/getAll',
		type: 'GET',
		success: function (data) {
			reDrawTable(data);
		},
	});
}
function show_brand(id) {
	$.ajax({
		url: 'brand/show',
		type: 'POST',
		data: {'id': id},
		beforeSend:function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			$('#modal-sm-content').html(data);
			initDataTable('table-brand-products',false,5)
			$('#modal-sm').modal('show')
		}
	});
}

function edit_brand(id) {
	$.ajax({
		url: 'brand/edit',
		type: 'POST',
		data: {'id': id},
		beforeSend:function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			$('#modal-sm-content').html(data);
			$('#modal-sm').modal('show');
		}
	});
}


$(document).on('submit', '#form-brand', function (e) {
	e.preventDefault();
	$.ajax({
		url: "brand/save",
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		success: function (data) {
			// $("#loader").hide();
			if (data.status.toString() === 'success') {
				show_toast_success(data.message);
				getAllData();
				$('#modal-sm').modal('toggle')
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			show_toast_error('Error when try save brand')
			console.log(JSON.stringify(error))
		}
	})
});


$(function () {
	initDataTable('table-brand')
});
