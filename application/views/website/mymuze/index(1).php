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
                <a id="downloadLink" href="#" class="btn btn-primary" style="display: none;" download="video.mp4">
                    <i class="fas fa-download"></i> Download
                </a>
            </div>
        </div>

        <!-- Audio Element -->
        <audio id="audioPlayer" src="" ontimeupdate="updateProgress()"></audio>
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

        // Placeholder deve ser visível inicialmente
        placeholderImage.style.display = 'block';
        videoElement.style.display = 'none';

        // Função para ativar a câmera
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
            // Atualiza o visual dos itens da playlist
            playlist.forEach(item => item.classList.remove('active'));
            playlist[currentSongIndex].classList.add('active');

            // Atualiza as informações da música
            const selectedSong = playlist[currentSongIndex];
            audioPlayer.src = selectedSong.getAttribute('data-src');
        }

        function playSong() {
            audioPlayer.play();
            isPlaying = true;

            // Quando a música começar a tocar, ativa a câmera e oculta o placeholder
            placeholderImage.style.display = 'none';
            activateCamera();
            videoElement.style.display = 'block'; // Exibe o vídeo da câmera

            // Exibe os controles novamente quando uma música for selecionada
            controls.style.display = 'flex';
            document.getElementById('startRecord').style.display = 'block';
            document.getElementById('stopRecord').style.display = 'block';
            document.getElementById('startRecord').disabled = false; // Habilitar botão Gravar
            document.getElementById('stopRecord').disabled = true; // Desabilitar Stop até gravação começar
        }

        // Função de contagem regressiva antes de iniciar a gravação
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
                    callback(); // Chama a função de gravação após a contagem
                }
            }, 1000);
        }

        // Função para iniciar a gravação de vídeo com a música
        document.getElementById('startRecord').addEventListener('click', function () {
            startCountdown(() => {
                const videoStream = videoElement.srcObject;
                const audioStream = audioPlayer.captureStream();

                // Combine o vídeo e o áudio
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
                    
                    // Exibir o vídeo gravado na div
                    videoElement.srcObject = null;
                    videoElement.src = recordedVideoURL;
                    videoElement.controls = true; // Exibe os controles de reprodução do vídeo

                    // Parar a música
                    audioPlayer.pause();

                    // Exibir os botões de "Download" e "Apagar"
                    document.getElementById('downloadLink').href = recordedVideoURL;
                    document.getElementById('downloadLink').style.display = 'block';
                    document.getElementById('deleteVideo').style.display = 'block';

                    // Desabilitar os botões de gravação e habilitar "Apagar" e "Download"
                    document.getElementById('stopRecord').style.display = 'none';
                    document.getElementById('startRecord').style.display = 'none';
                };

                mediaRecorder.start();
                document.getElementById('stopRecord').disabled = false;
                this.disabled = true; // Desabilita o botão "Gravar" enquanto está gravando
            });
        });

        // Função para parar a gravação
        document.getElementById('stopRecord').addEventListener('click', function () {
            mediaRecorder.stop();
            this.disabled = true; // Desabilita o botão "Stop" depois de parar
            document.getElementById('startRecord').disabled = false; // Habilita o botão "Gravar" novamente
        });

        // Função para resetar o layout para o estado inicial
        function resetToInitialState() {
            recordedChunks = [];
            videoElement.src = '';
            videoElement.controls = false; // Remove os controles de reprodução
            videoElement.style.display = 'none'; // Oculta o vídeo novamente
            placeholderImage.style.display = 'block'; // Mostra a imagem de placeholder novamente

            // Esconde todos os botões de controle
            document.getElementById('downloadLink').style.display = 'none';
            document.getElementById('deleteVideo').style.display = 'none';
            controls.style.display = 'none'; // Oculta todos os controles até a música ser clicada

            document.getElementById('startRecord').disabled = false;
            document.getElementById('stopRecord').disabled = true;
        }

        // Função para apagar o vídeo gravado e voltar para o estado inicial
        document.getElementById('deleteVideo').addEventListener('click', function () {
            resetToInitialState(); // Chama a função para resetar o layout
        });

        // Função para baixar o vídeo e resetar a tela
        document.getElementById('downloadLink').addEventListener('click', function () {
            resetToInitialState(); // Chama a função para resetar o layout
        });

        function filterSongs() {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            const songs = document.querySelectorAll('.playlist li');

            songs.forEach(song => {
                const title = song.querySelector('div').textContent.toLowerCase();
                song.style.display = title.includes(searchTerm) ? 'flex' : 'none';
            });
        }

        // Inicia a primeira música por padrão
        updateSongDetails();
    </script>

    <!-- Include Bootstrap JS (Optional for interactive components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
