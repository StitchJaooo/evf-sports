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
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        #mensagemErro {
            text-align: right;
            margin-left: 900px;
        }

        body {
            background-image: url("assets/background.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: start;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
            font-family: "OpenSauceRegular";
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
            font-size: 2rem;
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

        .modal {
            color: #737373;
        }

        @media all and (max-width: 600px) {
            .container {
                flex-direction: column;
                justify-content: space-evenly;
            }

            .register-container,
            .login-container {
                height: 40vh;
                width: 50vw;
                margin: 0;
                backdrop-filter: blur(15px);
            }
        }
    </style>
</head>

<body>

    <div class="modal fade" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

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
            <form id="registerForm">
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
        $(document).ready(function () {
            $('#registerForm').on('submit', function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'processa_cadastro.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#modalLabel').html(response.message);
                        } else {
                            $('#modalLabel').html('Erro: ' + response.message);
                        }
                        $('#resultadoModal').modal('show');
                    }
                });
            });
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <script src="js/password.js"></script>
</body>

</html>