<?php
include('protect.php');
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crie sua camisa</title>
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
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
            padding-top: 140px; /* Ajuste conforme a altura do cabeçalho */
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
            width: 20%; /* Ajuste a largura das imagens */
            margin: 6%;
            cursor: pointer; /* Adiciona cursor de ponteiro para as imagens */
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

        .shapeBtn, .deleteBtn, .flat {
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
    </style>
</head>
<body>

<header class="scrolled">
    <ion-icon name="menu" class="nav-menu"></ion-icon>
    <a href="index.php">
        <img src="assets/logo.png" alt="">
    </a>
    <div class="usuario">
        <a href="carrinho.php"><ion-icon name="cart"></ion-icon></a>
        <ion-icon name="person-circle"></ion-icon>
        <p id="user"><?php echo $_SESSION['nome']; ?><ion-icon name="chevron-forward" class="seta-user"></ion-icon></p>
        <div class="config-conta">
            <p id="myuser">Minha conta</p>
            <div class="borda"></div>
            <p id="exit"><a style="color:red;" href="logout.php">Sair</a></p>
        </div>
    </div>
</header>

<div class="container">
    <div class="menu">
        <img class="marca" src="assets/nike.png" alt="Nike" onclick="addLogo('assets/nike.png', 'marca')">
        <img class="marca" src="assets/umbro.svg" alt="Umbro" onclick="addLogo('assets/umbro.svg', 'marca')">
        <img class="marca" src="assets/adidas.svg" alt="Adidas" onclick="addLogo('assets/adidas.svg', 'marca')">
        <img class="time" src="assets/corinthians.png" alt="Corinthians" onclick="addLogo('assets/corinthians.png', 'time')">
        <img class="time" src="assets/santos.png" alt="Santos" onclick="addLogo('assets/santos.png', 'time')">
        <img class="time" src="assets/saoPaulo.png" style="transform: rotate(180deg);" alt="SP" onclick="addLogo('assets/saoPaulo.png', 'time')">
        <img class="time" src="assets/palmeiras.png" alt="Palmeiras" onclick="addLogo('assets/palmeiras.png', 'time')">
        <img class="time" src="assets/gremio.png" alt="Gremio" onclick="addLogo('assets/gremio.png', 'time')">
        <img class="time" src="assets/vasco.png" alt="Vasco" onclick="addLogo('assets/vasco.png', 'time')">
        <img class="camp" src="assets/liberta.png" alt="Liberta" onclick="addLogo('assets/liberta.png', 'camp')">
        <img class="camp" src="assets/copaBrasil.png" alt="Copa do Brasil" onclick="addLogo('assets/copaBrasil.png', 'camp')">
        <img class="camp" src="assets/serieB.png" alt="Serie B" onclick="addLogo('assets/serieB.png', 'camp')">
    </div>
    <div class="painel">
        <h1>Crie sua Camisa</h1>
        <canvas id="shirtCanvas" width="300" height="250"></canvas>
    </div>
    <div class="controls">
        <div class="color">
            <label for="colorPicker">Cor do fundo:</label>
            <input type="color" id="colorPicker" value="#ffffff" />
        </div>
        <p>
            <input type="text" id="textInput" placeholder="Digite seu texto" />
        </p>
        <button id="addText" class="flat">Adicionar</button>
        <label for="imageUpload" class="custom-file-upload">Adicionar Imagem
            <input type="file" id="imageUpload" accept="image/*" multiple />
        </label>
        <button id="deleteBtn" class="deleteBtn">Excluir</button>
        <button id="downloadBtn" class="downloadBtn flat">Salvar imagem<ion-icon name="download-outline"></ion-icon></button>
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
    fabric.Image.fromURL('assets/camisa.png', function (img) {
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
                img.set({ left: 160, top: 70, scaleX: 0.05, scaleY: 0.05}); // Adiciona à direita
            } else if (tipo === 'camp') {
                img.set({ left: 205 , top: 70, scaleX: 0.02, scaleY: 0.02, angle: -40 }); // Adiciona à direita
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

    // Função para excluir o item selecionado
    deleteBtn.addEventListener("click", () => {
        const activeObject = canvas.getActiveObject();
        if (activeObject) {
            canvas.remove(activeObject);
        } else {
            alert("Selecione um item para excluir.");
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
<script src="js/user-animation.js"></script>
<script src="js/nav-animation.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
