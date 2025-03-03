$(document).ready(function () {

});

$(document).on('submit', '#form-register', function (e) {
	e.preventDefault();
	$.ajax({
		url: baseURL+"auth/save_sign_up",
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function(){
			show_loader()
		},
		success: function (data) {
			close_loader();
			console.log(data);
			if (data.status.toString() === 'success') {
				show_toast_success(data.message);
				$('#modal-email-text').text($('#owner_email').val());
				$('#modal-email').modal({
					show:true,
					backdrop:'static'
				});
				$('#form-register').trigger('reset')
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			close_loader();
			show_toast_error('error');
			console.log(JSON.stringify(error))
		}
	})
});
