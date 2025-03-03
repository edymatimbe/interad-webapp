let modalOpen = 0;

function o() {
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
}

function edit_company(id) {
	$.ajax({
		url: 'company/edit',
		type: 'POST',
		data: {'id': id},
		beforeSend:function () {
			show_loader();
		},
		success: function (data) {
			close_loader()
			$('#modal-sm-2-content').html(data);
			$('#modal-sm-2').modal('show');
			// cropImage(
			// 	'image_company',
			// 	'file_image_company',
			// 	'image_data_company',
			// 	'modal-image-company',
			// 	'div-cropper-company'
			// )
		}
	});
}

$(document).on('submit', '#form-company', function (e) {
	e.preventDefault();
	$.ajax({
		url: "company/save",
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		success: function (data) {
			$("#loader").hide();
			if (data.status.toString() === 'success') {
				Swal.fire({
					title: "",
					text: data.message,
					icon: "success",
					timer: 3000
				}).then(function () {
					$('#form-company').trigger('reset');
					$('#company-content').html(data.profile)
					$('#modal-sm-2').modal('toggle')
				});
			}
			if (data.status.toString() === 'error') {
				alert(data.message)
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			Swal.fire({
				title: "",
				text: 'Error when try save company',

				icon: "error",
				timer: 6000
			});
			console.log(JSON.stringify(error))
		}
	})
});

$(function () {
});
