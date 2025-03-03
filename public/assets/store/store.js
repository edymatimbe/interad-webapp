let modalOpen = 0
function add_store() {
	$.ajax({
		url: 'store/create',
		type: 'GET',
		success: function (data) {
			$('#modal-sm-2-content').html(data);
			$('#modal-sm-2').modal('show');

			if (modalOpen === 0) {
				cropImage(
					'image_store',
					'file_image_store',
					'image_data_store',
					'modal-image-store',
					'div-cropper-store'
				)
				modalOpen = 1
			}
		},
	});
}

function show_store(id) {
	$.ajax({
		url: 'store/show',
		type: 'POST',
		data: {'id': id},
		beforeSend:function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			$('#modal-sm-2-content').html(data);
			initDataTable('table-store-products',false,5)
			$('#modal-sm-2').modal('show')
		}
	});
}

function edit_store(id) {
	$.ajax({
		url: 'store/edit',
		type: 'POST',
		data: {'id': id},
		beforeSend:function () {
			show_loader();
		},
		success: function (data) {
			close_loader()
			$('#modal-sm-2-content').html(data);
			$('#modal-sm-2').modal('show');
			cropImage(
				'image_store',
				'file_image_store',
				'image_data_store',
				'modal-image-store',
				'div-cropper-store'
			)
		}
	});
}

function getAllData() {
	$.ajax({
		url: 'store/getAll',
		type: 'GET',
		success: function (data) {
			console.log(data)
			reDrawTable(data);
		},
	});
}
$(document).on('submit', '#form-store', function (e) {
	e.preventDefault();
	$.ajax({
		url: "store/save",
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		success: function (data) {
			// $("#loader").hide();
			if (data.status.toString() === 'success') {
				Swal.fire({
					title: "",
					text: data.message,
					icon: "success",
					timer: 3000
				}).then(function () {
					$('#form-store').trigger('reset');
					getAllData();
					$('#modal-sm-2').modal('toggle')
				});
			}
			if (data.status.toString() === 'error') {
				alert(data.message)
			}
			if (data.status.toString() === 'error_validation') {
				$('.text-error').remove();
				$.each(data.error, function (key, value) {
					const query = 'input[name=' + key + ']';
					const parent = $(query).parent();
					const input = $(query);
					parent.after('<small id="error-' + key + '" class="form-text text-danger text-error mb-0 mb-lg-0">' + value + '</small>')
					input.on('input', function () {
						$('#error-' + key).remove();
					})
				});
			}
		},
		error: function (xhr, status, error) {
			Swal.fire({
				title: "",
				text: 'Error when try save store',

				icon: "error",
				timer: 6000
			});
			console.log(JSON.stringify(error))
		}
	})
});

$(function () {
	initDataTable('table-store')
});
