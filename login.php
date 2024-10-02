<?php
include('conexao.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {

    if (strlen($_POST['email']) == 0) {
        echo "<div id=\"mensagem\">Preencha seu email</div>";
    } else if (strlen($_POST['senha']) == 0) {
        echo "<div id=\"mensagem\">Preencha sua senha</div>";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $_POST['senha'];

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' ";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
        $usuario = $sql_query->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            if (!isset($_SESSION)) {
                session_start();
            } else {
                session_abort();
            }

            $_SESSION['id_usuario'] = $usuario['ID'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];

            if ($usuario['perfil'] == 'ADM') {
                header("Location: adm.php");
            } else {
                header("Location: logged.php");
            }
        } else {
            echo "<div id=\"mensagem\">Falha ao logar | E-mail ou senha incorretos!!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <style>
        #mensagemErro {
            text-align: right;
            margin-left: 900px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 95.8vh;
            padding: 20px;
            font-family: "OpenSauceRegular";
            background-image: url("assets/background.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: start;
        }

        .login-container,
        .register-container {
            height: 35vh;
            padding: 20px;
            width: 30%;
            border: 1px solid #cae8ff33;
            border-radius: 5px;
            background: #00294910;
            backdrop-filter: blur(8px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
        }

        .login-container h2,
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            border-top: 1px solid #fff;
            border-bottom: none;
            border-left: none;
            border-right: none;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 2px 0;
            border-top: none;
            border-bottom: 1px solid #fff;
            border-left: none;
            border-right: none;
            transition: border-color 0.3s;
            box-sizing: border-box;
            font-family: "OpenSauce";
            font-size: 1rem;
            color: #fff;
            background: #00294910;
        }

        input:focus {
            outline: none;
        }

        input::placeholder {
            color: #fff;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .message {
            color: #737373;
            text-align: center;
            margin-top: 10px;
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
        
        .senha {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .btnVer {
            margin-left: 2px;
            padding: 10px;
            background-color: transparent;
            border: none;
            color: white;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btnVer:hover {
            background-color: #ffffff31;
        }
    </style>
    <script>
        function verSenha(inputClass) {
            const senha = document.querySelector(`.${inputClass}`);
            const icone = senha.nextElementSibling; // Obtém o próximo elemento que é o ícone

            if (senha.type === 'password') {
                senha.type = 'text';
                icone.setAttribute('name', 'eye-off');
            } else {
                senha.type = 'password';
                icone.setAttribute('name', 'eye');
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="login-container">
            <h2>Login</h2>
            <form id="loginForm" action="login.php" method="POST">
                <input type="email" name="email" placeholder="Digite seu email" required>
                <div class="senha">
                    <input type="password" name="senha" placeholder="Senha" class="inpSenha login-senha" required
                        autocomplete="current-password">
                    <ion-icon onclick="verSenha('login-senha')" class="btnVer" name="eye"></ion-icon>
                </div>
                <button type="submit" class="flat">Entrar</button>
            </form>
            <div class="forgot-password">
                <a href="#" style="color: #233dff;">Esqueceu a senha?</a>
            </div>
            <div class="message" id="loginMessage"></div>
        </div>

        <div class="register-container">
            <h2>Cadastro</h2>
            <form id="registerForm" action="processa_cadastro.php" method="POST">
                <input type="text" name="nomecad" placeholder="Digite seu nome" required>
                <input type="email" name="emailcad" placeholder="Digite seu email" required>
                <div class="senha">
                    <input type="password" name="senhacad" placeholder="Senha" class="inpSenha register-senha" required
                        autocomplete="current-password">
                    <ion-icon onclick="verSenha('register-senha')" class="btnVer" name="eye"></ion-icon>
                </div>
                <button type="submit" class="flat">Cadastrar</button>
            </form>
            <div class="message" id="registerMessage"></div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'login');

                .then(response => response.json())
                .then(data => {
                    document.getElementById('loginMessage').textContent = data.message;
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        });

        document.getElementById('registerForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'register');

                .then(response => response.json())
                .then(data => {
                    document.getElementById('registerMessage').textContent = data.message;
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        });
    </script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>

</html>