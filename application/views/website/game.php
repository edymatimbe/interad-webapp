<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Grid</title>
  <!-- Inclua o CSS do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Inclua a fonte de ícones do Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/v4-shims.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url(); ?>public/vendor/feather-icon/feather.css" rel="stylesheet" type="text/css">
  <style>
    .game-card img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-radius: 8px;
    }

    .game-card h3 {
      font-size: 16px;
      margin: 10px 0;
    }

    .rating {
      color: #ffcc00;
      font-size: 14px;
    }

    .back-button {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 30px auto;
      width: 150px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    .back-button:hover {
      background-color: #0056b3;
    }

    .back-button i {
      margin-right: 10px;
      font-size: 18px;
    }

    .headline {
      text-align: center;
      /* Centraliza o texto */
      margin-bottom: 20px;
      /* Espaçamento abaixo da headline */
    }

    .highlight {
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
  </style>
</head>

<body>
  <div class="container mt-4">
    <div class="headline h5">
    A vida é um  <span class="highlight">JOGO</span>, <br>
    ou você aprende a <span class="highlight-red">JOGAR</span>
     
    </div>



    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
      <div class="col">
        <a href="<?= base_url() . 'playing_game/1' ?>" class="text-decoration-none text-dark">
          <div class="card game-card h-100">
            <img src="<?= base_url('public/img/game/wordpluz.jpg') ?>" class="card-img-top" alt="Word puzzle">
            <div class="card-body">
              <h3 class="card-title">Word puzzle</h3>
              <div class="rating">★★★★☆</div>
            </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a href="<?= base_url() . 'playing_game/2' ?>" class="text-decoration-none text-dark">
          <div class="card game-card h-100">
            <img src="<?= base_url('public/img/game/sudoku.jpeg') ?>" class="card-img-top" alt="Sudoku">
            <div class="card-body">
              <h3 class="card-title">Sudoku</h3>
              <div class="rating">★★★★☆</div>
            </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a href="<?= base_url() . 'playing_game/3' ?>" class="text-decoration-none text-dark">
          <div class="card game-card h-100">
            <img src="<?= base_url('public/img/game/tiktak.PNG') ?>" class="card-img-top" alt="Word puzzle">
            <div class="card-body">
              <h3 class="card-title">Tik Tak Toe</h3>
              <div class="rating">★★★★☆</div>
            </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a href="<?= base_url() . 'playing_game/4' ?>" class="text-decoration-none text-dark">
          <div class="card game-card h-100">
            <img src="<?= base_url('public/img/game/spider.PNG') ?>" class="card-img-top" alt="Sudoku">
            <div class="card-body">
              <h3 class="card-title">Spider Soltaire</h3>
              <div class="rating">★★★★☆</div>
            </div>
          </div>
        </a>
      </div>
      <!-- Repita para os outros cards -->
    </div>

    <div class="d-flex justify-content-center mt-4">
      <a href="<?= base_url('homepage') ?>" class="back-button">
        <i class="fas fa-arrow-left"></i> Voltar
      </a>
    </div>
  </div>

  <!-- Inclua o JavaScript do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>