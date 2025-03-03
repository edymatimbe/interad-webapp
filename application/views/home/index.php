<?php $this->load->view('layout/header') ?>
<style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
<?php


$newArray = [];
$tax = [];
$lat_time =  [];

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

    // echo "<pre>";
    // print_r($tax);
    // echo "</pre>";

  
}

// echo  $howTime;
// echo formatDateTimeToRelative( $howTime)
?>
<!-- [ Main Content ] start -->
<div class="row">
    <!-- page statustic card start -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-blue"><?= $ads = count(get_all('controller')) ?></h4>
                        <h6 class="text-muted m-b-0">Total de campanhas</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-bar-chart-2 f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-blue">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">100% </p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-yellow"> <?= $pendente_ads = count(get_all('controller', ['status' => 'pendente'])) ?></h4>
                        <h6 class="text-muted m-b-0">Campanhas pendentes</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-bar-chart-2 f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-yellow">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0"> <?= $ads == 0 ? number_format(0, 2) : number_format((float)100 * $pendente_ads / $ads, 2, '.', '') ?>% change</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-green"><?= $active_ads = count(get_all('controller', ['status' => 'pago'])) ?></h4>
                        <h6 class="text-muted m-b-0">Campanhas pagas</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-bar-chart-2 f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-green">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0"> <?= $ads == 0 ? number_format(0, 2) : number_format((float)100 * $active_ads / $ads, 2, '.', '') ?></p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-red"> <?= $expiry_ads = count(get_all('controller', ['status' => 'expirou', 'controller.created_by' => $this->ion_auth->get_user_id()])) ?></h4>
                        <h6 class="text-muted m-b-0">Campanhas vencidas</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-bar-chart-2 f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-red">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0"> <?= $ads == 0 ? number_format(0, 2) : number_format((float)100 *  $expiry_ads / $ads, 2, '.', '') ?>% </p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- page statustic card end -->
    <!-- Realtime Data of Visits end -->
    <div class="col-xl-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Histórico de campanhas</h3>
                <div id="chart-combination"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card  bg-c-green text-white widget-visitor-card">
            <div class="card-body text-center">
                <h2 class="text-white"><?= count(get_all('tax')) ?></h2>
                <h6 class="text-white">Taxes</h6>
                <strong class="h4"><?= count(get_all('tax', ['active' => 1])) ?> Activos</strong> | <strong class="h4"><?= count(get_all('tax', ['active' => 0])) ?> Inactivos</strong>
                <i class="fas fa-car-side ml-5 mb-3 text-white"></i>
            </div>
        </div>
        <div class="card bg-c-blue text-white widget-visitor-card">
            <div class="card-body text-center">
                <h2 class="text-white"><?= count(get_all('users_groups', ['group_id' => 3])) ?></h2>
                <h6 class="text-white">Anunciantes</h6>
                <strong class="h4"><?= count(get_all('users_groups', ['group_id' => 3, 'active' => 1])) ?> Activos</strong> | <strong class="h4"><?= count(get_all('users_groups', ['group_id' => 3, 'active' => 0])) ?> Inactivos</strong>
                <i class="feather icon-user-check  ml-5 mb-3"></i>
            </div>
        </div>
    </div>
    <!-- Realtime Data of Visits end -->
    <!-- Traffic-section start -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Locations</h3>
                <div>  
                    
                        <div id="map" class="col-lg-12"></div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Traffic-section end -->

</div>
<!-- [ Main Content ] end -->

<!-- Libs JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRYdEsPt5fVLOUXMwm3OGJpsm9RNqT-Sk&loading=async&libraries=places&callback=initMap&region=MZ" defer></script>
<script src="<?= base_url(); ?>public/assets/web/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
<script src="<?= base_url(); ?>public/assets/web/dist/js/tabler.min.js?1684106062" defer></script>
<script src="<?= base_url(); ?>public/assets/web/dist/js/demo.min.js?1684106062" defer></script>


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

        $.ajax({
            url: "<?= base_url('home/get_chart') ?>",
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
               

                window.ApexCharts && (new ApexCharts(document.getElementById('chart-combination'), {
                    chart: {
                        type: "bar",
                        fontFamily: 'inherit',
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: true,
                        },
                        animations: {
                            enabled: true
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: true,
                    },
                    fill: {
                        opacity: 2,
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
                            enabled: true
                        },
                        axisBorder: {
                            show: true,
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
                    colors: ['#f5d608', '#07951a', '#fa110a'],
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
    function initMap() {
     
        var array_js = <?php echo json_encode($newArray, JSON_PRETTY_PRINT); ?>;
        var tax = <?php echo json_encode($tax); ?>;

        var  last_time =  <?php echo json_encode($last_time); ?>;

        // console.log(last_time[0])
        let map = new google.maps.Map(document.getElementById('map'), {
            center: array_js[0],
            zoom: 14,
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
                // console.log(get_last_time)
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
                '<h1 id="firstHeading" class="firstHeading h5"><i class="fas fa-taxi text-warning "> </i>   ' + brand + ' ' + category +
                '</h1><div id="bodyContent">' +
                '<p>  Matricula  <b class="text-uppercase">' + registration + '</b>.</p>' +
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
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRYdEsPt5fVLOUXMwm3OGJpsm9RNqT-Sk&loading=async&libraries=places&callback=initMap&region=MZ" defer></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrmTR6p6INZFKzJ1V-Lvjwt6N2GMdT-_A&callback=initMap">
</script>
<script>
    $(document).ready(function() {
        $('#menu-dashboard').addClass('active pcoded-trigger');
        $('#menu-dashboard .principal').addClass('active');
        $('#menu-dashboard .pcoded-submenu').css('display', 'block');
    })
</script>

<?php $this->load->view('layout/footer') ?>