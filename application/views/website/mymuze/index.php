<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Muze Streaming</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include only Font Awesome 5.15.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('public/css/mymuze.css') ?>">
    <style>
        .controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px; /* Espaço entre os botões */
        }

        .controls button, .controls a {
            flex: none; /* Garantir que cada botão tenha tamanho fixo */
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Playlist Sidebar -->
        <div class="playlist-container">
            <div class="search-bar">
                <i class="fa fa-search"></i> <!-- Icon inside the search bar -->
                <input type="text" id="search" placeholder="Pesquise uma música..." onkeyup="filterSongs()">
            </div>
            <ul class="playlist" id="playlist">
                <li data-title="Vanavela" data-artist="Mr. Bow" data-album="<?= base_url('public/musica/img') ?>/mr bow.jpg" data-src="<?= base_url('public/musica//Mr. Bow.mp3') ?> ">
                    <img src="<?= base_url('public/musica/img') ?>/mr bow.jpg" alt="Album 1">
                    <div>
                        <div>Vanavela</div>
                        <small>Mr. Bow</small>
                    </div>
                </li>
                <li data-title="Tou Doente" data-artist="Da Drena" data-album="<?= base_url('public/musica/img') ?>/Da Drena.png" data-src="<?= base_url('public/musica/MAÇÃ YA EVA  CLEYTON DA DRENA X3D( OFFICIAL VIDEO ) BY CR BOY.mp3') ?>">
                    <img src="<?= base_url('public/musica/img') ?>/Da Drena.png" alt="Album 2">
                    <div>
                        <div>Tou Doente</div>
                        <small>Da Drena</small>
                    </div>
                </li>
                <li data-title="Rivais" data-artist="Twenty Fingers" data-album="<?= base_url('public/musica/img') ?>/Twenty.jpg" data-src="<?= base_url('public/musica/Twenty Fingers  -  Rivais  [Official Music Video].mp3') ?> ">
                    <img src="<?= base_url('public/musica/img') ?>/Twenty.jpg" alt="Album 3">
                    <div>
                        <div>Rivais</div>
                        <small>Twenty Fingers</small>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Player Area -->
        <div class="player-container">
            <!-- Album Art -->
            <div class="album-art">
                <img id="placeholder-image" src="<?= base_url('public/musica/img') ?>/Escolha um Hit.png" alt="Placeholder Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px;"> <!-- Placeholder image -->
                <video id="video" autoplay muted style="display: none;"></video> <!-- Video for camera feed -->
                <div id="countdown" style="position: absolute; font-size: 48px; color: white; display: none;">3</div> <!-- Contagem regressiva -->
            </div>

            <!-- Playback Controls -->
            <div class="controls" style="display: none;">
                <button id="startRecord" class="btn btn-success">
                    <i class="fas fa-circle"></i> Gravar
                </button>
                <button id="stopRecord" class="btn btn-danger" disabled>
                    <i class="fas fa-stop"></i> Stop
                </button>
                <button id="deleteVideo" class="btn btn-warning" style="display: none;">
                    <i class="fas fa-trash"></i> Apagar
                </button>
                <a id="sendLink" href="#" class="btn btn-primary" style="display: none;" data-toggle="modal" data-target="#emailModal">
                    <i class="fas fa-share"></i> Enviar
                </a>
            </div>
        </div>

        <!-- Audio Element -->
        <audio id="audioPlayer" src="" ontimeupdate="updateProgress()"></audio>
    </div>

    <!-- Modal para envio de vídeo -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailModalLabel">Enviar vídeo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="email" id="email" class="form-control" placeholder="Insira o e-mail">
                    <input type="text" id="phone" class="form-control" placeholder="Insira o número de telefone">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="sendVideoBtn">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const videoElement = document.getElementById('video');
        const placeholderImage = document.getElementById('placeholder-image');
        const audioPlayer = document.getElementById('audioPlayer');
        const controls = document.querySelector('.controls');
        const countdown = document.getElementById('countdown');
        let mediaRecorder;
        let recordedChunks = [];
        let recordedVideoURL = null;

        let isPlaying = false;

        placeholderImage.style.display = 'block';
        videoElement.style.display = 'none';

        function activateCamera() {
            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function (stream) {
                        videoElement.srcObject = stream;
                    })
                    .catch(function (error) {
                        console.log("Something went wrong accessing the camera: ", error);
                    });
            }
        }

        let currentSongIndex = 0;
        const playlist = document.querySelectorAll('.playlist li');

        playlist.forEach((item, index) => {
            item.addEventListener('click', () => {
                currentSongIndex = index;
                updateSongDetails();
                playSong();
            });
        });

        function updateSongDetails() {
            playlist.forEach(item => item.classList.remove('active'));
            playlist[currentSongIndex].classList.add('active');

            const selectedSong = playlist[currentSongIndex];
            audioPlayer.src = selectedSong.getAttribute('data-src');
        }

        function playSong() {
            audioPlayer.play();
            isPlaying = true;

            placeholderImage.style.display = 'none';
            activateCamera();
            videoElement.style.display = 'block';

            controls.style.display = 'flex';
            document.getElementById('startRecord').style.display = 'block';
            document.getElementById('stopRecord').style.display = 'block';
            document.getElementById('startRecord').disabled = false;
            document.getElementById('stopRecord').disabled = true;
        }

        function startCountdown(callback) {
            let count = 3;
            countdown.textContent = count;
            countdown.style.display = 'block';

            const interval = setInterval(() => {
                count--;
                countdown.textContent = count;
                if (count === 0) {
                    clearInterval(interval);
                    countdown.style.display = 'none';
                    callback();
                }
            }, 1000);
        }

        document.getElementById('startRecord').addEventListener('click', function () {
            startCountdown(() => {
                const videoStream = videoElement.srcObject;
                const audioStream = audioPlayer.captureStream();

                const combinedStream = new MediaStream([...videoStream.getTracks(), ...audioStream.getAudioTracks()]);

                mediaRecorder = new MediaRecorder(combinedStream);

                mediaRecorder.ondataavailable = function (event) {
                    if (event.data.size > 0) {
                        recordedChunks.push(event.data);
                    }
                };

                mediaRecorder.onstop = function () {
                    const blob = new Blob(recordedChunks, { type: 'video/mp4' });
                    recordedVideoURL = URL.createObjectURL(blob);

                    videoElement.srcObject = null;
                    videoElement.src = recordedVideoURL;
                    videoElement.controls = true;

                    audioPlayer.pause();

                    document.getElementById('sendLink').style.display = 'block';
                    document.getElementById('deleteVideo').style.display = 'block';

                    document.getElementById('stopRecord').style.display = 'none';
                    document.getElementById('startRecord').style.display = 'none';
                };

                mediaRecorder.start();
                document.getElementById('stopRecord').disabled = false;
                document.getElementById('startRecord').disabled = true;

                // Adiciona um temporizador para parar a gravação após 15 segundos
                setTimeout(() => {
                    mediaRecorder.stop();
                }, 15000); // 15000 milissegundos = 15 segundos
            });
        });

        document.getElementById('stopRecord').addEventListener('click', function () {
            mediaRecorder.stop();
        });

        document.getElementById('deleteVideo').addEventListener('click', function () {
            recordedChunks = [];
            recordedVideoURL = null;
            videoElement.src = '';
            videoElement.controls = false;
            videoElement.style.display = 'none';
            placeholderImage.style.display = 'block';
            document.getElementById('sendLink').style.display = 'none';
            document.getElementById('deleteVideo').style.display = 'none';
            controls.style.display = 'none';
        });

        document.getElementById('sendVideoBtn').addEventListener('click', function () {
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;

            // Lógica para envio do vídeo por e-mail ou telefone pode ser implementada aqui
            console.log('Enviando vídeo para:', email, phone);
        });
    </script>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
