let firstDate = moment().format("YYYY-MM-DD");
let lastDate = moment().format("YYYY-MM-DD");
$(document).ready(function () {
	// initDataTable('table-solid_sale');
	const url = window.location.href.split("/");
	if (url[url.length - 1].toString() === "home-sales") {
		firstDate = moment().subtract(6, "days").format("YYYY-MM-DD");
		initDrawChart(firstDate, lastDate, "sale");
	} else {
		initDrawChart(firstDate, lastDate, "sale");
	}
	$("#sale_date").text(moment().format("DD/MM/YYYY"));

	$("#select-sale-type-report").on("change", function () {
		const value = $(this).val();
		initDrawChart(firstDate, lastDate, value);
		console.log("value: " + value);
	});
});

$("#select-date").daterangepicker(
	{
		ranges: {
			// 'Todas': [moment().subtract(2, 'year'), moment()],
			Hoje: [moment(), moment()],
			Ontem: [moment().subtract(1, "days"), moment().subtract(1, "days")],
			"Últimos 7 Dias ": [moment().subtract(6, "days"), moment()],
			"Últimos 30 Dias": [moment().subtract(29, "days"), moment()],
			"Este Mês": [moment().startOf("month"), moment().endOf("month")],
			"Mês Passado": [
				moment().subtract(1, "month").startOf("month"),
				moment().subtract(1, "month").endOf("month"),
			],
		},
		showDropdowns: true,
		startDate: moment(),
		endDate: moment(),
		locale: {
			applyLabel: "Aplicar",
			cancelLabel: "Cancelar",
			startLabel: "Date initial",
			endLabel: "Date limite",
			customRangeLabel: "Customizar",
			daysOfWeek: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
			monthNames: [
				"Jan",
				"Fev",
				"Mar",
				"Abr",
				"Mai",
				"Jun",
				"Jul",
				"Ago",
				"Set",
				"Out",
				"Nov",
				"Dez",
			],
			firstDay: 1,
		},
	},
	function (start, end, label) {
		$("#select-date span").html(label);
		if (
			label.toString().toLowerCase() === "hoje" ||
			label.toString().toLowerCase() === "ontem"
		) {
			$("#sale_date").text(start.format("DD/MM/YYYY"));
		} else {
			$("#sale_date").text(
				start.format("DD/MM/YYYY") + " - " + end.format("DD/MM/YYYY")
			);
		}
		firstDate = start.format("YYYY-MM-DD");
		lastDate = end.format("YYYY-MM-DD");
		initDrawChart(start.format("YYYY-MM-DD"), end.format("YYYY-MM-DD"));
	}
);

function printElem(html) {
	printJS({
		printable: "frame",
		type: "html",
		header: html,
		style: "th{text-align: center!important;}",
		font: "TwCenMT",
		font_size: "14pt",
	});
}

function setValues(data) {
	$(".sum_subtotal").text(data.sum_subtotal);
	$(".sum_total").text(data.sum_total);
	$(".profit").text(data.profit);
	$(".profit_margin").text(data.profit_margin);
}

function initDrawChart() {
	const type = $("#select-sale-type-report").val();

	$.ajax({
		url: baseURL + "report/get_summary",
		method: "POST",
		dataType: "JSON",
		data: { init_date: firstDate, final_date: lastDate, type: type },
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			$(".last_order").html(data.top_ten);
			$("#last_order_pdf").html(data.top_ten_2);
			$("#div-report-items").html(data.products_sold);
			$("#div-report-payment").html(data.payment);
			let labelsPie = [];
			let valuesPie = [];
			let colorsPie = [];

			const pie = data.pie;
			for (let i = 0; i < pie.length; i++) {
				labelsPie.push(pie[i]["name"]);
				valuesPie.push(pie[i]["quantity"]);
				const color = dynamicColors();
				colorsPie.push(color);
			}
			drawPieChart(labelsPie, valuesPie, colorsPie);

			setValues(data.data);
			const chart = data.data.chart;
			let labels = [];
			let values = [];
			for (let i = 0; i < chart.length; i++) {
				labels.push(chart[i][0]);
				values.push(chart[i][1]);
			}

			drawChart(labels, values);
			close_loader();
		},
		error: function (error) {
			close_loader();
			console.log(error);
		},
	});
}

function dynamicColors() {
	var r = Math.floor(Math.random() * 255);
	var g = Math.floor(Math.random() * 255);
	var b = Math.floor(Math.random() * 255);
	return "rgb(" + r + "," + g + "," + b + ")";
}

