<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Reader and Editor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #pdf-container {
            position: relative;
        }

        #pdf-render {
            width: 100%;
            /* border: 1px solid #ccc; */
            box-shadow: 10px 10px 20px 15px #050338;
        }

        .pdf-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment-section {
            margin-top: 20px;
        }

        #new-comment {
            resize: none;
            width: 100%;
            height: 80px;
        }

        #back-button {
            position: fixed;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
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
            transform: translateY(-50%) translateZ(10px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
        }

        #back-button:active {
            transform: translateY(-50%) translateZ(5px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4 ">
        <div class="row">
            <div class="col-lg-12">
                <div id="pdf-container" class="mb-4 position-relative">
                    <canvas id="pdf-render" class=""></canvas>
                </div>
                <div class="pdf-controls mb-4 d-none">
                    <div class="page-info">
                        <span id="page-num" class="font-weight-bold">1</span> / <span id="page-count"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Botão Back -->
    <a href="<?= base_url('homepage') ?>" id="back-button" class="btn">Voltar</a>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        var news = <?php echo json_encode($news); ?>;
        const url = "<?= base_url() ?>" + 'public/newspaper/' + news ;

        let pdfDoc = null,
            pageNum = 1,
            pageIsRendering = false,
            pageNumIsPending = null;

        const scale = 1.4,
            canvas = document.querySelector('#pdf-render'),
            ctx = canvas.getContext('2d');

        const renderPage = num => {
            pageIsRendering = true;
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport
                };

                page.render(renderContext).promise.then(() => {
                    pageIsRendering = false;
                    if (pageNumIsPending !== null) {
                        renderPage(pageNumIsPending);
                        pageNumIsPending = null;
                    }
                });

                document.querySelector('#page-num').textContent = num;
            });
        };

        const queueRenderPage = num => {
            if (pageIsRendering) {
                pageNumIsPending = num;
            } else {
                renderPage(num);
            }
        };

        const showPrevPage = () => {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        };

        const showNextPage = () => {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        };

        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            document.querySelector('#page-count').textContent = pdfDoc.numPages;
            renderPage(pageNum);
        });

        document.querySelector('#prev-page').addEventListener('click', showPrevPage);
        document.querySelector('#next-page').addEventListener('click', showNextPage);

        document.querySelector('#add-comment').addEventListener('click', () => {
            const commentText = document.querySelector('#new-comment').value;
            if (commentText.trim()) {
                const commentItem = document.createElement('li');
                commentItem.classList.add('list-group-item');
                commentItem.textContent = commentText;
                document.querySelector('#comments-list').appendChild(commentItem);
                document.querySelector('#new-comment').value = '';
            }
        });

        document.querySelector('#back-button').addEventListener('click', () => {
            window.history.back();
        });
    </script>
</body>

</html>
