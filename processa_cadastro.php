<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <style>

        .container,.login-container{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100vw;
            height: 95.8vh;
            padding: 20px;
            font-family: "OpenSauceRegular";
            background-image: url("assets/background.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: start;
        }

        .login-container {
            flex-direction: column;
            height: 30vh;
            padding: 20px;
            width: 30%;
            border: 1px solid #cae8ff33;
            border-radius: 5px;
            background: #00294910;
            backdrop-filter: blur(5px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-container p {
            text-align: center;
            margin-bottom: 12px;
        }

        .login-container .flat,
        .register-container .flat {
            font-size: 1rem;
            padding: 10px;
            border-radius: 18px;
            margin: 22px 0;
        }

        .login-container .flat:hover,
        .register-container .flat:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 10px 1px #233dff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container">
            <?php
            include('conexao.php');

            $nomecad = $_POST['nomecad'];
            $emailcad = $_POST['emailcad'];
            $senhacad = $_POST['senhacad'];

            $senhacad_hash = password_hash($senhacad, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nome, email, senha, perfil) VALUES ('$nomecad', '$emailcad', '$senhacad_hash', 'USR')";

            if ($mysqli->query($sql) === TRUE) {
                echo "<h2>Cadastro realizado com sucesso!</h2>";

            } else {
                echo "<h2>Erro: " . $sql . "<br>" . $mysqli->error . "</h2>";
            }

            $mysqli->close();
            ?>

            <p>Agora faça o Login</p>
            <a href="login.php">
                <button class="flat">Fazer login</button>
            </a>
        </div>
    </div>
</body>