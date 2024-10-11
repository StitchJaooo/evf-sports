<?php
include('protect.php'); // Inclui o arquivo de proteção para verificar a sessão do usuário
include('conexao.php'); // Inclui o arquivo de conexão com o banco de dados

// Verifica se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $productId = $_GET['id']; // Armazena o ID do produto
    $produtExist = true; // Inicializa a variável para verificar a existência do produto
    $stmt = $mysqli->prepare("SELECT * FROM produtos WHERE id_produto = ?"); // Prepara a consulta SQL
    $stmt->bind_param("i", $productId); // Faz o bind do parâmetro do ID como inteiro
    $stmt->execute(); // Executa a consulta
    $result = $stmt->get_result(); // Obtém o resultado da consulta

    // Verifica se algum produto foi encontrado
    if ($result->num_rows > 0) {
        $produtExist = true; // Produto existe
    } else {
        $produtExist = false; // Produto não existe
    }
} else {
    $produtExist = false; // Se 'id' não foi passado, o produto não existe
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVF SPORTS</title>
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon"> <!-- Ícone da página -->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
    <!-- Fonte utilizada -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS do Bootstrap -->
    <link rel="stylesheet" href="css/style.css"> <!-- CSS personalizado -->
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100vw;
            margin-top: 21vh;
            margin-bottom: 15.6vh;
        }

        .card {
            text-align: center;
            height: 25vh
        }

        .card-body,
        .card {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
            font-family: "OpenSauceBold";
        }

        .card ion-icon {
            color: red;
            font-size: 4rem;
        }

        #item-footer1,
        #item-footer2 {
            display: flex;
            flex-direction: column;
            width: 400px;
        }

        .item-footer h1 {
            font-family: "OpenSauceBold";
        }

        #item-footer1 p,
        #item-footer2 p {
            margin-top: 5px;
            margin-top: -8px;
        }

        @media all and (max-width: 600px) {
            footer {
                height: 50vh;
            }
        }

        .modal {
            color: #000;
        }

        nav {
            margin-top: -15vh;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flat {
            padding: 5px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        input[type="number"] {
            width: 100%;
            padding: 20px;
            border: 1px solid #233dff;
            box-sizing: border-box;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-top-left-radius: 24px;
            border-bottom-left-radius: 24px;
            font: 1.3rem "OpenSauceRegular";
            color: #000;
            background: #00294910;
            transition: .8s;
        }

        input:focus {
            outline: none;
        }

        input::placeholder {
            color: #000;
        }

        .flat:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 10px 1px #233dff;
        }

        .quantidade {
            transition: .8s;
        }

        .quantidade:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 10px 1px #233dff;
        }

        @media all and (max-width: 600px) {
            .container {
                flex-direction: column;
            }

            footer {
                height: 60vh;
            }

            .item-footer h1 {
                font-size: 1.8rem;
                margin-left: 4vw
            }

            .item-footer p {
                margin-left: 4vw
            }

            .card.img {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <?php
    include("includes/header-fixo.php"); // Inclui o cabeçalho fixo
    include("includes/nav.php"); // Inclui a navegação
    ?>

    <!-- Modal para exibir resultados de operações -->
    <div class="modal fade" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5> <!-- Título do modal -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span> <!-- Botão para fechar o modal -->
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        // Se o produto existe, exibe seus dados
        if ($produtExist) {
            while ($dados_produtos = mysqli_fetch_assoc($result)) { // Busca os dados do produto
                echo "<div class='card img'>"; // Início do card de imagem do produto
                echo "<h3 class='card-estoque'>Estoque: " . $dados_produtos['estoque'] . "</h3>"; // Exibe a quantidade em estoque
                echo "<img src=\"" . $dados_produtos['imagem'] . "\" alt='Imagem do Card' class='card-img'>"; // Exibe a imagem do produto
                echo "</div>";
                echo "<div class='card'>"; // Início do card de informações do produto
                echo "<div class='card-body'>"; // Corpo do card
                echo "<h2 class='card-title'>" . $dados_produtos['nome'] . " - " . $dados_produtos['cor_principal'] . "</h2>"; // Nome e cor do produto
                echo "<h2 class='card-price'>R$" . $dados_produtos['preco'] . "</h2>"; // Preço do produto
                echo "<form id=\"carrinho\">"; // Formulário para adicionar ao carrinho
                echo "<input type=\"hidden\" name=\"id_produto\" value=" . $dados_produtos['id_produto'] . ">"; // ID do produto (oculto)
                echo "<input type=\"number\" name=\"quantidade\" value=\"1\" pattern=\"\d*\" maxlength=\"4\" style=\" width:100px; text-align:center\" placeholder=\"Quantidade\" class='quantidade'>"; // Campo para quantidade
                echo "<button type=\"submit\" class='flat'>Adicionar ao Carrinho</button>"; // Botão para adicionar ao carrinho
                echo "</form>";
                echo "</div>"; // Fim do corpo do card
                echo "</div>"; // Fim do card de informações
            }
        } else {
            // Se o produto não existir, exibe mensagem
            echo "<div class=\"card\">";
            echo "<div class=\"card-body\">";
            echo "<p><ion-icon name=\"close-circle\"></ion-icon></p>"; // Ícone de erro
            echo "<h2 class=\"card-title\">Produto não encontrado.</h2>"; // Mensagem de produto não encontrado
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <footer> <!-- Rodapé da página -->
        <div class="infos" id="infos">
            <div class="item-footer" id="item-footer1">
                <h1>Sobre nós</h1> <!-- Seção sobre a empresa -->
                <p>Somos uma empresa de confecção de camisas, bandeiras e designs, vendemos itens prontos já feitos por
                    nossa empresa!</p>
            </div>
            <div class="item-footer" id="item-footer2">
                <h1>Nossos contatos</h1> <!-- Seção de contato -->
                <p>random@teste.com</p>
                <p>1199999999999999</p>
            </div>
        </div>
        <p class="copy">Copyrights © 2024 - EVF SPORTS</p> <!-- Direitos autorais -->
    </footer>

    <script>
        $(document).ready(function () {
            // Ao submeter o formulário do carrinho
            $('#carrinho').on('submit', function (event) {
                event.preventDefault(); // Previne o envio padrão do formulário
                var formData = new FormData(this); // Cria um objeto FormData com os dados do formulário
                $.ajax({
                    url: 'add_carrinho.php', // URL para adicionar ao carrinho
                    type: 'POST', // Método POST
                    data: formData, // Dados a serem enviados
                    processData: false, // Não processar os dados
                    contentType: false, // Não definir cabeçalho de tipo de conteúdo
                    success: function (response) {
                        // Exibe mensagem de sucesso ou erro baseado na resposta
                        if (response.status === 'success') {
                            $('#modalLabel').html(response.message); // Mensagem de sucesso
                        } else {
                            $('#modalLabel').html('Erro: ' + response.message); // Mensagem de erro
                        }
                        $('#resultadoModal').modal('show'); // Exibe o modal com a mensagem
                    }
                });
            });
        });
    </script>

    <!-- Scripts adicionais para animações e ícones -->
    <script src="js/user-animation.js"></script> <!-- Animações de usuário -->
    <script src="js/nav-animation.js"></script> <!-- Animações de navegação -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <!-- Importa ícones do Ionicons -->
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Importa ícones para navegadores sem suporte a módulos -->
</body>

</html>