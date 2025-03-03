$(document).ready(function () {
	initDataTable('table-group')
});
// let table = 'customer';
let table = $('#table').val();
function add_group(target) {
	$.ajax({
		url: 'group/create',
		type: 'GET',
		success: function (data) {
			$('#modal-sm-content').html(data);
			$('#modal-sm').modal('show');
		},
	});
	table = target;
}

function getAllData() {
	$.ajax({
		url: 'group/getAll',
		type: 'POST',
		data:{'table':table},
		success: function (data) {
			console.log(table)
			reDrawTable(data);
		}
	});
}

function show_group(id,table) {
	$.ajax({
		url: 'group/show',
		type: 'POST',
		data: {'id': id,'table':table},
		beforeSend:function () {
			show_loader();
		},
		success: function (data) {
			close_loader();
			$('#modal-sm-content').html(data);
			initDataTable('table-sm',false,5)
			$('#modal-sm').modal('show')
		}
	});
}

function edit_group(id,table) {
	$.ajax({
		url: 'group/edit',
		type: 'POST',
		data: {'id': id,'table':table},
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

$(document).on('submit', '#form-group', function (e) {
	e.preventDefault();
	const data = new FormData(this);
	data.append('table',table);
	console.log('table '+table);
	$.ajax({
		url: "group/save",
		type: 'POST',
		dataType: "JSON",
		data:data,
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
			show_toast_error('ocorreu algum arro ao tentar salvar grupo');
			console.log(JSON.stringify(error))
		}
	})
});