var myChartPie;
function drawPieChart(labels, values, colors) {
	var bar = document.getElementById("chart-pie-1").getContext("2d");
	if (myChartPie) {
		myChartPie.destroy();
	}
	myChartPie = new Chart(bar, {
		type: "pie",
		data: {
			labels: labels,
			datasets: [
				{
					data: values,
					backgroundColor: colors,
					hoverBackgroundColor: colors,
				},
			],
		},
		responsive: true,
		options: {
			maintainAspectRatio: false,
			plugins: {
				legend: {
					position: "left",
				},
				title: {
					display: false,
					text: "",
				},
			},
		},
	});
} 

var myChart;

function drawChart(labels, values) {
	const barChartData = {
		labels: labels,
		datasets: [
			{
				label: false,
				backgroundColor: "#283487",
				borderColor: "#283487",
				borderWidth: 1,
				data: values,
				// fill: true,
				order: 100,
			},
			{
				label: false,
				data: values,
				type: "line",
				order: 1,
				lineTension: 0,
				fill: false,
				borderWidth: 1,
				borderColor: "#808080",
				backgroundColor: "rgba(0, 0, 0, 0.1)",
				borderDash: [],
				pointBorderColor: "#707070",
				pointBackgroundColor: "#fff",
				pointRadius: 4,
				pointHoverRadius: 6,
				pointHitRadius: 5,
				pointBorderWidth: 1,
				pointStyle: "Rounded",
			},
		],
	};

	if (myChart) {
		myChart.destroy();
	}

	const ctx = document.getElementById("barChart").getContext("2d");

	myChart = new Chart(ctx, {
		type: "bar",
		data: barChartData,
		options: {
			responsive: true,
			interaction: {
				intersect: true,
				mode: "index",
			},
			// display: true,
			scales: {
				x: {
					grid: {
						// borderDash: [1, 1],
						color: "white",
					},
				},

				y: {
					min: 0,
					grid: {
						// borderDash: [1, 1],
						color: "#f1f1f1",
					},
					ticks: {
						beginAtZero: true,
						callback: function (label, index, values) {
							if (Math.floor(label) === label) {
								return formatValue(label) + " MT";
							}
						},
					},
				},
			},
			plugins: {
				title: {
					display: false,
					text: "Sumário de Vendas",
				},
				legend: {
					display: false,
				},
				tooltip: {
					enabled: true,
					usePointStyle: true,
					callbacks: {
						labelPointStyle: function (context) {
							return {
								pointStyle: "triangle",
								rotation: 0,
							};
						},
					},
				},
			},
		},
	});
}

function print_summary() {
	var canvas = document.getElementById("barChart");
	document.getElementById("chart_image").src = canvas
		.toDataURL("image/png")
		.replace("image/png", "image/octet-stream");

	var canvas_pie_chart = document.getElementById("chart-pie-1");
	document.getElementById("pie_chart_image").src = canvas_pie_chart
		.toDataURL("image/png")
		.replace("image/png", "image/octet-stream");

	$("#re-title").text($("#select-sale-type-report option:selected").text());
	let rawHTML = $("#div-report-pdf").html();

	printJS({
		type: "raw-html",
		printable: rawHTML,
		font_size: "11px",
		font: "Arial",
		documentTitle: "Relatório de vendas",
		style:
			".table{font-family:Arial;width:100%;font-size:11px; border: 1px solid #dee2e6; border-collapse: collapse !important}" +
			".table th,.table td{border: 1px solid #dee2e6; padding: 2px 4px} .text-right {text-align: right !important} .text-left {text-align: left !important}" +
			".text-center {text-align: center !important}" +
			".title {font-size:16px}" +
			"h5 {font-family:Arial;font-size:13px}" +
			"p {font-family:Arial;font-size:12px}" +
			".qua{width:25%;padding-right: 0.75rem;" +
			"padding-left: 0.75rem;}" +
			".text-capitalize {" +
			"text-transform: capitalize !important;" +
			"}" +
			".row {" +
			"display: flex;" +
			"flex-wrap: wrap;" +
			"margin-right: -0.75rem;" +
			"margin-left: -0.75rem}" +
			".card {" +
			"position: relative;" +
			"display: flex;" +
			"flex-direction: column;" +
			"min-width: 0;" +
			"word-wrap: break-word;" +
			"background-color: #fff;" +
			"background-clip: border-box;" +
			"border: 1px solid #e3e6f0;" +
			"border-radius: 0.35rem;" +
			"}" +
			".card-body {" +
			"flex: 1 1 auto;" +
			"min-height: 1px;" +
			"padding: 0 1rem;" +
			"}" +
			".border-dashed-all {" +
			"border: #b9bcc6 1px dashed !important;" +
			"}",
	});

	// printReport

	// var options = {
	// 	mode: 'iframe',
	// 	popClose: 0,
	// 	extraCss: '#um{background-color: red}',
	// 	retainAttr: [],
	// 	extraHead: ''
	// };
	//
	// $('#div-report').printArea(options);
}
