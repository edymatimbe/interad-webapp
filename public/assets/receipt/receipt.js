initDataTable('table-history');
function getDelivery() {
	$.ajax({
		url: baseURL + 'delivery_note/getAll',
		type: 'GET',
		beforeSend: function() {
			show_loader();
		},
		success: function(data) {
			reDrawTable(data)
			close_loader();
		},
	});
}
$(document).on('submit', '#form-delivery', function(e) {
	e.preventDefault();
	// console.log('submited')
	$.ajax({
		url: baseURL + 'delivery_note/save',
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function() {
			show_loader();
		},
		success: function(data) {
			console.log(data)
			$("#loader").hide();
			if (data.status.toString() === 'success') {
				show_toast_success(data.message)
				$('#modal-sale').modal('toggle')
			}
			if (data.status.toString() === 'error') {
				alert(data.message)
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
			close_loader();
			// console.log(data);
		},
		error: function(xhr, status, error) {
			close_loader();
			console.log(JSON.stringify(error))
		}
	})
});

function show_receipt(id) {
	$.ajax({
		url: baseURL+'receipt/show',
		type: 'GET',
		data: { 'id': id },
		// dataType: "JSON",
		success: function(data) {
			// console.log(data)
			$('#modal-sale-content').html(data);
			$('#modal-sale').modal('show');
			const wrapper_height = document.getElementById('wrapper').getBoundingClientRect().height;
			$('.card-payment').css('height', wrapper_height - 50 + 'px');
		},
		error: function(data) {
			console.log('error: ' + data)
		}
	});
}
// function all_sale() {
//     alert("bbbbbbbbbbbbbbbbbb");
//     // var id = $('.sale').val();
//     // $.ajax({
//     //     url: 'delivery_note/all_sale',
//     //     type: 'GET',
//     //     dataType: 'JSON',
//     //     data: { 'id': id },
//     //     beforeSend: function() {
//     //         show_loader();
//     //     },
//     //     success: function(data) {

//     //         close_loader();
//     //         // if (data.length > 0) {
//     //         //     var sel = '';
//     //         //     $.each(data, function(i, obj) {
//     //         //         sel += '<tr>' +
//     //         //             +'<td >' + obj.product + ' < /td>' +
//     //         //             +'<td > < /td>' +
//     //         //             +'<td class = "text-right" > < /td>' +
//     //         //             +'<td class = "text-right" > < /td>' +
//     //         //             +'<td class = "text-right" > < /td>' +
//     //         //             +'</tr > ';
//     //         //     })
//     //         // } else {
//     //         //     $('#tables').empty().append('<option> Cliente sem vendas </option>');
//     //         // }
//     //         // $('#tables').html(sel).show();


//     //         console.log(data);
//     //         // customer
//     //     }
//     // });
// }
