<?php

use Faker\Core\Number;

$this->load->view('layout/public/header'); ?>
<?php $user = $this->core_model->get_by_id('users', array('id' => $this->ion_auth->get_user_id())) ?>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->

    <h1>
        <?php

      
        $newArray = [];
        $tax = [];
        $last_time = [];
       
        foreach (get_all('controller_tax', ['controller_id !=' => null, 'tax_id !=' => null]) as $item) {

            if (!empty($item->location)) {
                $array = unserialize($item->location);
                // arsort($array);
                foreach ($array as $location) {
                    $last_array = $location;
                }
                $newArray[] = $last_array;

                $tax[] =  $this->setting_model->get_tax(['tax.id' => $item->tax_id]);
                $last_time[] = formatDateTimeToRelative( $item->updated_at) ;
            }
        }

        ?>
    </h1>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total de campanhas</div>

                            </div>
                            <div class="h1 mb-3"><?= $ads ?></div>
                            <div class="d-flex mb-2">
                                <div class="ms-auto">
                                    <span class="text-primary d-inline-flex align-items-center lh-1">
                                        100.00%
                                        <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 17l6 -6l4 4l8 -8" />
                                            <path d="M14 7l7 0l0 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 100%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                                    <span class="visually-hidden">75% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Campanhas activas</div>
                            </div>
                            <div class="h1 mb-3">
                                <?= $active_ads = count(get_all('controller', ['status' => 'pago', 'controller.created_by' => $this->ion_auth->get_user_id()])) ?>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="ms-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        <?= $ads == 0 ? number_format(0, 2) : number_format((float)100 * $active_ads / $ads, 2, '.', '') ?>%
                                        <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 17l6 -6l4 4l8 -8" />
                                            <path d="M14 7l7 0l0 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" style="width: <?= $ads == 0 ? number_format(0, 2) : 100 * $active_ads / $ads ?>%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="10" aria-label="75% Complete">
                                    <span class="visually-hidden">75% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Campanhas pendentes</div>

                            </div>
                            <div class="h1 mb-3">
                                <?= $pendente_ads = count(get_all('controller', ['status' => 'pendente', 'controller.created_by' => $this->ion_auth->get_user_id()])) ?>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="ms-auto">
                                    <span class="text-warning d-inline-flex align-items-center lh-1">
                                        <?= $ads == 0 ? number_format(0, 2) : number_format((float)100 * $pendente_ads / $ads, 2, '.', '') ?>%
                                        <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 17l6 -6l4 4l8 -8" />
                                            <path d="M14 7l7 0l0 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: <?= $ads == 0 ? number_format(0, 2) : 100 * $pendente_ads / $ads ?>%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="10" aria-label="75% Complete">
                                    <span class="visually-hidden">75% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Campanhas vencidas</div>
                            </div>
                            <div class="h1 mb-3">
                                <?= $expiry_ads = count(get_all('controller', ['status' => 'expirou', 'controller.created_by' => $this->ion_auth->get_user_id()])) ?>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="ms-auto">
                                    <span class="text-danger d-inline-flex align-items-center lh-1">
                                        <?= $ads == 0 ? number_format(0, 2) : number_format((float)100 *  $expiry_ads / $ads, 2, '.', '') ?>%
                                        <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 17l6 -6l4 4l8 -8" />
                                            <path d="M14 7l7 0l0 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger" style="width: <?= $ads == 0 ? number_format(0, 2) : 100 * $expiry_ads / $ads ?>%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="10" aria-label="75% Complete">
                                    <span class="visually-hidden">75% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Histórico de campanhas</h3>
                            <div id="chart-combination"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Locations</h3>
                            <div class="ratio ratio-21x9">
                                <div>
                                    <!-- <div id="map-world" class="w-100 h-100"></div> -->
                                    <div id="map" class="w-100 h-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Estatisticas de anúncios</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Anúcios</th>
                                        <th class="text-center">Nr. views</th>
                                        <th class="text-center">Nr. taxes</th>
                                        <th class="text-center">Nr. likes</th>
                                        <th class="text-center">Nr. deslike</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $views = 0;
                                    $taxs = 0;
                                    $likes = 0;
                                    $deslikes = 0;
                                    ?>
                                    <?php foreach ($campaigns as $key => $campaign) : ?>
                                        <?php $controller_tax =  $this->setting_model->controller_tax(['controller_tax.controller_id' => $campaign->controller_id]); ?>
                                        <tr>
                                            <td class=""><?= $campaign->title ?></td>
                                            <td class="text-center"><?= $controller_tax->views ?></td>

                                            <td class="text-center"><?= $controller_tax->total_tax ?></td>
                                            <td class="text-center"><?= $controller_tax->likes ?></td>
                                            <td class="text-center"><?= $controller_tax->deslikes ?></td>
                                        </tr>

                                        <?php
                                        $views =  $views +  $controller_tax->views;
                                        $taxs += $controller_tax->total_tax;
                                        $likes  += $controller_tax->likes;
                                        $deslikes  += $controller_tax->deslikes;
                                        ?>
                                    <?php endforeach; ?>
                                    <input type="hidden" name="views" id="views" value="<?= $views ?>">
                                    <input type="hidden" name="taxs" id="taxs" value="<?= $taxs ?>">
                                    <input type="hidden" name="deslikes" id="deslikes" value="<?= $deslikes ?>">
                                    <input type="hidden" name="likes" id="likes" value="<?= $likes ?>">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 ">

                    <div class="card shadow">
                        <div class="card-body">
                            <div id="chart-demo-pie"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/public/footer'); ?>'
 
    <script>

    </script>
    <script>
        $(document).ready(function() {
            // $.cookie("test", 1);
            // Cookies.set('name', 'teste');
            $(".home-page").addClass("active")
        });
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {

            $.ajax({
                url: "<?= base_url('public/advertiser/get_chart') ?>",
                type: 'GET',
                dataType: "JSON",
                success: function(data) {
                    // console.log(data[0].pendente)

                    let pendentes = [];
                    let expiry = [];
                    let paid = [];


                    $.each(data, function(i) {
                        pendentes.push(data[i].pendente)
                        expiry.push(data[i].expiry)
                        paid.push(data[i].count_active)
                    });
                    console.log(pendentes)

                    window.ApexCharts && (new ApexCharts(document.getElementById('chart-combination'), {
                        chart: {
                            type: "bar",
                            fontFamily: 'inherit',
                            height: 240,
                            parentHeightOffset: 0,
                            toolbar: {
                                show: false,
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%',
                            }
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 1,
                        },
                        series: [{
                            name: "Pendente",
                            data: pendentes
                        }, {
                            name: "Activo",
                            data: paid
                        }, {
                            name: "Vencido",
                            data: expiry
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            padding: {
                                top: -20,
                                right: 0,
                                left: -4,
                                bottom: -4
                            },
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            axisBorder: {
                                show: false,
                            },
                            categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio',
                                'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro',
                                'Novembro', 'Dezembro'
                            ],
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        colors: [tabler.getColor("warning"), tabler.getColor("green"),
                            tabler.getColor("danger"), tabler.getColor("primary")
                        ],
                        legend: {
                            show: false,
                        },
                        legend: {
                            show: true,
                            position: 'bottom',
                            offsetY: 12,
                            markers: {
                                width: 10,
                                height: 10,
                                radius: 100,
                            },
                            itemMargin: {
                                horizontal: 8,
                                vertical: 8
                            },
                        },
                    })).render();



                },
            });

        });
        // @formatter:on
    </script>



    <script>
        // @formatter:on
        document.addEventListener("DOMContentLoaded", function() {
            const map = new jsVectorMap({
                selector: '#map-world',
                map: 'world',
                backgroundColor: 'transparent',
                regionStyle: {
                    initial: {
                        fill: tabler.getColor('body-bg'),
                        stroke: tabler.getColor('border-color'),
                        strokeWidth: 2,
                    }
                },
                zoomOnScroll: false,
                zoomButtons: false,
                // -------- Series --------
                visualizeData: {
                    scale: [tabler.getColor('bg-surface'), tabler.getColor('primary')],
                    values: {
                        "AF": 16,
                        "AL": 11,
                        "DZ": 158,
                        "AO": 85,
                        "AG": 1,
                        "AR": 351,
                        "AM": 8,
                        "AU": 1219,
                        "AT": 366,
                        "AZ": 52,
                        "BS": 7,
                        "BH": 21,
                        "BD": 105,
                        "BB": 3,
                        "BY": 52,
                        "BE": 461,
                        "BZ": 1,
                        "BJ": 6,
                        "BT": 1,
                        "BO": 19,
                        "BA": 16,
                        "BW": 12,
                        "BR": 2023,
                        "BN": 11,
                        "BG": 44,
                        "BF": 8,
                        "BI": 1,
                        "KH": 11,
                        "CM": 21,
                        "CA": 1563,
                        "CV": 1,
                        "CF": 2,
                        "TD": 7,
                        "CL": 199,
                        "CN": 5745,
                        "CO": 283,
                        "KM": 0,
                        "CD": 12,
                        "CG": 11,
                        "CR": 35,
                        "CI": 22,
                        "HR": 59,
                        "CY": 22,
                        "CZ": 195,
                        "DK": 304,
                        "DJ": 1,
                        "DM": 0,
                        "DO": 50,
                        "EC": 61,
                        "EG": 216,
                        "SV": 21,
                        "GQ": 14,
                        "ER": 2,
                        "EE": 19,
                        "ET": 30,
                        "FJ": 3,
                        "FI": 231,
                        "FR": 2555,
                        "GA": 12,
                        "GM": 1,
                        "GE": 11,
                        "DE": 3305,
                        "GH": 18,
                        "GR": 305,
                        "GD": 0,
                        "GT": 40,
                        "GN": 4,
                        "GW": 0,
                        "GY": 2,
                        "HT": 6,
                        "HN": 15,
                        "HK": 226,
                        "HU": 132,
                        "IS": 12,
                        "IN": 1430,
                        "ID": 695,
                        "IR": 337,
                        "IQ": 84,
                        "IE": 204,
                        "IL": 201,
                        "IT": 2036,
                        "JM": 13,
                        "JP": 5390,
                        "JO": 27,
                        "KZ": 129,
                        "KE": 32,
                        "KI": 0,
                        "KR": 986,
                        "KW": 117,
                        "KG": 4,
                        "LA": 6,
                        "LV": 23,
                        "LB": 39,
                        "LS": 1,
                        "LR": 0,
                        "LY": 77,
                        "LT": 35,
                        "LU": 52,
                        "MK": 9,
                        "MG": 8,
                        "MW": 5,
                        "MY": 218,
                        "MV": 1,
                        "ML": 9,
                        "MT": 7,
                        "MR": 3,
                        "MU": 9,
                        "MX": 1004,
                        "MD": 5,
                        "MN": 5,
                        "ME": 3,
                        "MA": 91,
                        "MZ": 10,
                        "MM": 35,
                        "NA": 11,
                        "NP": 15,
                        "NL": 770,
                        "NZ": 138,
                        "NI": 6,
                        "NE": 5,
                        "NG": 206,
                        "NO": 413,
                        "OM": 53,
                        "PK": 174,
                        "PA": 27,
                        "PG": 8,
                        "PY": 17,
                        "PE": 153,
                        "PH": 189,
                        "PL": 438,
                        "PT": 223,
                        "QA": 126,
                        "RO": 158,
                        "RU": 1476,
                        "RW": 5,
                        "WS": 0,
                        "ST": 0,
                        "SA": 434,
                        "SN": 12,
                        "RS": 38,
                        "SC": 0,
                        "SL": 1,
                        "SG": 217,
                        "SK": 86,
                        "SI": 46,
                        "SB": 0,
                        "ZA": 354,
                        "ES": 1374,
                        "LK": 48,
                        "KN": 0,
                        "LC": 1,
                        "VC": 0,
                        "SD": 65,
                        "SR": 3,
                        "SZ": 3,
                        "SE": 444,
                        "CH": 522,
                        "SY": 59,
                        "TW": 426,
                        "TJ": 5,
                        "TZ": 22,
                        "TH": 312,
                        "TL": 0,
                        "TG": 3,
                        "TO": 0,
                        "TT": 21,
                        "TN": 43,
                        "TR": 729,
                        "TM": 0,
                        "UG": 17,
                        "UA": 136,
                        "AE": 239,
                        "GB": 2258,
                        "US": 4624,
                        "UY": 40,
                        "UZ": 37,
                        "VU": 0,
                        "VE": 285,
                        "VN": 101,
                        "YE": 30,
                        "ZM": 15,
                        "ZW": 5
                    },
                },
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });
        // @formatter:off
    </script>


    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {

            var commets = $("#commets").val();
            var taxs = $("#taxs").val();
            var views = $("#views").val();
            var likes = $("#likes").val();
            var deslikes = $("#deslikes").val();
            // console.log('tax' + taxs)
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
                chart: {
                    type: "donut",
                    fontFamily: 'inherit',
                    height: 240,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                fill: {
                    opacity: 1,
                },
                series: [parseInt(taxs), parseInt(views), parseInt(likes), parseInt(deslikes)],
                labels: ["<i class='fas fa-taxi text-warning'> </i> Taxes",
                    " <i class='fas fa-eye text-primary'> </i>views",
                    "<i class='feather icon-thumbs-up text-success'> </i>like",
                    "<i class='feather icon-thumbs-down text-danger'> </i>deslike"
                ],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                colors: [tabler.getColor("warning"), tabler.getColor("primary"), tabler.getColor(
                    "success"), tabler.getColor("danger")],
                legend: {
                    show: true,
                    position: 'bottom',
                    offsetY: 10,
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 100,
                    },
                    itemMargin: {
                        horizontal: 12,
                        vertical: 8
                    },
                },
                tooltip: {
                    fillSeriesColor: false
                },
            })).render();
        });
        // @formatter:on
    </script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrmTR6p6INZFKzJ1V-Lvjwt6N2GMdT-_A&libraries=geometry"></script>
    
  <script>
        function initMap() {
            var array_js = <?php echo json_encode($newArray, JSON_PRETTY_PRINT); ?>;
            var tax = <?php echo json_encode($tax); ?>;
            var  last_time =  <?php echo json_encode($last_time); ?>;

            let map = new google.maps.Map(document.getElementById('map'), {
                center: array_js[0],
                zoom: 12,
                styles: [{
                        featureType: "administrative",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#ff0000",
                        }, ],
                    },
                    {
                        featureType: "poi",
                        stylers: [{
                            visibility: "off",
                        }, ],
                    },
                ],
            });

            // Minhas coordenadas
            let path = array_js;


            let polyline = new google.maps.Polyline({
                path: [],
                geodesic: true,
                strokeColor: null,
                strokeOpacity: null,
                strokeWeight: 0,
                map: map
            });


            let i = 0;
            let brand = '';
            let category = '';
            let registration = '';
            let get_last_time= '';
            function markerAndPolyline() {


                if (tax[i - 1]) {
                    brand = tax[i - 1].brand
                    category = tax[i - 1].category
                    registration = tax[i - 1].registration
                    get_last_time = last_time[i-1]
                    // registration
                } else {
                    console.log(false)
                }



                let marker = new google.maps.Marker({
                    position: path[0],
                    map: map,
                    title: brand + ' ' + category + ' - ' + registration,
                    icon: {
                        url: "<?= base_url() ?>public/img/taxi.png",
                        scaledSize: new google.maps.Size(48, 48)
                    },
                });


                var contentString = '<div id="content">' +
                    '<div id="siteNotice">' +
                    '</div>' +
                    '<h1 id="firstHeading" class="firstHeading"><i class="fas fa-taxi text-warning"> </i>   ' + brand + ' ' + category +
                    '</h1><div id="bodyContent">' +
                    '<p>  Matricula <b class="text-uppercase">' + registration + '</b>.</p>' +
                    '<p>    <b> Visto ' +  get_last_time + '</b>.</p>' +
                    '</div>' +
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
                if (i < path.length) {

                    marker.setPosition(path[i]);
                    map.setCenter(marker.getPosition(path[i]));


                    let pathSlice = path.slice(0, i + 1);
                    polyline.setPath(pathSlice);

                    i++;
                    setTimeout(markerAndPolyline, -2000);
                }
            }

            markerAndPolyline();
        }


        // ------------------------------------------------------
    </script>





    <!-- <script>
        function initMap() {
            var array_js = <?php echo json_encode($newArray, JSON_PRETTY_PRINT); ?>;

            console.log(array_js);
            let map = new google.maps.Map(document.getElementById('map'), {
                center: array_js[0],
                zoom: 15
            });

            // Minhas coordenadas
            let path = array_js;


            let polyline = new google.maps.Polyline({
                path: [],
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 2.0,
                strokeWeight: 4,
                map: map
            });



            
            let marker = new google.maps.Marker({
                position: path[0],
                map: map,
                title: 'Marker',
               
            });

            let i = 0;

            function markerAndPolyline() {
                if (i < path.length) {

                    marker.setPosition(path[i]);
                    map.setCenter(marker.getPosition(path[i]));


                    let pathSlice = path.slice(0, i + 1);
                    polyline.setPath(pathSlice);

                    i++;
                    setTimeout(markerAndPolyline, -20000);
                }
            }

            markerAndPolyline();
        }
    </script> -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRYdEsPt5fVLOUXMwm3OGJpsm9RNqT-Sk&loading=async&libraries=places&callback=initMap&region=MZ" defer></script> -->