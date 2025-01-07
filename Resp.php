<?php
    include("conexao.php");

    $nome = $_POST["name"];
    $curso = $_POST["curso"];
    $resp = array();

    for ($i = 0; $i <= 9; $i++) {
        $a = $i + 1;
        $resp[$i] = $_POST["pergunta$a"];
    };

 
    
    $inserir = "INSERT INTO `formulario` (`nome`,`curso`,`resposta_1`,`resposta_2`,`resposta_3`,`resposta_4`,`resposta_5`,`resposta_6`,`resposta_7`,`resposta_8`,`resposta_9`,`resposta_10`) values ('$nome','$curso','$resp[0]','$resp[1]','$resp[2]','$resp[3]','$resp[4]','$resp[5]','$resp[6]','$resp[7]','$resp[8]','$resp[9]');";
    
    mysqli_query($mysqli, $inserir);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    * {
        padding: 0;
        margin: 0;
    }

    @font-face {
        font-family: 'OpenSauce';
        src: url('assets/font/OpenSauceOne-Light.ttf') format('truetype');
    }

    @font-face {
        font-family: 'OpenSauceRegular';
        src: url('assets/font/OpenSauceOne-Regular.ttf') format('truetype');
    }

    @font-face {
        font-family: 'OpenSauceBold';
        src: url('assets/font/OpenSauceOne-Bold.ttf') format('truetype');
    }

    @font-face {
        font-family: 'OpenSauceExtraBold';
        src: url('assets/font/OpenSauceOne-ExtraBold.ttf') format('truetype');
    }

    body {
        color: black;
        background-image: url("assets/img/background.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: start;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    .container {
        background-color: #f8f8ff;
        width: 30vw;
        height: 50vh;
        margin: 10vh 0vw;
        padding: 0vh 5vw;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .title {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        width: 30vw;
        padding: 3vh 0;
        margin-bottom: 3vh;
        color: #12229d;
        
        /* background-color: #e4a1f5; */
    }

    h1 {
        padding: 5px 35px 5px 35px;
        font: 2.3rem 'OpenSauceExtraBold';
        letter-spacing: -2px;
        margin-bottom: 4vh;
        border-bottom: 3px solid #cae8ff;
    }

    p {
        color: #000;
        font: 1.2rem 'OpenSauceBold';
        text-align: center;

        /* background-color: cyan; */
    }

    .nav {
        position: absolute;
        bottom: 0px;
        width: 30vw;
        height: auto; 
        padding: 3vh 0;
        display: flex;
        justify-content: center;

        /* background-color: #a3ffff; */
    }

    /* Butttons */
    button {
        width: 8vw;
        height: 6vh;
        margin: 0px 2px;
        background-color: #06168f;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-family: 'OpenSauceBold';
        cursor: pointer;
    }

    button:hover {
        transition: 0.3s;
        scale: 1.05;
    }

    ion-icon[name='home'] {
        padding-right: 3px;
    }

    @media all and (max-width: 800px) {
        .container {
            width: 65vw;
            height: 40vh;
            margin: 0vh 0vw;
        }

        .title {
            width: 100%;
            margin: 0;
        }

        h1{
            font-size: 2rem;
        }

        p {
            font-size: 0.9rem;
        }

        .nav {
            left: 0;
            width: 90%;
            height: 8vh;
            padding: 0 5%;
        }

        label, .perg, textarea {
            font-size: 0.9rem;
        }

        button, .send {
            width: 20vw;
        }
    }

    </style>
    <title>FeedBack</title>
</head>
<body>

    <div class="container">
        <div class="title">
            <h1>Feedback</h1>
        </div>
        <div class="frase">
            <p>Seu formulário foi enviado!<br>
            Você já pode voltar as compras :)
            </p>
        </div>
        

        <div class="nav">   
            <button type="button" class="exit"><a href="index.php"><ion-icon name="home"></ion-icon>Home</a></button>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>