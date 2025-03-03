$(document).ready(function () {
	initDataTable('table-user')
});
let from = '';
function edit_user(id,source) {
	$('#modal-sm-2').modal('hide');

	$.ajax({
		url: 'user/edit',
		type: 'POST',
		data: {'id': id,'from':source},
		success: function (data) {
			$('#modal-sm-content').html(data);
			$('#modal-sm').modal('show')
		},
	});
	from = source;
}

$(document).on('submit', '#form-user', function (e) {
	e.preventDefault();
	const data =  new FormData(this)
	console.log(data)
	data.append('from',from); // when update
	$.ajax({
		url: "user/save",
		type: 'POST',
		dataType: "JSON",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function (data) {
			if (data.status.toString() === 'success') {
				$('#modal-sm').modal('toggle');
				show_toast_success(data.message);
				if(from){ //if update
					if(from === 'index'){
						$('#link-users').trigger('click'); // if update form index
					}else{ //when update profile
						$('#div-profile-content').html(data.profile)
					}
				}else{
					$('#link-users').trigger('click'); // if update form index
				}
			}
			if (data.status.toString() === 'error') {
				show_toast_warning(data.message)
				
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			show_toast_warning('error')
			console.log('error')
		}
	})
});

