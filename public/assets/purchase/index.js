$(document).ready(function () {
	initDataTable('table-history');
	$("#select-supplier").select2({
		"language": {
			"noResults": function () {
				return "Sem resultado encontrado";
			}
		}
	}).on('select2:select', function (e) {
		filter()
	});

	$('#select-date').daterangepicker({
		ranges: {
			'Todas': [moment().subtract(5, 'year'), moment()],
			'Hoje': [moment(), moment()],
			'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Últimos 7 Dias ': [moment().subtract(6, 'days'), moment()],
			'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
			'Este Mês': [moment().startOf('month'), moment().endOf('month')],
			'Mês Passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		showDropdowns: true,
		startDate: moment(),
		endDate: moment(),
		locale: {
			applyLabel: "Aplicar",
			cancelLabel: 'Cancelar',
			startLabel: 'Date initiale',
			endLabel: 'Date limite',
			customRangeLabel: 'Customizar',
			daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
			monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
			firstDay: 1
		}
	}, function (start, end, label) {

		firstDate = start.format('YYYY-MM-DD');
		lastDate = end.format('YYYY-MM-DD');
		$('#select-date span').html(label);
		filter()
	});

	$('#select-pay-method').on('change',function () {
		filter()
	})
});

let firstDate = moment().format('YYYY-MM-DD');
let lastDate = moment().format('YYYY-MM-DD');

function filter() {
	const supplier_id = $('#select-supplier').val();
	const status = $('#select-status').val();

	$.ajax({
		type: 'POST',
		data: {
			status: status,
			supplier_id: supplier_id,
			init_date: firstDate,
			final_date: lastDate,
		},
		url: baseURL + 'purchase/filter',
		beforeSend: function () {
			show_loader()
		},
		success: function (data) {
			reDrawTable(data);
			close_loader();
		}
	})
}
