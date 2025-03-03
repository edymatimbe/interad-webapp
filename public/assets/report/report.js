//
//
//
//
//
// $(document).ready(function() {
//     initDataTable('table-user-report');
//     $('#select-date').daterangepicker({
//         ranges: {
//             'Todas': [moment().subtract(2, 'year'), moment()],
//             'Hoje': [moment(), moment()],
//             'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//             'Últimos 7 Dias ': [moment().subtract(6, 'days'), moment()],
//             'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
//             'Este Mês': [moment().startOf('month'), moment().endOf('month')],
//             'Mês Passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//         },
//         showDropdowns: true,
//         startDate: moment(),
//         endDate: moment(),
//         locale: {
//             applyLabel: "Aplicar",
//             cancelLabel: 'Cancelar',
//             startLabel: 'Date initial',
//             endLabel: 'Date limite',
//             customRangeLabel: 'Customizar',
//             daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
//             monthNames: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
//             firstDay: 1
//         }
//     }, function(start, end, label) {
//         $('#select-date span').html(label)
//         initDrawChart(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
//     });
//
// });
// initDrawChart(moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'))
//
//
// $("#select-store").select2({}).on('select2:select', function(e) {
//     $.ajax({
//         type: 'GET',
//         data: { id: e.params.data.id },
//         url: '',
//         success: function(data) {
//             console.log('user seated')
//         }
//     })
//
// })
//
//
// // function initDashboard(init_date, final_date) {
// //     $.ajax({
// //         url: "dashboard_data",
// //         method: "POST",
// //         dataType: "JSON",
// //         data: { 'init_date': init_date, 'final_date': final_date },
// //         success: function(data) {
// //             console.log(data);
//
// //         },
// //         error: function(error) {
// //             console.log(error)
// //         }
// //     })
// // }
//
//
//
//
//
//
// //Sales Summary Mixed Graph
// function initDrawChart(init_date, final_date) {
//     $.ajax({
//         url: "get_sales",
//         method: "POST",
//         dataType: "JSON",
//         data: { 'init_date': init_date, 'final_date': final_date },
//         success: function(data) {
//             let labels = [];
//             let values = [];
//             for (let i = 0; i < data.length; i++) {
//                 labels.push(data[i][0]);
//                 values.push(data[i][1]);
//             }
//             drawChart(labels, values)
//         },
//         error: function(error) {
//             console.log(error)
//         }
//     })
// }
//
// var myChart;
//
// function drawChart(labels, values) {
//     const barChartData = {
//         labels: labels,
//         datasets: [{
//             label: 'Total de Vendas',
//             backgroundColor: '#283487',
//             borderColor: '#283487',
//             borderWidth: 1,
//             data: values,
//             fill: true,
//             order: 100,
//         }, {
//             label: false,
//             data: values,
//             type: 'line',
//             order: 1,
//             lineTension: 0,
//             fill: false,
//             borderWidth: 1,
//             borderColor: '#808080',
//             backgroundColor: 'rgba(0, 0, 0, 0.1)',
//             borderDash: [],
//             pointBorderColor: '#707070',
//             pointBackgroundColor: '#fff',
//             pointRadius: 4,
//             pointHoverRadius: 6,
//             pointHitRadius: 5,
//             pointBorderWidth: 1,
//             pointStyle: 'Rounded'
//         }],
//     };
//
//     if (myChart) {
//         myChart.destroy();
//     }
//     const ctx = document.getElementById('myChart').getContext('2d');
//     myChart = new Chart(ctx, {
//         type: 'bar',
//         data: barChartData,
//         options: {
//             responsive: true,
//             display: false,
//             legend: {
//                 display: false
//             },
//
//             scales: {
//                 xAxes: [{
//                     gridLines: {
//
//                         color: "#fff",
//                     }
//                 }],
//
//                 yAxes: [{
//                     gridLines: {
//                         borderDash: [4, 2],
//                         color: "#f1f1f1",
//                     },
//                     ticks: {
//                         beginAtZero: true,
//                         callback: function(value, index, values) {
//                             return number_format(value) + ' MT';
//                         }
//                     }
//                 }],
//             },
//             title: {
//                 display: false,
//                 // text: 'Sumário de Vendas'
//             },
//             tooltips: {
//                 titleMarginBottom: 10,
//                 titleFontColor: '#6e707e',
//                 titleFontSize: 14,
//                 backgroundColor: "rgb(255,255,255)",
//                 bodyFontColor: "#858796",
//                 borderColor: '#dddfeb',
//                 borderWidth: 1,
//                 xPadding: 15,
//                 yPadding: 15,
//                 displayColors: false,
//                 caretPadding: 10,
//                 callbacks: {
//                     label: function(tooltipItem, chart) {
//                         var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label;
//                         return datasetLabel + ': MT' + number_format(tooltipItem.yLabel);
//                     }
//                 }
//             },
//         }
//     });
// };
//
//
// //Vendas por Categoria
//
// // new Chart(document.getElementById("bar-chart-horizontal"), {
// // 	type: 'horizontalBar',
// // 	data: {
// // 		labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
// // 		datasets: [
// // 			{
// // 				label: "Population (millions)",
// // 				backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
// // 				data: [2478,5267,734,784,433]
// // 			}
// // 		]
// // 	},
// // 	options: {
// // 		legend: { display: false },
// // 		title: {
// // 			display: true,
// // 			text: 'Predicted world population (millions) in 2050'
// // 		}
// // 	}
// // });
