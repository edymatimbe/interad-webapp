<?php $this->load->view('layout/public/header'); ?>
<style>
    .bar {
        background-color: #ac4850
    }

    .percent {
        position: absolute;
        color: rgb(254, 254, 254);
        left: 50%;
        margin-top: 0.7rem;
        font-size: 1rem;
    }

    .progress {
        height: 30px;
    }

    .marker-label {
        padding-top: 40px;
    }
</style>

<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col-md-6 col-lg-4">
                    <h2 class="page-title">
                        Adiconar campanha
                    </h2>
                </div>
                <div class="col-md-6 col-lg-8">
                    <a href="#" class="card card-link card-link-rotate   bg-purple text-purple-fg" data-demo-color>
                        <h2 class="card-body pt-4 pb-2 row"><i class="feather icon-shopping-cart col-6"></i><strong class="col-6 text-end bold total_cost">0.00 MT</strong>
                        </h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <form id="form-ads" method="post" class="card" enctype="multipart/form-data">
                        <input type="hidden" value="" name="cost" id="cost">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 border-right">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-12 ">
                                            <div class="mb-3">
                                                <label class="form-label">Titulo <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="title" placeholder="Titulo da campanha">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Quantidade de taxes <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control advertising_costs" value="1" min="1" id="count_tax" name="count_tax" placeholder="Quantidade carros na campanha">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Descrição <span class="form-label-description">1/100</span></label>
                                                <textarea class="form-control" name="description" rows="10" placeholder="Descrição da campanha.."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8  border-left">
                                    <div class="row">
                                        <div class="col-md-8 col-lg-8">
                                            <div class="mb-3">
                                                <div class="form-label">Carregar video <span class="text-danger">*</span></div>
                                                <!-- <input type="file" id="fileUp" name="fileUpload" class="form-control upload" /> -->
                                                <input type="file" class="form-control" id="fileUp" name="fileUpload" />

                                            </div>


                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="mb-3">
                                                <div class="form-label">Duração do video <span class="text-danger">*</span></div>
                                                <input type="text" id="video_duration" name="video_duration" class="form-control bg-light advertising_costs" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Data inicial <span class="text-danger">*</span></label>
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                            <path d="M16 3v4" />
                                                            <path d="M8 3v4" />
                                                            <path d="M4 11h16" />
                                                            <path d="M11 15h1" />
                                                            <path d="M12 15v3" />
                                                        </svg>
                                                    </span>
                                                    <input class="form-control init_date get_last_date" name="init_date" placeholder="Select a date" id="datepicker-icon-prepend" value="<?= date('Y-m-d') ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="mb-3">
                                                <div class="form-label">Periodicidade (7 - 180 dias) <span class="text-danger">*</span></div>
                                                <input type="number" id="periodicity" name="periodicity" max="180" min="1" maxlength="3" name="initdate" class="form-control advertising_costs get_last_date" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Data final<span class="text-danger">*</span></label>
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                            <path d="M16 3v4" />
                                                            <path d="M8 3v4" />
                                                            <path d="M4 11h16" />
                                                            <path d="M11 15h1" />
                                                            <path d="M12 15v3" />
                                                        </svg>
                                                    </span>
                                                    <input class="form-control bg-light end_date" placeholder="Select a date" id="datepicker-icon-prepend" name="final_date" value="<?= date('Y-m-d') ?>" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-12">
                                            <!-- LOCATION  -->
                                            <h3>
                                                <?php $setting = $this->core_model->get_setting() ?>
                                                <input type="hidden" id="multiplier" name="multiplier" value="<?= $setting->multiplier ?>">
                                                <input type="hidden" id="coordinates" name="coordinates" value="">
                                                <input type="hidden" id="area_location" name="area_location" value="">
                                            </h3>
                                            <label class="form-label">Onde o meu anuncio deve passar </label>
                                            <select class="form-select mb-3" id="shapeSelector" name="district">
                                                <option>Seect</option>
                                                <option value="kampfumu">Kampfumu</option>
                                                <option value="nhlamankulo">Nhlamankulo</option>
                                                <option value="kamaxakeni">Kamaxakeni</option>
                                                <option value="kamavota">Kamavota</option>
                                                <option value="kamubukuana">Kamubukuana</option>
                                                       
                                            </select>
                                            <div id="map" style="height: 400px; width: 100%;"></div>
                                        </div>

                                    </div>

                                </div>
                                <div class="progress mb-3">
                                    <div class="bar"></div>
                                    <div class="percent">0%</div>
                                </div>
                            </div>
                            <div class="card-footer text-end">

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-success ms-auto btn-square "> <i class="feather icon-save"></i>&nbsp; &nbsp; Salvar a campanha</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/public/footer'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrmTR6p6INZFKzJ1V-Lvjwt6N2GMdT-_A&libraries=geometry"></script>
    <script>
        function quotation() {

            let periodicity = $("#periodicity").val()
            let multiplier = $("#multiplier").val()
            let count_tax = $("#count_tax").val()
            let video_duration = $("#video_duration").val()
            let video_amount = minuteConverter($("#video_duration").val())


            if (periodicity && multiplier && count_tax && video_duration) {
                $.ajax({
                    url: "<?= base_url('public/advertiser/get_quotaion') ?>",
                    type: 'POST',
                    data: {
                        periodicity,
                        multiplier,
                        count_tax,
                        video_duration,
                        video_amount
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data)
                        $('.modal-full-width').html(data);
                        $('#modal-full-width').modal('show')
                    }
                })
            } else {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "Porfavor preecha todos campos",
                    showConfirmButton: false,
                    timer: 2000
                });
            }



        }

        var myVideos = [];
        window.URL = window.URL || window.webkitURL;
        document.getElementById('fileUp').onchange = setFileInfo;

        function setFileInfo() {
            var files = this.files;
            myVideos.push(files[0]);
            var video = document.createElement('video');
            video.preload = 'metadata';

            video.onloadedmetadata = function() {
                window.URL.revokeObjectURL(video.src);
                var duration = video.duration;
                myVideos[myVideos.length - 1].duration = duration;
                updateInfos();
            }

            video.src = URL.createObjectURL(files[0]);;
        }


        function updateInfos() {
            // infos.textContent = "";
            for (var i = 0; i < myVideos.length; i++) {


                let seconds = myVideos[i].duration;
                let minutes = Math.floor(seconds / 60);
                let extraSeconds = seconds % 60;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                extraSeconds = extraSeconds < 10 ? "0" + extraSeconds : extraSeconds;
                $("#video_duration").val(minutes + " : " + Math.round(extraSeconds))

            }
        }

        function last_date() {
            // alert('aaaaaaaaaa')

            $.ajax({
                url: "<?= base_url('public/advertiser/get_last_date') ?>",
                type: 'POST',
                data: {
                    periodicity: $("#periodicity").val(),
                    init_date: $('.init_date').val()
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
                    $(".end_date").val(data);
                }
            })
        }
        $('.get_last_date').on('input', function(e) {
            last_date()
        });

        function minuteConverter(time) {
            const [h, m] = time.split(':');
            const value = +h + +m / 60;
            return value.toFixed(2);
        }




        $('.advertising_costs').on('input', function(e) {
            Number.prototype.format = function(n, x) {
                var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
                return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
            };
            let periodicity = $("#periodicity").val()
            let multiplier = $("#multiplier").val()
            let count_tax = $("#count_tax").val()

            let video_duration = minuteConverter($("#video_duration").val())


            let total = periodicity * video_duration * multiplier * count_tax

            // console.log(minuteConverter($("#video_duration").val()))
            $(".total_cost").html('<strong>' + total.format(2) + ' MT</strong>')
            $('#cost').val(total)
        });

        $(document).ready(function() {
            var bar = $('.bar');
            var percent = $('.percent');
            var progress = $('#progress');
            var submit = $('#submit');


            $('#form-ads').ajaxForm({
                url: "<?= base_url('public/advertiser/save') ?>",
                type: 'POST',
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    var percentage = '0%';
                    bar.width(percentage);
                    percent.html(percentage);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentage = percentComplete + '%';
                    bar.width(percentage);
                    percent.html(percentage);
                },
                success: function(data) {
                    console.log(data)
                    if (data.status.toString() === 'error_validation') {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: 'Erro de validação',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setErrorValidation(data);
                    }

                    if (data.status.toString() === 'error') {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                    if (data.status.toString() === 'success') {
                        Swal.fire({
                            title: "Sucesso",
                            text: "Salva com sucesso, efetue o pagamento para ativar a campanha.",
                            icon: "success"
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '<?= base_url('profile-billing') ?>';
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Erro",
                        text: "Ocorreu um erro ao salvar a factura. Por favor, tente novamente.",
                        icon: "error"
                    });
                },
                complete: function() {
                    // Swal.fire({
                    //     title: "Salvar a factura?",
                    //     text: "Após apresentar o recibo da factura a sua campanha será publicada.",
                    //     icon: "warning",
                    //     showCancelButton: true,
                    //     confirmButtonColor: "#6fc242",
                    //     cancelButtonColor: "#d33",
                    //     confirmButtonText: "Sim, salvar a factura!",
                    // });
                }
            });

            // $('#form-ads').ajaxForm({
            //     url: "<?= base_url('public/advertiser/save') ?>",
            //     type: 'POST',
            //     dataType: "JSON",
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     beforeSend: function() {
            //         var percentage = '0%';
            //         bar.width(percentage);
            //         percent.html(percentage)
            //     },
            //     uploadProgress: function(event, position, total, percentComplete) {
            //         var percentage = percentComplete + '%';
            //         bar.width(percentage);
            //         percent.html(percentage)
            //     },
            //     success: function(data) {
            //         if (data.status.toString() === 'error_validation') {
            //             setErrorValidation(data)
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.log(JSON.stringify(error))
            //     },

            //     complete: function() {
            //         Swal.fire({
            //             title: "Salvar a factura?",
            //             text: "Após apresentar o recibo da factura a sua campanha será publicada ",
            //             icon: "warning",
            //             showCancelButton: true,
            //             confirmButtonColor: "#6fc242",
            //             cancelButtonColor: "#d33",
            //             confirmButtonText: "Sim, salvar a factura!",
            //         }).then(() => {
            //             Swal.fire({
            //                 title: "sucesso",
            //                 text: "Factua salva com sucesso, efectue o pagamento para activar a campanha.",
            //                 icon: "success"
            //             }).then((result) => {
            //                 window.location.href = '<?= base_url('profile-billing') ?>'
            //             });
            //         });
            //     }
            // });
            // });






            function getAllData() {
                $.ajax({
                    url: "<?= base_url('department/getAll') ?>",
                    type: 'GET',
                    success: function(data) {
                        reDrawTable(data)
                    },
                });
            }

        });
    </script>
    <script>
        var map;
        var polygon;
        var labelText;
        var marker;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -25.943004384824953,
                    lng: 32.573306900354325
                },
                zoom: 12,
                disableDefaultUI: true,
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

            // Define some initial polygon paths (in this case, a polygon covering India)


            // Draw initial polygon
            polygon = new google.maps.Polygon({
                paths: [],
                strokeWeigth: 0.1,
                strokeOpacity: 0.1,
                fillColor: "#f00",
                map: map,
                geodesic: true,
            });

            marker = new google.maps.Marker({
                position: null,
                fillColor: "#f00",
                icon: {
                    url: "https://www.svgrepo.com/show/370282/location-circle.svg",
                    scaledSize: new google.maps.Size(32, 32)
                },
                label: {
                    text: 'Kampfumo',
                    color: 'black',
                    fontSize: '24px',
                    fontWeight: 'bold',
                    className: 'marker-label'
                },
                map: map
            })


            map.addListener('click', function(e) {
                console.log(JSON.stringify(e.latLng));
            })

            polygon.addListener('click', function() {
                polygon.setPaths([]);
                marker.setPosition(null)
            })

            marker.addListener('drag', function() {
                var markerPosition = marker.getPosition();
                if (google.maps.geometry.poly.containsLocation(markerPosition, polygon)) {
                    alert("INside Polygon");
                }
            });

            // Add event listener to select element
            document.getElementById('shapeSelector').addEventListener('change', changePolygonShape);
        }

        function changePolygonShape() {
            var selectedShape = document.getElementById('shapeSelector').value;
            var paths = [];
            var position;

            if (selectedShape === 'kampfumu') {

                paths = [{
                        lat: -25.958555430519105,
                        lng: 32.56133351931185
                    },
                    {
                        lat: -25.956857649498836,
                        lng: 32.56545339235873
                    },
                    {
                        lat: -25.956317441310922,
                        lng: 32.570259910913414
                    },
                    {
                        lat: -25.956934821894695,
                        lng: 32.57403646120638
                    },
                    {
                        lat: -25.956857649498836,
                        lng: 32.57583890566439
                    },
                    {
                        lat: -25.94736505896222,
                        lng: 32.57841382631869
                    },
                    {
                        lat: -25.95068369389344,
                        lng: 32.584593635889
                    },
                    {
                        lat: -25.95387733082926,
                        lng: 32.58896827697754
                    },
                    {
                        lat: -25.94883144407085,
                        lng: 32.591975075097984
                    },
                    {
                        lat: -25.947210701572658,
                        lng: 32.599957329126305
                    },
                    {
                        lat: -25.948985799335713,
                        lng: 32.60665212282748
                    },
                    {
                        lat: -25.944586594991524,
                        lng: 32.60776792177767
                    },
                    {
                        lat: -25.94489531644791,
                        lng: 32.61248860964388
                    },
                    {
                        lat: -25.94914015439823,
                        lng: 32.61763845095248
                    },
                    {
                        lat: -25.95361636318156,
                        lng: 32.61283193239779
                    },
                    {
                        lat: -25.9573978552073,
                        lng: 32.608712059350914
                    },
                    {
                        lat: -25.96125639530205,
                        lng: 32.605193001123375
                    },
                    {
                        lat: -25.96488330763415,
                        lng: 32.602703911157555
                    },
                    {
                        lat: -25.9819360134407,
                        lng: 32.59489331850619
                    },
                    {
                        lat: -25.978261906664557,
                        lng: 32.59566307067871
                    },
                    {
                        lat: -25.98371058736764,
                        lng: 32.59429250368685
                    },
                    {
                        lat: -25.98425066976767,
                        lng: 32.59180341372103
                    },
                    {
                        lat: -25.98425066976767,
                        lng: 32.58905683168978
                    },
                    {
                        lat: -25.98170454530153,
                        lng: 32.58364949831576
                    },
                    {
                        lat: -25.97368003476556,
                        lng: 32.572234016748375
                    },
                    {
                        lat: -25.9715489358788,
                        lng: 32.56527900695801
                    },
                    {
                        lat: -25.961102056127284,
                        lng: 32.55592618593783
                    },
                    {
                        lat: -25.958555430519105,
                        lng: 32.56141935000033
                    }
                ]

                position = {
                    lat: -25.960600452411278,
                    lng: 32.586696487756676
                }

            } else if (selectedShape === 'nhlamankulo') {

                paths = [{
                        lat: -25.959862484173605,
                        lng: 32.5581143681684
                    },
                    {
                        lat: -25.956158244238026,
                        lng: 32.5529645268598
                    },
                    {
                        lat: -25.951759307897042,
                        lng: 32.546956378666444
                    },
                    {
                        lat: -25.948131991123066,
                        lng: 32.540948230473084
                    },
                    {
                        lat: -25.945816624113856,
                        lng: 32.53880246326117
                    },
                    {
                        lat: -25.943964297727288,
                        lng: 32.53802998706488
                    },
                    {
                        lat: -25.941957577929973,
                        lng: 32.53777249499945
                    },
                    {
                        lat: -25.94388711682889,
                        lng: 32.54077656909613
                    },
                    {
                        lat: -25.93709499970163,
                        lng: 32.54798634692816
                    },
                    {
                        lat: -25.931691899587737,
                        lng: 32.553393680302186
                    },
                    {
                        lat: -25.928063964765098,
                        lng: 32.55648358508734
                    },
                    {
                        lat: -25.92320081311089,
                        lng: 32.56077511951117
                    },
                    {
                        lat: -25.920344582899116,
                        lng: 32.56377919360785
                    },
                    {
                        lat: -25.923741173203695,
                        lng: 32.561633426395936
                    },
                    {
                        lat: -25.92675170551529,
                        lng: 32.560689288822694
                    },
                    {
                        lat: -25.929221828439257,
                        lng: 32.56154759570746
                    },
                    {
                        lat: -25.929684970723546,
                        lng: 32.564122516361756
                    },
                    {
                        lat: -25.930456870485653,
                        lng: 32.573392230717225
                    },
                    {
                        lat: -25.932926915745085,
                        lng: 32.57485135242133
                    },
                    {
                        lat: -25.940259557549172,
                        lng: 32.5749371831098
                    },
                    {
                        lat: -25.953534337080853,
                        lng: 32.56772740527777
                    },
                    {
                        lat: -25.95584955231425,
                        lng: 32.5665257756391
                    }
                ];

                position = {
                    lat: -22.960600452411278,
                    lng: 32.586696487756676
                };


            } else if (selectedShape === 'kamavota') {
                paths = [{
                        "lat": -25.856529402957637,
                        "lng": 32.68814836153597
                    },
                    {
                        "lat": -25.84787842087262,
                        "lng": 32.6620558322391
                    },
                    {
                        "lat": -25.842934718399565,
                        "lng": 32.65244279512972
                    },
                    {
                        "lat": -25.84046278968206,
                        "lng": 32.643173080774254
                    },
                    {
                        "lat": -25.83768180813804,
                        "lng": 32.63184342989535
                    },
                    {
                        "lat": -25.8361367901475,
                        "lng": 32.62806687960238
                    },
                    {
                        "lat": -25.834591751983883,
                        "lng": 32.62429032930941
                    },
                    {
                        "lat": -25.83397373107017,
                        "lng": 32.62326036104769
                    },
                    {
                        "lat": -25.84417066338872,
                        "lng": 32.62429032930941
                    },
                    {
                        "lat": -25.850968129986047,
                        "lng": 32.62429032930941
                    },
                    {
                        "lat": -25.857456256354933,
                        "lng": 32.62085710177035
                    },
                    {
                        "lat": -25.865179752058733,
                        "lng": 32.61673722872347
                    },
                    {
                        "lat": -25.87290274303137,
                        "lng": 32.60849748262972
                    },
                    {
                        "lat": -25.879389665313614,
                        "lng": 32.602660995813316
                    },
                    {
                        "lat": -25.884331843159774,
                        "lng": 32.60060105928988
                    },
                    {
                        "lat": -25.887729470443354,
                        "lng": 32.60334764132113
                    },
                    {
                        "lat": -25.89946597596043,
                        "lng": 32.60025773653597
                    },
                    {
                        "lat": -25.907804362696673,
                        "lng": 32.596481186243004
                    },
                    {
                        "lat": -25.916142160024126,
                        "lng": 32.58961473116488
                    },
                    {
                        "lat": -25.91861250527933,
                        "lng": 32.587211471887535
                    },
                    {
                        "lat": -25.922317926110228,
                        "lng": 32.58686814913363
                    },
                    {
                        "lat": -25.922935484925272,
                        "lng": 32.58137498507113
                    },
                    {
                        "lat": -25.925628121551657,
                        "lng": 32.585105895996094
                    },
                    {
                        "lat": -25.929333321846993,
                        "lng": 32.57931504854769
                    },
                    {
                        "lat": -25.932729653113537,
                        "lng": 32.5796583713016
                    },
                    {
                        "lat": -25.932729653113537,
                        "lng": 32.58377824434847
                    },
                    {
                        "lat": -25.932112145619147,
                        "lng": 32.589958053918785
                    },
                    {
                        "lat": -25.930259603718905,
                        "lng": 32.599914413782066
                    },
                    {
                        "lat": -25.92717196916469,
                        "lng": 32.60781083712191
                    },
                    {
                        "lat": -25.92593689269211,
                        "lng": 32.619140488000816
                    },
                    {
                        "lat": -25.924701803276836,
                        "lng": 32.62600694307894
                    },
                    {
                        "lat": -25.92717196916469,
                        "lng": 32.63081346163363
                    },
                    {
                        "lat": -25.92995084390394,
                        "lng": 32.633903366418785
                    },
                    {
                        "lat": -25.927480736260485,
                        "lng": 32.63699327120394
                    },
                    {
                        "lat": -25.92099645737912,
                        "lng": 32.64351640352816
                    },
                    {
                        "lat": -25.913276612698194,
                        "lng": 32.650382858606285
                    },
                    {
                        "lat": -25.90740919272412,
                        "lng": 32.655876022668785
                    },
                    {
                        "lat": -25.887951975219778,
                        "lng": 32.66102586397738
                    },
                    {
                        "lat": -25.86880047113439,
                        "lng": 32.66720567354769
                    },
                    {
                        "lat": -25.856134061364603,
                        "lng": 32.6730421603641
                    },
                    {
                        "lat": -25.851808634972723,
                        "lng": 32.6785353244266
                    },
                ]
            } else if (selectedShape === 'kamaxakeni') {
                paths = [{
                        lat: -25.956857649498836,
                        lng: 32.56545339235873
                    },
                    {
                        lat: -25.956317441310922,
                        lng: 32.570259910913414
                    },
                    {
                        lat: -25.956934821894695,
                        lng: 32.57403646120638
                    },
                    {
                        lat: -25.956857649498836,
                        lng: 32.57583890566439
                    },
                    {
                        lat: -25.94736505896222,
                        lng: 32.57841382631869
                    },
                    {
                        lat: -25.95068369389344,
                        lng: 32.584593635889
                    },
                    {
                        lat: -25.95387733082926,
                        lng: 32.58896827697754
                    },
                    {
                        lat: -25.94883144407085,
                        lng: 32.591975075097984
                    },
                    {
                        lat: -25.947210701572658,
                        lng: 32.599957329126305
                    },
                    {
                        lat: -25.948985799335713,
                        lng: 32.60665212282748
                    },
                    {
                        lat: -25.944586594991524,
                        lng: 32.60776792177767
                    },
                    {
                        lat: -25.94489531644791,
                        lng: 32.61248860964388
                    },
                    {
                        lat: -25.94914015439823,
                        lng: 32.61763845095248
                    },
                    {
                        "lat": -25.930576025948124,
                        "lng": 32.63408795624789
                    },
                    {
                        "lat": -25.9276872493669,
                        "lng": 32.62919344132273
                    },
                    {
                        "lat": -25.92629779350012,
                        "lng": 32.62541689102976
                    },
                    {
                        "lat": -25.92614340850376,
                        "lng": 32.62009538834421
                    },
                    {
                        "lat": -25.92722409923143,
                        "lng": 32.61031068985788
                    },
                    {
                        "lat": -25.930466111955642,
                        "lng": 32.59589113419382
                    },
                    {
                        "lat": -25.931392384923104,
                        "lng": 32.59108461563913
                    },
                    {
                        "lat": -25.93370803548543,
                        "lng": 32.583531515053195
                    },
                    {
                        "lat": -25.93417116013662,
                        "lng": 32.579583303383274
                    },
                    {
                        "lat": -25.934634282967327,
                        "lng": 32.579583303383274
                    },
                    {
                        "lat": -25.92861354417735,
                        "lng": 32.57769502823679
                    },
                    {
                        "lat": -25.926915331463267,
                        "lng": 32.57700838272898
                    },
                    {
                        "lat": -25.930311732419835,
                        "lng": 32.57443346207468
                    },
                    {
                        "lat": -25.935869268282246,
                        "lng": 32.576321737221164
                    },
                    {
                        "lat": -25.942970182591832,
                        "lng": 32.57512010758249
                    },
                    {
                        "lat": -25.94652047920758,
                        "lng": 32.5728885096821
                    },
                    {
                        "lat": -25.947446625938625,
                        "lng": 32.572030202797336
                    },
                    {
                        "lat": -25.95408379765865,
                        "lng": 32.56876863663523
                    },
                    {
                        "lat": -25.957016382240734,
                        "lng": 32.56670870011179
                    },
                ]
            } else if (selectedShape === 'kamubukuana') {
                paths = [{
                        "lat": -25.93188972413666,
                        "lng": 32.51820359835238
                    },
                    {
                        "lat": -25.935903472577294,
                        "lng": 32.52369676241488
                    },
                    {
                        "lat": -25.93991708427324,
                        "lng": 32.52987657198519
                    },
                    {
                        "lat": -25.941460744664884,
                        "lng": 32.5357130588016
                    },
                    {
                        "lat": -25.943621835223933,
                        "lng": 32.539489609094566
                    },
                    {
                        "lat": -25.94485672631012,
                        "lng": 32.541549545618004
                    },
                    {
                        "lat": -25.938682141393762,
                        "lng": 32.544982773157066
                    },
                    {
                        "lat": -25.93312473822047,
                        "lng": 32.55013261446566
                    },
                    {
                        "lat": -25.927875838966354,
                        "lng": 32.554252487512535
                    },
                    {
                        "lat": -25.923553040504927,
                        "lng": 32.56008897432894
                    },
                    {
                        "lat": -25.920156444779447,
                        "lng": 32.564208847375816
                    },
                    {
                        "lat": -25.914289367117057,
                        "lng": 32.569015365930504
                    },
                    {
                        "lat": -25.901936670506768,
                        "lng": 32.57759843477816
                    },
                    {
                        "lat": -25.887729470443354,
                        "lng": 32.586181503625816
                    },
                    {
                        "lat": -25.880625229165528,
                        "lng": 32.59579454073519
                    },
                    {
                        "lat": -25.878771878540324,
                        "lng": 32.60060105928988
                    },
                    {
                        "lat": -25.871049271235155,
                        "lng": 32.609184128137535
                    },
                    {
                        "lat": -25.865488681389188,
                        "lng": 32.613647323938316
                    },
                    {
                        "lat": -25.856529402957637,
                        "lng": 32.62257371553988
                    },
                    {
                        "lat": -25.842934718399565,
                        "lng": 32.62497697481722
                    },
                    {
                        "lat": -25.834591751983883,
                        "lng": 32.62532029757113
                    },
                    {
                        "lat": -25.828102371425963,
                        "lng": 32.60151144269422
                    },
                    {
                        "lat": -25.82006740734502,
                        "lng": 32.58194204572156
                    },
                    {
                        "lat": -25.8179040546214,
                        "lng": 32.57129904035047
                    },
                    {
                        "lat": -25.820509497316017,
                        "lng": 32.5692231952455
                    },
                    {
                        "lat": -25.832252678575625,
                        "lng": 32.568536549737686
                    },
                    {
                        "lat": -25.848320406962248,
                        "lng": 32.565103322198624
                    },
                    {
                        "lat": -25.85419076331703,
                        "lng": 32.563730031183
                    },
                    {
                        "lat": -25.863459153632412,
                        "lng": 32.55995348089003
                    },
                    {
                        "lat": -25.87334463555959,
                        "lng": 32.556863576104874
                    },
                    {
                        "lat": -25.877360376337947,
                        "lng": 32.55343034856581
                    },
                    {
                        "lat": -25.89218654410821,
                        "lng": 32.54416063421034
                    },
                    {
                        "lat": -25.903304948024235,
                        "lng": 32.53901079290175
                    },
                    {
                        "lat": -25.909172572157892,
                        "lng": 32.53454759710097
                    },
                    {
                        "lat": -25.915966298602118,
                        "lng": 32.528367787530655
                    },
                    {
                        "lat": -25.921215728229427,
                        "lng": 32.5252778827455
                    },
                    {
                        "lat": -25.92769999504843,
                        "lng": 32.52150133245253
                    },
                    {
                        "lat": -25.93233139578981,
                        "lng": 32.515664845636124
                    },
                ]
            }


            marker.setPosition(position);
            polygon.setPaths(paths);
        }
    </script>