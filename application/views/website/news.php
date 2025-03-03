<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pré-visualização de PDFs</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <!-- Inclua o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclua a fonte de ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/v4-shims.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/vendor/feather-icon/feather.css" rel="stylesheet" type="text/css">

    <style>
        .pdf-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .pdf-preview {
            text-align: center;
            background-color: #fff;
            padding: 8px;
            border-radius: 8px;
            box-shadow: 8px 8px 8px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 200px;
        }

        .pdf-preview canvas {
            border-radius: 8px;
            max-width: 100%;
            height: auto;
        }

        .pdf-preview p {
            font-size: 12px;
            color: #333;
        }

        .pdf-preview:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .back-button {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px auto;
            width: 120px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .back-button i {
            margin-right: 8px;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .pdf-preview-container {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        .headline {
            text-align: center;
            margin-bottom: 20px;
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
        <div class="headline mt-5 mb-5">
            <span class="highlight">FIQUE</span> LIGADO AS <span class="highlight-red">NOTÍCIAS</span>
        </div>
        <div class="pdf-preview-container">
            <?php foreach ($newspapers as $newspaper) : ?>
                <a href="<?= base_url() . 'read_news/' . $newspaper->id ?>" class="pdf-preview">
                    <canvas id="pdf<?= $newspaper->id ?>" data-url="<?= base_url('public/newspaper/' . $newspaper->pdf_path) ?>"></canvas>
                    <p><?= $newspaper->name ?></p>
                    <p><?= date('d M Y', strtotime($newspaper->publish_date)) ?></p>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <a href="<?= base_url('homepage') ?>" class="back-button">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pdfPreviews = document.querySelectorAll('.pdf-preview canvas');

            const loadPDF = (canvas, url) => {
                const ctx = canvas.getContext('2d');
                pdfjsLib.getDocument(url).promise.then(pdf => {
                    pdf.getPage(1).then(page => {
                        const viewport = page.getViewport({
                            scale: 1.2
                        });
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        page.render({
                            canvasContext: ctx,
                            viewport: viewport
                        });
                    });
                });
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const canvas = entry.target;
                        const url = canvas.getAttribute('data-url');
                        loadPDF(canvas, url);
                        observer.unobserve(canvas);
                    }
                });
            }, {
                threshold: 0.1
            });

            pdfPreviews.forEach(canvas => {
                observer.observe(canvas);
            });
        });
    </script>

    <!-- Inclua o JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
