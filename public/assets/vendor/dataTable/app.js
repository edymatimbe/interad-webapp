//datatable
let perPage = 10;
let oldPerPage = perPage;
let tableIDD;
let tableIDDSERVER;
let currentPage;
let hasFooter = false;

function initDataTableServer(tableID, serverSide) {

	const table = $('#' + tableID).dataTable(serverSide).on('draw.dt', function () {
		drawTableServer(tableID)
	});
	// $('#my-search').on('keyup',function(){
	// 	table.search($(this).val()).draw() ;
	// })
	drawTableServer(tableID)
}

let idd ='10';
$(document).on('change', '#per-page-server', function () {
	idd = $(this).val()
	console.log(tableIDDSERVER+' v: '+idd);
	$('#' + tableIDDSERVER + '_length select').val($(this).val()).trigger('change');
});


function drawTableServer(tableID) {

	tableIDDSERVER = tableID;
	$('#' + tableID + '_wrapper div:first').addClass('d-none');
	$('#' + tableID + '_wrapper div:nth-child(3)').addClass('border-top');
	$('#' + tableID + '_paginate').addClass('pt-2');

	// $('#'+tableID+'_info').parent().addClass('d-flex justify-content-between')

	const options = $('#' + tableID + '_length select').html();
	$('#' + tableID + '_info').html(
		// $('#'+tableID+'_info').before(
		'<div class="d-flex">' +
		'<select style="width: 75px" id="per-page-server" class="form-control form-control-sm">' + options + '</select>' +
		'<div class="pt-2 pl-2 f-s-13 text-nowrap">Por página</div>' +
		'</div>'
	);

	$('#per-page-server').val(idd)

	$('#' + tableID + ' tbody td').addClass('align-middle pl-lg-1');
	$('#my-search').on('input', function () {
		$('#' + tableID + '_filter').find('input').val($(this).val()).trigger('input')
	});

	$('.toggle-switch').bootstrapToggle({
		on: 'ON',
		off: 'OFF',
		onstyle: 'success',
		size: "sm",
	});
}



function initDataTable(tableID, hasFoot, perPageInit = null) {
	tableIDD = tableID;
	hasFooter = hasFoot;
	let lengthMenu = [perPage, 15, 20, 25, 50, 100]
	if (perPageInit) {
		lengthMenu.push(perPageInit)
		lengthMenu.sort(function (a, b) {
			return a - b;
		});
		perPage = oldPerPage = Math.min.apply(Math, lengthMenu);
	}
	$('#' + tableID).dataTable({
		"language": {
			"paginate": {
				"next": "<i class='fa fa-angle-right'></i>",
				"previous": "<i class='fa fa-angle-left'></i>",
			},
			"emptyTable": "Sem dados disponíveis na tabela"
		},
		"bDestroy": true,
		"bSort": false,
		pageLength: perPage,
		lengthMenu: lengthMenu,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	}).on('draw.dt', function () {
		drawTable(perPage, tableID)
	});
	drawTable(oldPerPage, tableID)
}

$(document).on('change', '#per-page', function () {
	perPage = $(this).val();
	console.log(tableIDD);
	$('#' + tableIDD + '_length select').val(perPage).trigger('change');
});

function drawTable(valor, tableID) {

	$('#' + tableID + '_length select option[value =' + oldPerPage + ']').removeAttr('selected');
	$('#' + tableID + '_length select option[value =' + valor + ']').attr('selected', 'selected');

	$('#' + tableID + '_wrapper div:first').addClass('d-none');
	$('#' + tableID + '_wrapper div:nth-child(3)').addClass('border-top');
	$('#' + tableID + '_paginate').addClass('pt-2');

	// $('#'+tableID+'_info').parent().addClass('d-flex justify-content-between')

	const options = $('#' + tableID + '_length select').html();
	$('#' + tableID + '_info').html(
		// $('#'+tableID+'_info').before(
		'<div class="d-flex">' +
		'<select style="width: 75px" id="per-page" class="form-control form-control-sm">' + options + '</select>' +
		'<div class="pt-2 pl-2 f-s-13 text-nowrap">Por página</div>' +
		'</div>'
	);

	oldPerPage = valor;
	$('#' + tableID + ' tbody td').addClass('align-middle pl-lg-1');
	$('#my-search').on('input', function () {
		$('#' + tableID + '_filter').find('input').val($(this).val()).trigger('input')
	});

	$('.toggle-switch').bootstrapToggle({
		on: 'ON',
		off: 'OFF',
		onstyle: 'success',
		size: "sm",
	});


	// const table = $('#' + tableIDD).DataTable();
	// currentPage = table.page.info().page;
	// console.log('current page: '+currentPage);
	// $('#'+tableIDD).DataTable().page(currentPage).draw(false);
}

function reDrawTable(data) {
	$('#' + tableIDD).DataTable().destroy();
	if (hasFooter) {
		$('#' + tableIDD + ' tbody').remove();
		$('#' + tableIDD + ' tfoot').remove();
		$('#' + tableIDD + ' thead').after(data);
	} else {
		$('#' + tableIDD + ' tbody').html(data);
	}
	initDataTable(tableIDD, hasFooter)
}
function reDrawTableServer(tableIDD,serverSide) {
	$('#' + tableIDD).DataTable().destroy();
	initDataTableServer(tableIDD, serverSide)
}

//datatable
