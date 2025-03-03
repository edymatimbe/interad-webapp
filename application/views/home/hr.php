<?php $this->load->view('layout/header') ?>
    <div class="row">
        <div class="col-lg-7 col-md-12">
            <!-- support-section start -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="card support-bar overflow-hidden">
                        <div class="card-body pb-0">
                            <br>
                            <h3 class="text-dark text-center"><i class="fa fa-people-carry"></i></h3>
                            <h3 class="m-0 text-dark text-center"><?= count(get_all('employee', null)) ?></h3>
                            <p class="text-dark f-w-700 text-center my-3 f-s-15">Funcionários</p>
                        </div>
                        <div class="card-footer bg-gray-700 text-white">
                            <div class="row text-center">
                                <div class="col">
                                    <h4 class="pt-2 text-dark  bg-white br-3 shadow w-50 d-block mx-auto d-flex flex-column pb-2">
                                        <span>
                                            <i class="fa fa-male"></i>
                                            <?= count(get_all('employee', ['active' => 1, 'gender' => 'masculino'])) ?>
                                        </span>
                                        <span class="f-s-12 mt-2">Masculino</span>
                                    </h4>
                                </div>
                                <div class="col">
                                    <h4 class="pt-2 text-dark  bg-white br-3 shadow w-50 d-block mx-auto d-flex flex-column pb-2">
                                        <span>
                                            <i class="fa fa-female"></i>
                                        <?= count(get_all('employee', ['active' => 1, 'gender' => 'feminino'])) ?>
                                        </span>
                                        <span class="f-s-12 mt-2">Feminino</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card support-bar overflow-hidden">
                        <div class="card-body pb-0">
                            <br>
                            <h3 class="text-primary text-center"><i class="fa fa-users"></i></h3>
                            <h3 class="m-0 text-c-purple text-center"><?= count(get_all('users', ['id !=' => 1])) ?></h3>
                            <p class="text-dark f-w-700 text-center my-3 f-s-15">Utilizadores</p>
                        </div>
                        <div class="card-footer bg-primary text-white">
                            <div class="row text-center">
                                <div class="col">
                                    <h4 class="pt-2 text-primary  bg-white br-3 shadow w-50 d-block mx-auto d-flex flex-column pb-2">
                                        <?= count(get_all('users', ['active' => 1, 'id !=' => 1])) ?>
                                        <span class="f-s-12 mt-2">Activos</span>
                                    </h4>
                                </div>
                                <div class="col">
                                    <h4 class="pt-2 text-dark bg-white br-3 shadow w-50 d-block mx-auto d-flex flex-column pb-2">
                                        <span>
                                        <?= count(get_all('users', ['active' => 0, 'id !=' => 1])) ?>
                                        </span>
                                        <span class="f-s-12 mt-2">Inactivos</span>
                                    </h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- support-section end -->
        </div>
        <div class="col-lg-5 col-md-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-yellow">
                                        <?= this_number_format($this->core_model->get_sum('instalment', 'amount_total')) ?>
                                    </h4>
                                    <br>
                                    <h6 class="text-muted m-b-0">Valor embolsado</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="fa fa-money f-28"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-green">
                                        <?= this_number_format($this->core_model->get_sum('instalment', 'amount_total', ['status' => 'paga'])) ?>
                                    </h4>
                                    <br>
                                    <h6 class="text-muted m-b-0">Valor desembolsado</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-thumbs-up f-28"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2 pt-1">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-red">
                                        <?= this_number_format($this->core_model->get_sum('instalment', 'amount_total', ['status' => 'pendente'])) ?>
                                    </h4>
                                    <br>
                                    <h6 class="text-muted m-b-0">Valor a desembolsar</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-calendar f-28"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-blue">
                                        <?= count(get_all('salary_processing', ['active' => 1], null, 'year')) ?>
                                    </h4>
                                    <br>
                                    <h6 class="text-muted text-nowrap m-b-0">Salários processados (Nº)</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-check-square text-success f-28"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <a href="<?=base_url('departments')?>">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-home f-30 text-c-green"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10"><?= $this->lang->line('departments') ?></h6>
                                <h2 class="m-b-0"><?= count(get_all('department', ['active' => 1])) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6">
            <a href="<?=base_url('jobs')?>">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-bookmark f-30 text-c-red"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10"><?= $this->lang->line('jobs') ?></h6>
                                <h2 class="m-b-0"><?= count(get_all('job', ['active' => 1])) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="<?=base_url('loans')?>">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="feather icon-credit-card text-micro  f-30 text-c-purple"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10 text-capitalize">Emprestimos <span
                                            class="text-lowercase">&nbsp;activos</span></h6>
                                <h2 class="m-b-0"><?= count(get_all('loan', ['status' => 'aberto', 'active' => 1])) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6">
            <a href="<?= base_url('subsidies') ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="fa fa-tags text-micro f-30 text-c-purple"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10"><?= 'Subsídios' ?></h6>
                                <h2 class="m-b-0"> <?= count(get_all('subsidy')) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><i class="feather icon-bar-chart-2 mr-2"></i>Presenças de funcionários</h5>
        </div>
        <div class="card-body px-0 pb-0">
            <div id="chart-employees" class="w-100" style="height: 500px;"></div>
        </div>
    </div>


    <script src="<?= base_url('public/vendor/amchart/index.js') ?>"></script>
    <script src="<?= base_url('public/vendor/amchart/xy.js') ?>"></script>
    <script src="<?= base_url('public/vendor/amchart/Animated.js') ?>"></script>

    <script>

        $.ajax({
            type: 'GET',
            url: "<?=base_url('base/init_dashboard')?>",
            dataType: 'JSON',
            success: function (data_response, textStatus) {
            console.log(data_response)
                am5.ready(function () {

                    // Create root element
                    var root = am5.Root.new("chart-employees");

                    // Set themes [https://www.amcharts.com/docs/v5/concepts/themes/]
                    root.setThemes([
                        am5themes_Animated.new(root)
                    ]);

                    // Create chart
                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                        panX: false,
                        panY: false,
                        wheelX: "panX",
                        wheelY: "zoomX",
                        layout: root.verticalLayout
                    }));

                    // var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                    // cursor.lineY.set("visible", true);

                    // Data
                    var colors = chart.get("colors");


                    // data = data.presences;
                    let presences_response = data_response.presences;
                    for (let i = 0; i < presences_response.length; i++) {
                        presences_response[i].columnSettings = {fill: colors.next()};
                    }

                    var data = presences_response;

                    // Create axes
                    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                        categoryField: "name",
                        renderer: am5xy.AxisRendererX.new(root, {
                            minGridDistance: 30
                        }),
                        bullet: function (root, axis, dataItem) {
                            return am5xy.AxisBullet.new(root, {
                                location: 0.5,
                                sprite: am5.Picture.new(root, {
                                    width: 24,
                                    height: 24,
                                    centerY: am5.p50,
                                    centerX: am5.p50,
                                    src: dataItem.dataContext.icon
                                })
                            });
                        }
                    }));

                    xAxis.get("renderer").labels.template.setAll({
                        paddingTop: 20
                    });

                    xAxis.data.setAll(data);

                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                        min: 0,
                        max: 50,
                        strictMinMax: true,
                        renderer: am5xy.AxisRendererY.new(root, {}),
                    }));

                    // Add series
                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                        xAxis: xAxis,
                        yAxis: yAxis,
                        valueYField: "presences",
                        categoryXField: "name"
                    }));

                    series.columns.template.setAll({
                        tooltipText: "{categoryX}: {valueY}",
                        tooltipY: 0,
                        strokeOpacity: 0,
                        templateField: "columnSettings"
                    });

                    series.data.setAll(data);
                    // Make stuff animate on load
                    series.appear();
                    chart.appear(1000, 100);
                }); // end am5.ready()
            }
        });


    </script>

    <script>
        $(document).ready(function () {
            $('#menu-dashboard').addClass('active pcoded-trigger');
            $('#menu-dashboard .principal').addClass('active');
            $('#menu-dashboard .pcoded-submenu').css('display', 'block');
        })
    </script>

<?php $this->load->view('layout/footer') ?>