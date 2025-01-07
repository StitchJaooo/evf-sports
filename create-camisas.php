<?php
include('protect.php');
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crie sua camisa</title>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            z-index: 1000;
        }

        body {
            font-family: "OpenSauce";
            background-color: #f2faff;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin: 0;
            padding-top: 18vh;
            /* Ajuste conforme a altura do cabeçalho */
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            text-align: center;
            width: 90vw;
        }

        .menu {
            background-color: #050a30;
            border-radius: 24px;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            width: 20vw;
        }

        .menu img {
            width: 20%;
            /* Ajuste a largura das imagens */
            margin: 6%;
            cursor: pointer;
            /* Adiciona cursor de ponteiro para as imagens */
        }

        h1 {
            font-family: "OpenSauceBold";
            letter-spacing: -1px;
            color: #050a30;
            margin-bottom: 20px;
        }

        canvas {
            border: 1px solid #ccc;
            border-radius: 24px;
        }

        .controls {
            background-color: #050a30;
            border-radius: 24px;
            padding: 20px;
            width: 25vw;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #233dff;
            color: white;
            margin-top: 10px;
        }

        .shapeBtn,
        .deleteBtn,
        .flat {
            width: 80%;
            margin: 10px 0;
            background-color: #233dff;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
        }

        .color {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .color label {
            margin-right: 10px;
            color: #fff;
        }

        .images {
            height: 45vh;
        }

        .controls p {
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .controls span {
            font-family: "OpenSauce";
            margin: 8px 0 2px;
            font-size: 1.5rem;
            color: #fff;
        }

        .color {
            display: flex;
            align-items: center;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 6px 12px;
            margin: 10px 0 5px 0;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f9fa;
            color: #333;
            width: 80%;
        }

        input[type="file"] {
            display: none;
        }

        input[type="text"],
        input[type="number"] {
            width: 80%;
            padding: 12px;
            margin: 10px 0 10px 0;
            border-top: none;
            border-bottom: 1px solid #fff;
            border-left: none;
            border-right: none;
            transition: border-color 0.3s;
            box-sizing: border-box;
            font-family: "OpenSauce";
            font-size: 1rem;
            color: #fff;
            background: #ffffff34;
        }

        input[type="color"] {
            margin-left: 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #f4f4f4;
            padding: 0;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
            overflow: hidden;
        }

        /* Estilo adicional para navegadores compatíveis (exibir a cor corretamente) */
        input[type="color"]::-webkit-color-swatch {
            border-radius: 50%;
            border: none;
        }

        input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
            border-radius: 50%;
        }

        input:focus {
            outline: none;
        }

        input::placeholder {
            color: #fff;
        }

        .flat {
            padding: 5px;
            border-radius: 12px;
            font-size: 1rem;
            width: 80%;
        }

        #addText {
            margin-top: -5px;
        }

        .downloadBtn {
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .downloadBtn ion-icon {
            font-size: 1.5rem;
            margin-left: 5px;
            margin-bottom: 2px;
        }

        @media all and (max-width: 600px) {
            .container {
                flex-direction: column;
            }

            .controls.images {
                margin-top: 75vh;
            }

            .controls {
                justify-content: flex-start;
                width: 90vw;
                height: auto
            }

            .controls.images span,
            .color {
                width: 100%;
            }

            .color {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .formas {
                width: 100%;
                flex-direction: row;
            }

            .shapeBtn {
                margin-right: 20px;
            }

            .custom-file-upload {
                margin: 25px 0;
            }
        }

        @media all and (max-width: 375px) {
            .controls.images {
                margin-top: 100vh;
            }
        }
    </style>
</head>

<body>

    <header class="scrolled">
        <ion-icon name="menu" class="nav-menu"></ion-icon>
        <a href="index.php">
            <img src="assets/img/logo.png" alt="">
        </a>
        <div class="usuario">
            <a href="carrinho.php"><ion-icon name="cart"></ion-icon></a>
            <ion-icon name="person-circle"></ion-icon>
            <p id="user"><?php echo $_SESSION['nome']; ?><ion-icon name="chevron-forward" class="seta-user"></ion-icon>
            </p>
            <div class="config-conta">
                <p id="myuser">Minha conta</p>
                <div class="borda"></div>
                <p id="exit"><a style="color:red;" href="logout.php">Sair</a></p>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="menu">
            <img class="marca" src="assets/img/nike.png" alt="Nike" onclick="addLogo('assets/img/nike.png', 'marca')">
            <img class="marca" src="assets/img/umbro.svg" alt="Umbro" onclick="addLogo('assets/img/umbro.svg', 'marca')">
            <img class="marca" src="assets/img/adidas.svg" alt="Adidas" onclick="addLogo('assets/img/adidas.svg', 'marca')">
            <img class="time" src="assets/img/corinthians.png" alt="Corinthians"
                onclick="addLogo('assets/img/corinthians.png', 'time')">
            <img class="time" src="assets/img/santos.png" alt="Santos" onclick="addLogo('assets/img/santos.png', 'time')">
            <img class="time" src="assets/img/saoPaulo.png" alt="SP" onclick="addLogo('assets/img/saoPaulo.png', 'time')">
            <img class="time" src="assets/img/palmeiras.png" alt="Palmeiras"
                onclick="addLogo('assets/img/palmeiras.png', 'time')">
            <img class="time" src="assets/img/gremio.png" alt="Gremio" onclick="addLogo('assets/img/gremio.png', 'time')">
            <img class="time" src="assets/img/vasco.png" alt="Vasco" onclick="addLogo('assets/img/vasco.png', 'time')">
            <img class="camp" src="assets/img/liberta.png" alt="Liberta" onclick="addLogo('assets/img/liberta.png', 'camp')">
            <img class="camp" src="assets/img/copaBrasil.png" alt="Copa do Brasil"
                onclick="addLogo('assets/img/copaBrasil.png', 'camp')">
            <img class="camp" src="assets/img/serieB.png" alt="Serie B" onclick="addLogo('assets/img/serieB.png', 'camp')">
        </div>
        <div class="painel">
            <h1>Crie sua Camisa</h1>
            <canvas id="shirtCanvas" width="300" height="250"></canvas>
        </div>
        <div class="controls">
            <div class="color">
                <label for="colorPicker">Cor da camisa:</label>
                <input type="color" id="colorPicker" value="#ffffff" />
            </div>
            <p>
                <input type="text" id="textInput" placeholder="Adicione texto" />
            </p>
            <button id="addText" class="flat">Adicionar</button>
            <label for="imageUpload" class="custom-file-upload">Adicionar Imagem
                <input type="file" id="imageUpload" accept="image/*" multiple />
            </label>
            <button id="downloadBtn" class="downloadBtn flat">Salvar imagem<ion-icon
                    name="download-outline"></ion-icon></button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <script>
        const canvas = new fabric.Canvas("shirtCanvas");
        const colorPicker = document.getElementById("colorPicker");
        const textInput = document.getElementById("textInput");
        const addTextBtn = document.getElementById("addText");
        const downloadBtn = document.getElementById("downloadBtn");
        const imageUpload = document.getElementById("imageUpload");
        const deleteBtn = document.getElementById("deleteBtn");

        // Função para definir a imagem da camisa como fundo
        fabric.Image.fromURL('assets/img/camisa.png', function (img) {
            img.set({ left: 0, top: 0, scaleX: canvas.width / img.width, scaleY: canvas.height / img.height });
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        });

        function drawBackground(color) {
            canvas.setBackgroundColor(color, canvas.renderAll.bind(canvas));
        }

        colorPicker.addEventListener("input", (e) => {
            drawBackground(e.target.value);
        });

        // Função para adicionar o logotipo
        function addLogo(src, tipo) {
            fabric.Image.fromURL(src, function (img) {
                if (tipo === 'marca') {
                    img.set({ left: 100, top: 80, scaleX: 0.05, scaleY: 0.05 }); // Adiciona à esquerda
                } else if (tipo === 'time') {
                    img.set({ left: 160, top: 70, scaleX: 0.05, scaleY: 0.05 }); // Adiciona à direita
                } else if (tipo === 'camp') {
                    img.set({ left: 205, top: 70, scaleX: 0.02, scaleY: 0.02, angle: -40 }); // Adiciona à direita
                }
                canvas.add(img);
            });
        }

        addTextBtn.addEventListener("click", () => {
            const text = new fabric.Text(textInput.value, {
                left: 100,
                top: 150,
                fontSize: 24,
                fill: '#000',
            });
            canvas.add(text);
            textInput.value = ""; // Limpa o campo de texto
        });


        imageUpload.addEventListener("change", (e) => {
            const files = e.target.files;
            const fileArray = Array.from(files);

            fileArray.forEach(file => {
                const reader = new FileReader();

                reader.onload = function (event) {
                    fabric.Image.fromURL(event.target.result, function (img) {
                        img.scaleToWidth(100);
                        img.set({
                            left: Math.random() * (canvas.width - 100),
                            top: Math.random() * (canvas.height - 100),
                        });
                        canvas.add(img);
                    });
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Delete' || event.key === 'Backspace') {
                const activeObject = canvas.getActiveObject();
                if (activeObject) {
                    canvas.remove(activeObject);
                    canvas.discardActiveObject(); // Limpa a seleção
                }
            }
        });

        let camisa = 0;
        downloadBtn.addEventListener("click", () => {
            const dataURL = canvas.toDataURL({
                format: "png",
                quality: 1,
            });
            const link = document.createElement("a");
            link.href = dataURL;
            link.download = "imgCamisa" + camisa + ".png";
            link.click();
            camisa++;
        });

        drawBackground(colorPicker.value);
    </script>
    <script src="assets/js/user-animation.js"></script>
    <script src="assets/js/nav-animation.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>