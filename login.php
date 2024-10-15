<?php
include('conexao.php'); // Inclui o arquivo de conexão ao banco de dados

// Verifica se o formulário foi enviado
if (isset($_POST['email']) || isset($_POST['senha'])) {

    // Verifica se o campo de email está vazio
    if (strlen($_POST['email']) == 0) {
        echo "<div id=\"mensagem\">Preencha seu email</div>"; // Mensagem de erro
    }
    // Verifica se o campo de senha está vazio
    else if (strlen($_POST['senha']) == 0) {
        echo "<div id=\"mensagem\">Preencha sua senha</div>"; // Mensagem de erro
    } else {
        // Escapa os dados de entrada para evitar SQL Injection
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $_POST['senha']; // Captura a senha

        // Consulta no banco de dados para verificar se o email existe
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' ";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
        $usuario = $sql_query->fetch_assoc(); // Captura os dados do usuário

        // Verifica se o usuário existe e se a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            if (!isset($_SESSION)) {
                session_start(); // Inicia a sessão se ainda não estiver iniciada
            } else {
                session_abort(); // Se a sessão já estiver iniciada, a aborta
            }

            // Armazena dados do usuário na sessão
            $_SESSION['id_usuario'] = $usuario['ID'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];

            // Redireciona o usuário para a página apropriada com base no perfil
            if ($usuario['perfil'] == 'ADM') {
                header("Location: adm.php"); // Redireciona para a página de administração
            } else {
                header("Location: index.php"); // Redireciona para a página do usuário logado
            }
        } else {
            // Mensagem de erro se o login falhar
            echo "<div id=\"mensagem\">Falha ao logar | E-mail ou senha incorretos!!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8"> <!-- Define o conjunto de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Configura a visualização em dispositivos móveis -->
    <title>Página de Login</title> <!-- Título da página que aparece na aba do navegador -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon"> <!-- Ícone da aba do navegador -->

    <!-- Link para o CSS do Bootstrap para estilização -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Link para o jQuery, necessário para algumas funcionalidades do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Link para o JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/style.css"> <!-- Link para o CSS customizado -->

    <style>
        /* Estilos customizados para o login */
        #mensagemErro {
            text-align: right;
            /* Alinha a mensagem de erro à direita */
            margin-left: 900px;
            /* Margem esquerda para posicionar */
        }

        /* Estilos do corpo da página */
        body {
            background-image: url("assets/background.png");
            /* Imagem de fundo */
            background-size: cover;
            /* Cobre todo o fundo */
            background-repeat: no-repeat;
            /* Não repete a imagem */
            background-position: start;
            /* Posição inicial da imagem */
        }

        .container {
            display: flex;
            /* Define um layout flexível */
            justify-content: center;
            /* Centraliza horizontalmente */
            align-items: center;
            /* Centraliza verticalmente */
            width: 100vw;
            /* Largura total da janela */
            height: 100vh;
            /* Altura total da janela */
            font-family: "OpenSauceRegular";
            /* Fonte usada no container */
        }

        /* Estilos para as caixas de login e cadastro */
        .login-container,
        .register-container {
            height: 35vh;
            /* Altura da caixa */
            padding: 20px;
            /* Espaçamento interno */
            width: 30%;
            /* Largura da caixa */
            border: 1px solid #cae8ff33;
            /* Borda da caixa */
            border-radius: 5px;
            /* Bordas arredondadas */
            background: #00294910;
            /* Fundo da caixa */
            backdrop-filter: blur(8px);
            /* Efeito de desfoque no fundo */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Sombra da caixa */
            margin: 0 10px;
            /* Margem entre as caixas */
        }

        /* Estilos para os títulos das caixas */
        .login-container h2,
        .register-container h2 {
            text-align: center;
            /* Centraliza o texto */
            margin-bottom: 20px;
            /* Margem inferior do título */
        }

        /* Estilos para o formulário */
        form {
            border-top: 1px solid #fff;
            /* Borda superior do formulário */
            border-bottom: none;
            /* Remove a borda inferior */
            border-left: none;
            /* Remove a borda esquerda */
            border-right: none;
            /* Remove a borda direita */
        }

        /* Estilos para os campos de entrada */
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            /* Largura total do campo */
            padding: 12px;
            /* Espaçamento interno do campo */
            margin: 2px 0;
            /* Margem superior e inferior */
            border-top: none;
            /* Remove a borda superior */
            border-bottom: 1px solid #fff;
            /* Borda inferior do campo */
            border-left: none;
            /* Remove a borda esquerda */
            border-right: none;
            /* Remove a borda direita */
            transition: border-color 0.3s;
            /* Transição suave para a mudança de cor da borda */
            box-sizing: border-box;
            /* Inclui o padding na largura total do campo */
            font-family: "OpenSauce";
            /* Fonte usada nos campos */
            font-size: 1rem;
            /* Tamanho da fonte */
            color: #fff;
            /* Cor do texto */
            background: #00294910;
            /* Fundo do campo */
        }

        /* Remove o contorno ao focar no campo */
        input:focus {
            outline: none;
        }

        /* Estilo para o placeholder dos campos */
        input::placeholder {
            color: #fff;
            /* Cor do texto do placeholder */
        }

        /* Estilos para a seção de "Esqueceu a senha?" */
        .forgot-password {
            text-align: center;
            /* Centraliza o texto */
            margin-top: 10px;
            /* Margem superior */
        }

        /* Estilos para mensagens */
        .message {
            color: #737373;
            /* Cor do texto */
            text-align: center;
            /* Centraliza o texto */
            margin-top: 10px;
            /* Margem superior */
        }

        /* Estilos para os botões */
        .login-container .flat,
        .register-container .flat {
            font-size: 1rem;
            /* Tamanho da fonte */
            padding: 10px;
            /* Espaçamento interno */
            border-radius: 18px;
            /* Bordas arredondadas */
            margin: 22px 0;
            /* Margem superior e inferior */
        }

        /* Efeito de hover nos botões */
        .login-container .flat:hover,
        .register-container .flat:hover {
            transform: scale(1.05);
            /* Aumenta o tamanho do botão */
            box-shadow: 0px 0px 10px 1px #233dff;
            /* Adiciona sombra ao botão */
        }

        /* Estilos para a seção de senha */
        .senha {
            display: flex;
            /* Define um layout flexível */
            justify-content: center;
            /* Centraliza horizontalmente */
            align-items: center;
            /* Centraliza verticalmente */
        }

        /* Estilos para o botão de visualização da senha */
        .btnVer {
            margin-left: 2px;
            /* Margem à esquerda */
            padding: 10px;
            /* Espaçamento interno */
            font-size: 2rem;
            /* Tamanho da fonte */
            background-color: transparent;
            /* Fundo transparente */
            border: none;
            /* Remove borda */
            color: white;
            /* Cor do texto */
            border-radius: 3px;
            /* Bordas arredondadas */
            cursor: pointer;
            /* Muda o cursor para indicar que é clicável */
            transition: background-color 0.3s;
            /* Transição suave para a mudança de cor de fundo */
        }

        /* Efeito de hover para o botão de visualização da senha */
        .btnVer:hover {
            background-color: #ffffff31;
            /* Muda a cor de fundo ao passar o mouse */
        }

        /* Estilos para o modal */
        .modal {
            color: #737373;
            /* Cor do texto no modal */
        }

        /* Estilos responsivos para telas menores */
        @media all and (max-width: 600px) {
            .container {
                flex-direction: column;
                /* Alinha os itens verticalmente em telas pequenas */
                justify-content: space-evenly;
                /* Distribui espaço uniformemente entre os itens */
            }

            .register-container,
            .login-container {
                height: 40vh;
                /* Aumenta a altura das caixas */
                width: 50vw;
                /* A largura das caixas se torna 50% da largura da tela */
                margin: 0;
                /* Remove as margens laterais */
                backdrop-filter: blur(15px);
                /* Aumenta o desfoque de fundo nas caixas */
            }
        }
    </style>
