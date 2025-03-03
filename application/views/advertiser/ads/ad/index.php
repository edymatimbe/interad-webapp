<?php

use Faker\Core\Number;

$this->load->view('layout/public/header'); ?>
<link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
<?php $user = $this->core_model->get_by_id('users', array('id' => $this->ion_auth->get_user_id())) ?>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Anucnio de Caro para publicidade
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->



    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <?php
    $newArray = [];
    $tax = [];
    $details = [];
    $last_time = [];



    foreach (get_all('controller_tax', ['controller_id ' => $controller_id, 'tax_id !=' => null]) as $item) {

        if (!empty($item->location)) {
            $array = unserialize($item->location);
            // arsort($array);
            foreach ($array as $location) {
                $last_array = $location;
            }
            $newArray[] = $last_array;
            $details[] = $this->setting_model->controller_tax(['controller_tax.tax_id' => $item->tax_id, 'controller_tax.controller_id' => $campaign_details->controller_id]);
            $last_time[] = formatDateTimeToRelative($item->updated_at);
            $tax[] =  $this->setting_model->get_tax(['tax.id' => $item->tax_id]);
        }
    }





    // echo "<pre>";
    // print_r($details);


    // echo "</pre>";
    ?>

    <div class="page-body">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Titulo : <?= $campaign_details->title ?> </h3>

                            <video width="400" controls class="card-img-top video-js" id="my-video" controls preload="auto" width="640" height="264" data-setup='{}'>
                                <source src="<?= base_url($campaign_details->path) ?>" type="application/x-mpegURL">
                                Your browser does not support HTML video.
                            </video>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="row mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader text-primary">VisualizaçÕes</div>
                                    <div class="ms-auto lh-1">
                                        <i class="feather icon-eye h1 text-primary"></i>
                                    </div>

                                </div>
                                <div class="h1 mb-3"><?= $avaliation->views ?></div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader text-warning">Taxes</div>
                                    <div class="ms-auto lh-1">
                                        <i class="fas fa-taxi h1 text-warning"></i>
                                    </div>

                                </div>
                                <div class="h1 mb-3"><?= $avaliation->total_tax ?></div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader text-success">Like</div>
                                    <div class="ms-auto lh-1">
                                        <i class="fas fa-thumbs-up h1 text-success"></i>
                                    </div>

                                </div>
                                <div class="h1 mb-3"><?= $avaliation->likes ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader text-danger">Deslike</div>
                                    <div class="ms-auto lh-1">
                                        <i class="fas fa-thumbs-down h1 text-danger"></i>
                                    </div>

                                </div>
                                <div class="h1 mb-3"><?= $avaliation->deslikes ?></div>
                            </div>
                        </div>
                    </div>




                </div>


                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Ultimas localizações</h3>
                            <div class="ratio ratio-21x9">
                                <div>
                                    <!-- <div id="map-world" class="w-100 h-100"></div> -->
                                    <div id="map" class="w-100 h-100"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/public/footer'); ?>
    <script>
        function showMaps(controller_id, tax_id) {
            // console.log(id)
            $.ajax({
                url: "<?= base_url('public/advertiser/get_map') ?>",
                type: 'POST',
                data: {
                    controller_id,
                    tax_id
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
                    $('.modal-full-width').html(data);
                    $('#modal-full-width').modal('show')
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            $(".home-page").addClass("active")
        });
    </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrmTR6p6INZFKzJ1V-Lvjwt6N2GMdT-_A&libraries=geometry"></script>
   <script>
        function initMap() {
            var array_js = <?php echo json_encode($newArray, JSON_PRETTY_PRINT); ?>;
            var tax = <?php echo json_encode($tax, JSON_PRETTY_PRINT); ?>;

            var details = <?php echo json_encode($details); ?>;
            var last_time = <?php echo json_encode($last_time); ?>;
            var controller_id = <?php echo json_encode($controller_id); ?>;

            console.log(controller_id)






            // console.log(array_js);
            let map = new google.maps.Map(document.getElementById('map'), {
                center: array_js[0],
                zoom: 12
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


            let likes = '';
            let deslikes = '';
            let views = '';
            let tax_id = '';

            let get_last_time = '';

            function markerAndPolyline() {


                if (tax[i - 1]) {
                    brand = tax[i - 1].brand
                    tax_id = tax[i - 1].tax_id
                    category = tax[i - 1].category
                    registration = tax[i - 1].registration
                    likes = details[i - 1].likes
                    deslikes = details[i - 1].deslikes
                    views = details[i - 1].views
                    // details
                    get_last_time = last_time[i - 1]
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
                    '<p> Visualização  <i class="feather icon-eye text-primary"> </i> <b>' + views + '</b>.</p>' +
                    '<p> likes  <i class="fas fa-thumbs-up text-success"> </i> <b>' + likes + '</b>.</p>' +
                    '<p> Deslikes  <i class="fas fa-thumbs-down text-danger"> </i> <b>' + deslikes + '</b>.</p>' +
                    '<p>  Matricula  <b class="text-uppercase">' + registration + '</b>.</p>' +
                    '<p>    <b> Visto ' + get_last_time + '</b>.</p>' +
                    ' <button class="btn btn-primary" onclick="showMaps(' + controller_id + ',' + tax_id + ')"> ver rotas</button>' +
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