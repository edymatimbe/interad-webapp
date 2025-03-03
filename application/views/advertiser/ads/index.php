<?php $this->load->view('layout/public/header'); ?>
<link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="col-12">
                <div class="card mb-2 shadow">
                    <div class="card-header">
                        <h3 class="card-title"> Minhas publicidades</h3>
                    </div>

                </div>
            </div>
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="text-muted mt-1 pl-2 "> <?= count(get_all('banner', ['created_by' => $this->ion_auth->get_user_id()])) ?> Publicidade(s)</div>
                </div>
                <style>
                    #map {
                        height: 400px;
                        width: 100%;
                    }
                </style>
                <?php
                // $newArray = [];

                // if (!empty($location)) {
                //     foreach (unserialize($location->location) as $item) {
                //         $newArray[] = $item;
                //     }
                // }


                ?>
                <?php '' //echo json_encode($newArray, JSON_PRETTY_PRINT); 
                ?>
                <!-- <div id="map"></div> -->
                <?php
                // $array = $this->setting_model->campaign();
                // // $array = $this->setting_model->campaign(['controller_tax.controller_id'=>1]);
                // echo "<pre>";
                // // print_r(unserialize($array[1]->location));
                // // print_r($array[1]->location);
                // // print_r($array[1]);
                // print_r($array);
                // echo "</pre>";
                ?>

                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="input-icon">
                                <input type="text" id="search" value="" class="form-control" placeholder="Search…">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-3 me-3">
                            <select class="form-select" id="status_id">
                                <option value="">Selecione estado</option>
                                <option value="pago">Pago</option>
                                <option value="pendente">Pendente</option>
                                <option value="expirou">Vencida</option>
                            </select>
                        </div>
                        <a href="<?= base_url('new-ads') ?>" class="btn btn-primary ">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Adicionar campanha
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body" id="div-render">
        <?php $this->load->view('advertiser/ads/_cards'); ?>
    </div>

</div>
<?php $this->load->view('layout/public/footer'); ?>
<!-- 
<script>
    var array_js = <?php echo json_encode($newArray, JSON_PRETTY_PRINT); ?>;

    console.log(array_js[0]);

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: array_js[0] // Center the map on a specific location
        });

        // Retrieve route data from your database
        // var routeCoordinates = [
        //     {lat: 37.772, lng: -122.214}, // Example coordinates, replace with your data
        //     {lat: 21.291, lng: -157.821},
        //     {lat: -18.142, lng: 178.431},
        //     {lat: -27.467, lng: 153.027}
        //     // Add more coordinates as needed
        // ];


        // Retrieve route data from your database
        var routeCoordinates = array_js;

        // Construct the polyline.
        var route = new google.maps.Polyline({
            path: routeCoordinates,
            geodesic: true,
            strokeColor: '#FF0000', // Line color
            strokeOpacity: 1.0,
            strokeWeight: 2 // Line thickness
        });

        // Set the polyline on the map
        route.setMap(map);
    }
</script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrmTR6p6INZFKzJ1V-Lvjwt6N2GMdT-_A&libraries=geometry"></script>
<script>
    $('input#search').on('input', function(e) {
        get_filter();

    });

    $("#status_id").on("change", function() {
        get_filter();
    });



    function get_filter() {
        $.ajax({
            url: "<?= base_url('public/advertiser/filter_cards') ?>",
            type: 'POST',
            data: {
                search:  $('input#search').val(),
                status_id:  $('#status_id').val(),
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data)
                $('#div-render').html(data.data)
            }
        })
    }
</script>