

let firstDate = moment().format('YYYY-MM-DD');
let lastDate = moment().format('YYYY-MM-DD');
let target = '';
$(document).ready(function () {
	target = localStorage.getItem('link_history');
	if (target !== 'null') {
		$('#link-history-' + target).trigger('click');
	} else {
		$('.link-history:first-child').trigger('click');
	}
});

$(document).on('click', '.link-history', function () {
	target = $(this).data('target').toString();
	actionClick(target)
});

function actionClick(target) {
	localStorage.setItem("link_history", target);
	$('#btn-new-sale').attr('data-target', target);

	let url = '';
	if (target === 'invoice') {
		url = baseURL + 'invoice/history'
	} else if (target === 'quotation') {
		url = baseURL + 'quotation/history'
	} else if (target === 'note') {
		url = baseURL + 'invoice/notes'
	} else {
		url = baseURL + 'sale/history'
	}

	$.ajax({
		type: 'POST',
		url: url,
		beforeSend: function () {
			show_loader()
		},
		success: function (data) {
			close_loader();
			$('#btn-new-sale-span').text(data.target);
			$('#div-render-table').html(data.table);
			if (target === 'note') {
				$('#btn-new-sale').addClass('d-none');
			} else {
				$('#btn-new-sale').removeClass('d-none');
			}

			updateSelect2NoSearch()
			initSelectDate();

			$("#select-customer").select2({
				"language": {
					"noResults": function () {
						return "Sem resultado encontrado";
					}
				}
			}).on('select2:select', function (e) {
				filter()
			});

			$('#select-pay-method').on('change', function () {
				filter()
			})
		},
		error: function () {
			close_loader();
			show_toast_error('error')
		}
	});
}

function initSelectDate() {
	$('#select-date').daterangepicker({
		ranges: {
			// 'Todas': [moment().subtract(5, 'year'), moment()],
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
}

function filter() {
	const customer = $('#select-customer').val();
	const status = $('#select-status').val();
	const payment_method = $('#select-pay-method').val();
	let url = '';
	if (target === 'invoice') {
		url = baseURL + 'invoice/filter'
	} else if (target === 'quotation') {
		url = baseURL + 'quotation/filter'
	} else {
		url = baseURL + 'sale/filter_sales'
	}
	$.ajax({
		url: url,
		type: 'POST',
		data: {
			payment_method: payment_method,
			status: status,
			customer: customer,
			'init_date': firstDate,
			'final_date': lastDate
		},
		success: function (data) {
			reDrawTable(data);
			// console.log('data: '+data)
		}
	});
}
