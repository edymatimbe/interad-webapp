$(function() {
    initDataTable('table-bank_account')
});

function getAllData()
{
	$.ajax({
		url: 'account_bank/getAll',
		type: 'GET',
		success: function(data) {
			reDrawTable(data);
		},
	});
}
$(document).on('submit', '#form-bank_account', function(e) {
    e.preventDefault();
    $.ajax({
        url: "account_bank/save",
        type: 'POST',
        dataType: "JSON",
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if (data.status.toString() === 'success') {

                show_toast_success(data.message)
                $('#form-bank').trigger('reset');
                $('#modal-sm-2').modal('toggle')
                getAllData()
            }
            if (data.status.toString() === 'error') {
                alert(data.message)
            }
            if (data.status.toString() === 'error_validation') {
                setErrorValidation(data)
            }
        },
        error: function(xhr, status, error) {
            show_toast_error('Error when try save bank account')
            console.log(JSON.stringify(error))
        }
    })
});
function add_bank() {
	$.ajax({
		url: 'account_bank/create',
		type: 'GET',
		success: function (data) {
			$('#modal-sm-2-content').html(data);
			$('#modal-sm-2').modal('show');
		},
	});
}

function show_bank(id) {
	$.ajax({
		url: 'account_bank/show',
		type: 'POST',
		data: {'id': id},
		beforeSend:function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			$('#modal-sm-2-content').html(data);
			initDataTable('table-bank-products',false,5)
			$('#modal-sm-2').modal('show')
		}
	});
}

function edit_bank(id) {
	$.ajax({
		url: 'account_bank/edit',
		type: 'POST',
		data: {'id': id},
		beforeSend:function () {
			show_loader();
		},
		success: function (data) {
			close_loader()
			$('#modal-sm-2-content').html(data);
			$('#modal-sm-2').modal('show');
			//
			// cropImage(
			// 	'image_bank',
			// 	'file_image_bank',
			// 	'image_data_bank',
			// 	'modal-image-bank',
			// 	'div-cropper-bank'
			// )
		}
	});
}





