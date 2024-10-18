<?php
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Crie sua logo</title>
  <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: "OpenSauce";
      background-color: #f2faff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      text-align: center;
      width: 90vw;
    }

    .formas {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    canvas {
      border: 1px solid #ccc;
      border-radius: 24px;
    }

    h1 {
      font-family: "OpenSauceBold";
      letter-spacing: -1px;
      color: #050a30;
      margin-bottom: 10px;
    }

    .controls {
      background-color: #050a30;
      border: none;
      border-radius: 24px;
      display: flex;
      align-items: center;
      padding: 10px;
      flex-direction: column;
      margin: 20px 10px;
      height: 40vh;
      width: 20vw;
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

    .shapeBtn {
      width: 80px;
      height: 80px;
      margin: 10px 0;
      background-color: #233dff;
      color: #fff;
      border: none;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: background-color 0.3s ease;
      font-size: 0;
    }

    #circleShape {
      border-radius: 100%;
    }

    #triangleShape {
      width: 0;
      height: 0;
      border-left: 40px solid transparent;
      border-right: 40px solid transparent;
      border-bottom: 80px solid #233dff;
      background-color: transparent;
      margin: 10px 0;
      padding: 0;
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

  <?php 
  include("includes/header-fixo.php");
  include("includes/nav.html");
  ?>

  <div class="container">
    <div class="controls images">
      <span>Adicione uma forma</span>
      <p class="color">
        <label for="shapeColor">Cor da Forma:</label>
        <input type="color" id="shapeColor" value="#233dff" />
      </p>
      <div class="formas">
        <button id="circleShape" class="shapeBtn">Circulo</button>
        <button id="squareShape" class="shapeBtn">Quadrado</button>
        <button id="triangleShape" class="shapeBtn">Triângulo</button>
      </div>
    </div>
    <div class="painel">
      <h1>Crie sua Logo</h1>
      <canvas id="shirtCanvas" width="400" height="400">
      </canvas>
    </div>
    <div class="controls">
      <p class="color" style="margin-top: 20px;">
        <label for="colorPicker">Cor de fundo:</label>
        <input type="color" id="colorPicker" value="#ffffff" />
      </p>
      <p class="color" style="margin-bottom: -20px;">
        <label for="colorPicker">Cor do texto:</label>
        <input type="color" id="colorText" value="#000000" />
      </p>
      <p>
        <input type="text" id="textInput" placeholder="Digite seu texto" />
      </p>
      <button id="addText" class="flat">Adicionar</button>
      <p>
        <label for="imageUpload" class="custom-file-upload">Adicionar Imagem
          <input type="file" id="imageUpload" accept="image/*" multiple />
        </label>
      </p>
      <button id="downloadBtn" class="downloadBtn flat">Salvar imagem<ion-icon
          name="download-outline"></ion-icon></button>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
  <script>
    const canvas = new fabric.Canvas("shirtCanvas");
    const colorPicker = document.getElementById("colorPicker");
    const textInput = document.getElementById("textInput");
    const textColorInput = document.getElementById("colorText");
    const addTextBtn = document.getElementById("addText");
    const downloadBtn = document.getElementById("downloadBtn");
    const imageUpload = document.getElementById("imageUpload");

    // Adiciona uma camisa como retângulo
    function drawShirt(color) {
      canvas.clear();
      const shirt = new fabric.Rect({
        left: 50,
        top: 50,
        fill: color,
        width: 300,
        height: 300,
        selectable: false,
      });
      canvas.add(shirt);
    }

    colorPicker.addEventListener("input", (e) => {
      drawShirt(e.target.value);
    });

    addTextBtn.addEventListener("click", () => {
      const textColor = textColorInput.value;
      const text = new fabric.Text(textInput.value, {
        left: 100,
        top: 150,
        fontSize: 24,
        fontFamily: "OpenSauce",
        fill: textColor,
      });
      canvas.add(text);
      textInput.value = ""; // Limpa o campo de texto
    });

    // Função para carregar imagens no canvas
    imageUpload.addEventListener("change", (e) => {
      const files = e.target.files;
      const fileArray = Array.from(files);

      fileArray.forEach(file => {
        const reader = new FileReader();

        reader.onload = function (event) {
          fabric.Image.fromURL(event.target.result, function (img) {
            img.scaleToWidth(100); // Ajuste o tamanho da imagem se necessário
            img.set({
              left: Math.random() * (canvas.width - 100), // Posiciona aleatoriamente
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

    // Baixar a imagem
    downloadBtn.addEventListener("click", () => {
      const dataURL = canvas.toDataURL({
        format: "png",
        quality: 1,
      });
      const link = document.createElement("a");
      link.href = dataURL;
      link.download = "camisa.png";
      link.click();
    });

    // Inicializa com uma cor padrão
    drawShirt(colorPicker.value);

    const shapeColorInput = document.getElementById('shapeColor'); // Input de cor
    const circleBtn = document.getElementById('circleShape');
    const squareBtn = document.getElementById('squareShape');
    const triangleBtn = document.getElementById('triangleShape');

    shapeColorInput.addEventListener('input', () => {
      const selectedColor = shapeColorInput.value;

      // Alterar a cor dos botões de círculo e quadrado
      circleBtn.style.backgroundColor = selectedColor;
      squareBtn.style.backgroundColor = selectedColor;

      // Alterar a cor da borda do triângulo
      triangleBtn.style.borderBottomColor = selectedColor;
    });

    // Função para desenhar um círculo no canvas
    circleBtn.addEventListener('click', () => {
      const circle = new fabric.Circle({
        left: 150,
        top: 150,
        radius: 50,
        fill: shapeColorInput.value // Usa a cor selecionada
      });
      canvas.add(circle);
    });

    // Função para desenhar um quadrado no canvas
    squareBtn.addEventListener('click', () => {
      const square = new fabric.Rect({
        left: 150,
        top: 150,
        width: 100,
        height: 100,
        fill: shapeColorInput.value // Usa a cor selecionada
      });
      canvas.add(square);
    });

    // Função para desenhar um triângulo no canvas
    triangleBtn.addEventListener('click', () => {
      const triangle = new fabric.Triangle({
        left: 150,
        top: 150,
        width: 100,
        height: 100,
        fill: shapeColorInput.value // Usa a cor selecionada
      });
      canvas.add(triangle);
    });

    function resizeCanvas() {
      const containerWidth = window.innerWidth * 0.6; // Exemplo: 80% da largura da janela
      const containerHeight = window.innerHeight * 0.6; // Exemplo: 60% da altura da janela

      // Atualiza o tamanho do canvas
      canvas.setWidth(containerWidth);
      canvas.setHeight(containerHeight);

      // Opcional: Redimensiona os objetos proporcionalmente
      canvas.getObjects().forEach(function (obj) {
        const scaleX = containerWidth / canvas.originalWidth;
        const scaleY = containerHeight / canvas.originalHeight;

        obj.scaleX *= scaleX;
        obj.scaleY *= scaleY;
        obj.left *= scaleX;
        obj.top *= scaleY;
        obj.setCoords();
      });

      canvas.originalWidth = containerWidth;
      canvas.originalHeight = containerHeight;

      canvas.renderAll();
    }

    // Chama a função para redimensionar o canvas ao carregar a página
    resizeCanvas();

    // Redimensiona o canvas quando a janela é redimensionada
    window.addEventListener('resize', resizeCanvas);
  </script>
  <script src="js/user-animation.js"></script>
  <script src="js/nav-animation.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>