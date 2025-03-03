<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jogos, Clima e Notícias</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            width: 100%;
            padding: 20px;
        }

        .game-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 10px 10px 20px 15px #050338;
            width: 100%;
            max-width: 600px;
            margin: 20px 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        #back-button {
            position: fixed;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(45deg, #1816c4, #e2eff2);
            border: none;
            border-radius: 8px;
            box-shadow: 0 8px 15px #ba0592;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        #back-button:hover {
            background: linear-gradient(45deg, #e2eff2, #1816c4);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
        }

        #back-button:active {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        #live-time {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg-light">

    <?php switch ($game) {
        case 1:
            echo ' <script src="https://cdn.htmlgames.com/embed.js?game=Words&amp;bgcolor=white"></script>';
            break;
        case 2:
            echo
            ' <script src="https://cdn.htmlgames.com/embed.js?game=DailySudoku&amp;bgcolor=white"></script>';
            break;
        case 3:
            echo
            '<div><script src="https://cdn.htmlgames.com/embed.js?game=TicTacToe&amp;bgcolor=white"></script>';
            break;
        case 4:
            echo
            '<div><script src="https://cdn.htmlgames.com/embed.js?game=SpiderSolitaire2Suits&amp;bgcolor=white"></script>';
            break;
        default:
            echo ' <h2>Escolha um jogo para começar</h2>';
            break;
    } ?>
    <!-- Botão Back -->
    <a href="<?= base_url('homepage') ?>" id="back-button" class="btn">Voltar</a>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>