</head>

<body>

    <!-- Modal que será exibido após ações como cadastro -->
    <div class="modal fade" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5> <!-- Título do modal -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <!-- Botão de fechar -->
                        <span aria-hidden="true">&times;</span> <!-- Ícone de fechar -->
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container"> <!-- Contêiner principal que contém os formulários -->
        <div class="login-container"> <!-- Caixa de login -->
            <h2>Login</h2>
            <form id="loginForm" action="login.php" method="POST"> <!-- Formulário de login -->
                <input type="email" name="email" placeholder="Digite seu email" required> <!-- Campo de email -->
                <div class="senha">
                    <input type="password" name="senha" placeholder="Senha" class="inpSenha login-senha" required
                        autocomplete="current-password"> <!-- Campo de senha -->
                    <ion-icon onclick="verSenha('login-senha')" class="btnVer" name="eye"></ion-icon>
                    <!-- Ícone para mostrar/esconder senha -->
                </div>
                <button type="submit" class="flat">Entrar</button> <!-- Botão de login -->
            </form>
            <div class="forgot-password">
                <a href="#" style="color: #233dff;">Esqueceu a senha?</a> <!-- Link para recuperação de senha -->
            </div>
            <div class="message" id="loginMessage"></div> <!-- Div para mensagens de erro ou sucesso -->
        </div>

        <div class="register-container"> <!-- Caixa de cadastro -->
            <h2>Cadastro</h2>
            <form id="registerForm"> <!-- Formulário de cadastro -->
                <input type="text" name="nomecad" placeholder="Digite seu nome" required> <!-- Campo de nome -->
                <input type="email" name="emailcad" placeholder="Digite seu email" required> <!-- Campo de email -->
                <div class="senha">
                    <input type="password" name="senhacad" placeholder="Senha" class="inpSenha register-senha" required
                        autocomplete="current-password"> <!-- Campo de senha para cadastro -->
                    <ion-icon onclick="verSenha('register-senha')" class="btnVer" name="eye"></ion-icon>
                    <!-- Ícone para mostrar/esconder senha -->
                </div>
                <button type="submit" class="flat">Cadastrar</button> <!-- Botão de cadastro -->
            </form>
            <div class="message" id="registerMessage"></div> <!-- Div para mensagens de erro ou sucesso no cadastro -->
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Lida com o evento de submissão do formulário de registro
            $('#registerForm').on('submit', function (event) {
                event.preventDefault(); // Previne o envio padrão do formulário
                var formData = new FormData(this); // Cria um objeto FormData com os dados do formulário
                $.ajax({
                    url: 'processa_cadastro.php', // URL para onde os dados serão enviados
                    type: 'POST', // Método de envio
                    data: formData, // Dados do formulário
                    processData: false, // Não processa os dados
                    contentType: false, // Não define o tipo de conteúdo
                    success: function (response) {
                        // Trata a resposta do servidor
                        if (response.status === 'success') {
                            $('#modalLabel').html(response.message); // Exibe mensagem de sucesso
                        } else {
                            $('#modalLabel').html('Erro: ' + response.message); // Exibe mensagem de erro
                        }
                        $('#resultadoModal').modal('show'); // Exibe o modal com a mensagem
                    }
                });
            });
        });
    </script>

    <!-- Importação dos ícones da Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <script src="js/password.js"></script> <!-- Script para a funcionalidade de mostrar/esconder senha -->
</body>

</html>