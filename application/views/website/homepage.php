<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player with Playlist</title>
    <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-playlist@5.1.0/dist/videojs-playlist.min.js"></script>
    <style>
        #mapa {
            height: 400px;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .video-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        .video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* .button-container {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
        } */

        .button-container {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            display: none;
            /* Esconde os botões por padrão */
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        #like {
            background-color: #28a745;
            color: #fff;
            margin-right: 10px;
            border-radius: 7px;
            border: 1px solid white !important;
        }

        #deslike {
            background-color: #dc3545;
            color: #fff;
            margin-left: 10px;
            border-radius: 7px;
            border: 1px solid white !important;
        }

        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            background-color: white;
            /* Cor da tela branca */
            display: none;
            z-index: 10;
            transform: translate(-50%, -50%);

            opacity: 1;

        }


        .overlay.show {
            display: block;
        }

        .logo-pop {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-image: url('public/41bc-md.png');
            background-size: contain;
            width: 50px;
            height: 50px;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            z-index: 20;
        }

        .logo-pop.fade-in {
            opacity: 5;
        }

        .logo-pop.zoom-in {
            animation: zoom-in 1s forwards;
        }

        .logo-pop.zoom-out {
            animation: zoom-out 1s forwards;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* opacity: 0; */
            /* Adjust transparency here */
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.8);
            /* Semi-transparent white background */
            margin: 0;
            /* Remove the default margin */
            padding: 20px;
            border: 1px solid #888;
            width: 100%;
            /* Make the modal content take full width */
            height: 100%;
            /* Make the modal content take full height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            /* Ensure padding doesn't affect width/height */
        }


        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .headline {
            font-size: 36px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 50px;
            line-height: 1.2;
        }

        .headline .highlight {
            background-color: black;
            color: white;
            padding: 0 10px;
            font-weight: 900;
        }

        .headline .highlight-red {
            background-color: #a52a2a;
            color: white;
            padding: 0 10px;
            font-weight: 900;
        }

        .options-container {
            display: flex;
            justify-content: center;
            gap: 70px;
        }

        .option {
            background-color: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 200px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .option:hover {
            transform: scale(1.05);
        }

        .option img {
            width: 70px;
            height: 70px;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
        }

        .option h2 {
            font-size: 24px;
            margin: 10px 0;
        }

        .option .badge {
            background-color: black;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 18px;
        }

        .d-none {
            display: none;
        }

        @keyframes zoom-in {
            from {
                transform: translate(-50%, -50%) scale(0);
            }

            to {
                transform: translate(-50%, -50%) scale(1);
            }
        }

        @keyframes zoom-out {
            from {
                transform: translate(-50%, -50%) scale(1);
            }

            to {
                transform: translate(-50%, -50%) scale(0);
            }
        }
    </style>
</head>

<body>
    <div id="mapa" class=""></div>
    <div id="distrito-atual" class="my-5"></div>
    <div class="video-container">
        <video id="videoPlayer" class="video-js vjs-default-skin video" preload="auto" data-setup='{}'></video>
    </div>
    <div class="button-container">
        <button id="like" class="btn">
            <i class="feather icon-thumbs-up"></i>
            Like
        </button>
        <button id="deslike" class="btn">Deslike</button>
    </div>
    <div class="overlay"></div>
    <div class="logo-pop"></div>
    <input type="hidden" id="baseURL" value="<?= base_url() ?>">
    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-body">
                <div style="display: flex; margin-bottom: 2rem">
                    <span style="font-size: 2rem" id="live-time"></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size: 2rem" id="live-date"></span>
                </div>

                <div class="headline">
                    <span class="highlight">JOGUE</span>, APROVEITE O CLIMA<br />
                    E FIQUE LIGADO AS <span class="highlight-red">NOTÍCIAS</span>
                </div>

                <div class="options-container">
                    <a href="<?= base_url('game') ?>" class="option">
                        <div class="badge">#1</div>
                        <img src="https://img.icons8.com/ios-filled/100/000000/controller.png" alt="Jogos" />
                        <h2>Jogos</h2>
                    </a>
                    <a href="<?= base_url('website/weather') ?>" class="option">
                        <div class="badge">#2</div>
                        <img src="https://img.icons8.com/ios-filled/100/000000/thermometer.png" alt="Temperatura" />
                        <h2>Temperatura</h2>
                    </a>
                    <a href="<?= base_url('website/news') ?>" class="option">
                        <div class="badge">#3</div>
                        <img src="https://img.icons8.com/ios-filled/100/000000/news.png" alt="Notícias" />
                        <h2>Notícias</h2>
                    </a>
                    <!-- New Option with uploaded image -->
                    <a href="<?= base_url('my-muze') ?>" class="option d-none">
                        <div class="badge">#4</div>
                        <img src="<?= base_url('public/img/mymuze1.jpg') ?>" alt="My Muze" />
                        <h2>My Muze</h2>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>public/assets/web/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrmTR6p6INZFKzJ1V-Lvjwt6N2GMdT-_A&libraries=geometry"></script>

    <script>
        const base_url = $('#baseURL').val();
        var player = videojs('videoPlayer');
        var mapa;
        var marcadorAtual;
        var distritosGeoJSON = {};
        var totalDistritos = 0;
        var coordenadasArray = [];
        var coordenadasActuais = [];
        var currentDistrict = null;
        var nextDistrict = null;
        var controller_id = null;




        function getVideos(district) {
            $.ajax({
                url: ' <?= base_url(); ?>website/get_ads',
                type: 'POST',
                dataType: "JSON",
                data: {
                    district: district
                },
                success: function(data) {
                    console.log('playlist--- ' + data)
                    if (Array.isArray(data)) {
                        var playlist = data.map(function(video) {
                            return {
                                sources: [{
                                    src: '<?= base_url() ?>' + video.path,
                                    type: 'application/x-mpegURL',
                                    id_video: video.id
                                }]
                            };
                        });
                        setupPlaylist(playlist);

                    } else {
                        console.error('Invalid data format:', data);
                    }
                },
                error: function(error) {
                    console.error('Error fetching videos:', error);
                }
            });
        }


        function shuffle(array) {
            var currentIndex = array.length,
                temporaryValue, randomIndex;
            while (0 !== currentIndex) {
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }
            return array;
        }

        function setupPlaylist(playlist) {
            shuffle(playlist);
            player.playlist(playlist);
            player.playlist.repeat(true);
            player.playlist.autoadvance(0);
            player.muted(false);

            // Referência ao container dos botões
            var buttonContainer = document.querySelector('.button-container');



            // Mostrar botões quando o vídeo começa a ser reproduzido
            player.on('play', function() {
                buttonContainer.style.display = 'flex'; // Mostra os botões
            });
            // Esconder botões quando o vídeo é pausado ou termina
            player.on('pause', function() {
                buttonContainer.style.display = 'none'; // Esconde os botões
            });

            // Adiciona eventos de clique para os botões "Like" e "Dislike"
            document.getElementById('like').addEventListener('click', function() {
                var currentItemIndex = player.playlist.currentItem();
                var currentItem = player.playlist()[currentItemIndex];
                var videoId = currentItem.sources[0].id_video;
                sendLikeDislike(videoId, 'like');
            });

            document.getElementById('deslike').addEventListener('click', function() {
                var currentItemIndex = player.playlist.currentItem();
                var currentItem = player.playlist()[currentItemIndex];
                var videoId = currentItem.sources[0].id_video;
                sendLikeDislike(videoId, 'like');
            });

            function sendLikeDislike(videoId, action) {
                $.ajax({
                    url: '<?= base_url(); ?>website/save_avaliations', // URL do controller
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        video_id: videoId,
                        action: action // "like" ou "dislike"
                    },
                    success: function(response) {
                        console.log(response); // Exibe a resposta do servidor no console
                        if (response.status === 'error') {
                           
                            alert('Erro ao registrar a ação.');
                        } else {
                             alert('Ação registrada com sucesso!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro na requisição AJAX:', error);
                        alert('Erro ao enviar a ação. Tente novamente.');
                    }
                });
            }

            player.ready(function() {
                var currentItemIndex = player.playlist.currentItem();
                var currentItem = player.playlist()[currentItemIndex];


                if (currentItem && currentItem.sources && currentItem.sources[0]) {
                    player.src(currentItem.sources[0].src);
                    player.play().catch(function(error) {
                        console.error('Error during play:', error);
                    });
                } else {
                    console.error('No valid source found for the current playlist item');
                }
            });

            player.on('ended', function() {
                buttonContainer.style.display = 'none';
                var nextIndex = player.playlist.nextIndex();

                if (nextIndex === -1) {
                    nextIndex = 0;
                }

                var nextItem = player.playlist()[nextIndex];
                if (nextItem && nextItem.sources && nextItem.sources[0]) {
                    var overlay = document.querySelector('.overlay');
                    var logoPop = document.querySelector('.logo-pop');

                    // Exibir a tela branca
                    overlay.classList.add('show');

                    // Animar o logo-pop
                    logoPop.classList.add('fade-in', 'zoom-in');

                    // Pausar, mutar, ocultar o vídeo
                    player.pause();
                    player.muted(true);
                    player.hide(); // Esconde o player
                    document.getElementById('videoPlayer').style.display = 'none'; // Define display: none

                    // Mostrar o modal
                    var modal = document.getElementById('myModal');
                    modal.style.display = "block";

                    // Fechar o modal após 5 segundos
                    setTimeout(function() {
                        modal.style.display = "none";

                        // Remover a animação de zoom-in e aplicar zoom-out
                        logoPop.classList.remove('zoom-in');
                        logoPop.classList.add('zoom-out');

                        // Trocar para o próximo vídeo após 1000ms
                        setTimeout(function() {
                            // Atualiza a fonte do próximo vídeo e o carrega
                            player.src(nextItem.sources[0].src);
                            controller_id = nextItem.sources[0].id_video;
                            player.load();

                            // Remover a tela branca após 250ms
                            setTimeout(function() {
                                overlay.classList.remove('show');
                            }, 250);

                            // Ocultar o logo-pop após 1000ms
                            setTimeout(function() {
                                logoPop.classList.remove('zoom-out', 'fade-in');
                            }, 1000);

                            // Mostrar, desmutar e reproduzir o vídeo após o fechamento do modal
                            document.getElementById('videoPlayer').style.display = 'block'; // Remove display: none
                            player.show(); // Mostra o player novamente
                            player.muted(false); // Desmuta o player
                            player.play().catch(function(error) {
                                console.error('Error during play:', error);
                            });

                            // Se o distrito mudou, carregar a nova playlist
                            if (nextDistrict && nextDistrict !== currentDistrict) {
                                currentDistrict = nextDistrict;
                                getVideos(currentDistrict);
                            }
                        }, 1000); // Espera 1000ms após o zoom-out para trocar o vídeo
                    }, 5000); // Fecha o modal após 5 segundos
                } else {
                    console.error('No valid source found for the next playlist item');
                }

            });

            // Garantir que os eventos de erro sejam registrados corretamente
            player.on('error', function() {
                console.error('Video.js error:', player.error());
            });
        }



        // Call getVideos to initiate the process
        getVideos(currentDistrict);

        function carregarDistritoGeoJSON(nomeDistrito, urlArquivo) {
            fetch(urlArquivo)
                .then(response => response.json())
                .then(dados => {
                    distritosGeoJSON[nomeDistrito] = dados;

                    if (Object.keys(distritosGeoJSON).length === totalDistritos) {
                        obterLocalizacaoAtual();
                    }
                });
        }

        function carregarDistritos() {
            var listaDistritos = [{
                    nome: "kamaxakeni",
                    url: "<?= base_url('public/district/Kamaxakeni.geojson') ?>"
                },
                {
                    nome: "kampfumu",
                    url: "<?= base_url() ?>" + "public/district/Kampfumu.geojson"
                }
            ];

            totalDistritos = listaDistritos.length;
            for (var i = 0; i < listaDistritos.length; i++) {
                var distrito = listaDistritos[i];
                carregarDistritoGeoJSON(distrito.nome, distrito.url);
            }
        }

        function identificarDistrito(lat, lng) {
            for (var nomeDistrito in distritosGeoJSON) {
                var distrito = distritosGeoJSON[nomeDistrito];
                var coordenadas = distrito.features[0].geometry.coordinates;

                if (verificarCoordenadas(coordenadas, lat, lng)) {
                    if (currentDistrict !== nomeDistrito) {
                        nextDistrict = nomeDistrito;
                    }
                    mostrarDistritoAtual(nomeDistrito);
                    return;
                }
            }

            mostrarDistritoAtual("Distrito Desconhecido");
        }

        function verificarCoordenadas(coordenadas, lat, lng) {
            if (coordenadas.length === 0) return false;

            var polygonPaths = coordenadas.map(polygon => {
                return polygon.map(point => {
                    return new google.maps.LatLng(point[1], point[0]);
                });
            });

            var polygon = new google.maps.Polygon({
                paths: polygonPaths
            });
            return google.maps.geometry.poly.containsLocation(new google.maps.LatLng(lat, lng), polygon);
        }

        function mostrarDistritoAtual(nomeDistrito) {
            var info = document.getElementById("distrito-atual");
            info.textContent = "Distrito atual: " + nomeDistrito;
            console.log("Distrito atual: " + nomeDistrito)
        }

        function obterLocalizacaoAtual() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(mostrarLocalizacao, erroLocalizacao);
            } else {
                alert("Geolocalização não suportada pelo seu navegador.");
            }
        }

        function get_location(coordenadasActuais, currentDistrict, controller_id) {
            $.ajax({
                url: '<?= base_url(); ?>website/count_loaded',
                type: 'POST',
                dataType: "JSON",
                data: {
                    latitude: coordenadasActuais.latitude,
                    longitude: coordenadasActuais.longitude,
                    currentDistrict,
                    controller_id
                },
                success: function(data) {
                    console.log(data);
                },
            });
        }

        function mostrarLocalizacao(posicao) {
            var lat = posicao.coords.latitude;
            var lng = posicao.coords.longitude;

            identificarDistrito(lat, lng);

            if (!marcadorAtual) {
                marcadorAtual = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng),
                    map: mapa,
                    title: 'Sua Localização',
                    zoom: 20,
                });
            } else {
                marcadorAtual.setPosition(new google.maps.LatLng(lat, lng));
            }

            // Adiciona as novas coordenadas ao array
            coordenadasArray.push({
                latitude: lat,
                longitude: lng
            });

            coordenadasActuais = {
                latitude: lat,
                longitude: lng
            }

            get_location(coordenadasActuais, currentDistrict, controller_id);
        }

        function erroLocalizacao(erro) {
            alert("Erro ao obter sua localização: " + erro.message);
        }

        function inicializarMapa() {
            mapa = new google.maps.Map(document.getElementById('mapa'), {
                center: {
                    lat: -25.0,
                    lng: 31.0
                },
                zoom: 8
            });

            carregarDistritos();
        }

        google.maps.event.addDomListener(window, 'load', inicializarMapa);
    </script>

</body>

</html>