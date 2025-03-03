

let chart_instance_status;
let chart_instance_reason;
let chart_instance_gender;
let chart_instance_project;
let chart_instance_canal;
let chart_instance_category;

function init_bar_chart(statusList, data_chart, colors, labels, chartID) {

    if (data_chart.length === 0) {
        if (chartID.toString() === 'chart-status') {
            if (chart_instance_status) {
                chart_instance_status.destroy();
                return
            }
        }
        if (chartID.toString() === 'chart-reason') {
            if (chart_instance_reason) {
                chart_instance_reason.destroy();
                return
            }
        }
        if (chartID.toString() === 'chart-gender') {
            if (chart_instance_gender) {
                chart_instance_gender.destroy();
                return
            }
        }
        if (chartID.toString() === 'chart-project') {
            if (chart_instance_project) {
                chart_instance_project.destroy();
                return
            }
        }
        if (chartID.toString() === 'chart-canal') {
            if (chart_instance_canal) {
                chart_instance_canal.destroy();
                return
            }
        }
        if (chartID.toString() === 'chart-category') {
            if (chart_instance_category) {
                chart_instance_category.destroy();
                return
            }
        }
    }
    if (chartID.toString() === 'chart-status') {
        if (chart_instance_status) {
            chart_instance_status.destroy();
        }
    }
    if (chartID.toString() === 'chart-reason') {
        if (chart_instance_reason) {
            chart_instance_reason.destroy();
        }
    }
    if (chartID.toString() === 'chart-gender') {
        if (chart_instance_gender) {
            chart_instance_gender.destroy();
        }
    }
    if (chartID.toString() === 'chart-project') {
        if (chart_instance_project) {
            chart_instance_project.destroy();
        }
    }
    if (chartID.toString() === 'chart-canal') {
        if (chart_instance_canal) {
            chart_instance_canal.destroy();
        }
    }
    if (chartID.toString() === 'chart-category') {
        if (chart_instance_category) {
            chart_instance_category.destroy();
        }
    }

    let bigSets = [];
    for (let i = 0; i < statusList.length; i++) {

        let result_data = [];
        for (let x = 0; x < data_chart.length; x++) {
            result_data.push(data_chart[x][i]);
        }

        bigSets.push(
            {
                label: statusList[i],
                // data: [
                //     data_chart[0][i],
                //     data_chart[1] ? data_chart[1][i] : 0,
                // ],
                data: result_data,
                borderColor: colors[i],
                backgroundColor: colors[i],
                hoverBackgroundColor: colors[i],
                hoverBorderColor: colors[i]
            }
        )
    }
    const config = {
        type: 'bar',
        data: {
            // labels: ['1 Trimestre', ' 2º Trimestre'],
            labels: labels,
            datasets: bigSets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Ocorrências'
                }
            },
            scales: {
                y: {
                    // stacked: true,
                    min: 0,
                    grid: {
                        color: "#f1f1f1",
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function (label, index, values) {
                            if (Math.floor(label) === label) {
                                return label;
                            }
                        }
                    }
                },
            },
        },
    };

    const bar = document.getElementById(chartID).getContext('2d');

    if (chartID.toString() === 'chart-status') {
        chart_instance_status = new Chart(bar, config)
    }

    if (chartID.toString() === 'chart-reason') {
        chart_instance_reason = new Chart(bar, config)
    }

    if (chartID.toString() === 'chart-gender') {
        chart_instance_gender = new Chart(bar, config)
    }

    if (chartID.toString() === 'chart-project') {
        chart_instance_project = new Chart(bar, config)
    }
    if (chartID.toString() === 'chart-canal') {
        chart_instance_canal = new Chart(bar, config)
    }
    if (chartID.toString() === 'chart-category') {
        chart_instance_category = new Chart(bar, config)
    }
}

function init_chart_province(labelsData, data_chart, colors, chartID) {
    // console.log(data_chart);
    const chart = data_chart;
    let labels = [];
    let data = [];
    for (let i = 0; i < chart.length; i++) {
        labels.push(chart[i].province);
    }

    for (let v = 0; v < labelsData.length; v++) {

        let min_data = [];

        for (let i = 0; i < chart.length; i++) {
            min_data.push(chart[i][v]);
        }

        const line = {
            label: labelsData[v],
            backgroundColor: colors[v],
            hoverBackgroundColor: colors[v],
            borderWidth: 1,
            data: min_data,
            order: 100,
        };
        data.push(line);
    }
    new Chart(document.getElementById(chartID).getContext('2d'), getContent(labels, data));
}

function getContent(labels, data) {
    return {
        type: 'bar',
        data: {
            labels: labels,
            datasets: data
        },
        options: {
            responsive: true,
            interaction: {
                intersect: true,
                mode: 'index',
            },
            scales: {
                x: {
                    // stacked: true,

                    grid: {
                        color: "white",
                    }
                },

                y: {
                    // stacked: true,

                    min: 0,
                    grid: {
                        color: "#f1f1f1",
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function (label, index, values) {
                            if (Math.floor(label) === label) {
                                return label;
                            }
                        }
                    }
                },
            },
            plugins: {
                title: {
                    display: false,
                    text: ''
                },

            }
        }
    }
}

let chart_vince;
let chart_canal;

function drawBarChart(labels, data, colors, innerLb, barID) {
    if (barID.toString() === 'chart-district') {
        if (chart_vince) {
            chart_vince.destroy();
        }
    }
    if (barID.toString() === 'chart-canal') {
        if (chart_canal) {
            chart_canal.destroy();
        }
    }
    let dataSets = [];
    for (let i = 0; i < data.length; i++) {
        dataSets.push(
            {
                label: innerLb[i],
                backgroundColor: colors[i],
                borderWidth: 1,
                data: data[i],
                order: 100,
            },
        );
    }
    if (barID.toString() === 'chart-district') {
        chart_vince = new Chart(document.getElementById(barID).getContext('2d'), getContentStack(labels, dataSets));
    }
    if (barID.toString() === 'chart-canal') {
        chart_canal = new Chart(document.getElementById(barID).getContext('2d'), getContentStack(labels, dataSets));
    }
}

function getContentStack(labels, data) {
    return {
        type: 'bar',
        data: {
            labels: labels,
            datasets: data
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            // interaction: {
            //     intersect: true,
            //     mode: 'index',
            // },
            scales: {
                y: {
                    stacked: true,

                    grid: {
                        color: "white",
                    }
                },

                x: {
                    stacked: true,

                    min: 0,
                    grid: {
                        color: "#f1f1f1",
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function (label, index, values) {
                            if (Math.floor(label) === label) {
                                return label;
                            }
                        }
                    }
                },
            },
            plugins: {
                title: {
                    display: false,
                    text: ''
                }
            }
        }
    }
}
