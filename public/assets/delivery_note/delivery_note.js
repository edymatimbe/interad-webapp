$(document).ready(function () {
	// initDataTable('table-history',true,15);
	initDataTable('table-history');

})
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


function show_delivery(id) {
	$.ajax({
		url: baseURL+'delivery_note/show',
		type: 'GET',
		data: { 'id': id },
		// dataType: "JSON",
		success: function(data) {
			// console.log(data)
			// $('#modal-sale-content').html(data);
			// $('#modal-sale').modal('show');
			$('#modal-md-content').html(data);
			$('#modal-md').modal('show')
		},
		error: function(data) {
			console.log('error: ' + data)
		}
	});
}



function printElem(html) {
	printJS({
		printable: 'frame',
		type: 'html',
		header:html,
		style:'#titlee{color:green};',
		font: "TwCenMT",
		font_size: "14pt",
	});
}
