<?php
include('protect.php');
include('conexao.php');
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $produtExist = true;
    $stmt = $mysqli->prepare("SELECT * FROM produtos WHERE id_produto = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $produtExist = true;
    } else {
        $produtExist = false;
    }
} else {
    $produtExist = false;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVF SPORTS</title>
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
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
    </style>
</head>

<body>
    <header class="scrolled">
        <ion-icon name="menu" class="nav-menu"></ion-icon>
        <img src="assets/logo.png" alt="">
        <div class="usuario">
            <a href="carrinho.php"><ion-icon name="cart"></ion-icon></a>
            <ion-icon name="person-circle"></ion-icon>
            <p id="user"><?php echo $_SESSION['nome']; ?>
                <ion-icon name="chevron-forward" class="seta-user"></ion-icon>
            </p>
            <div class="config-conta">
                <p id="myuser">Minha conta</p>
                <div class="borda"></div>
                <p id="exit">
                    <a style="color:red;" href="logout.php">Sair</a>
                </p>
            </div>
        </div>
    </header>
    <nav class="sidebar">
        <ul>
            <a href="#home">
                <li data-section="home" class="selecionado">Home</li>
            </a>
            <div class="borda"></div>
            <a href="#camisas">
                <li data-section="camisas">Camisas</li>
            </a>
            <div class="borda"></div>
            <a href="#produ$dados_produtos">
                <li data-section="logos">Logos</li>
            </a>
            <div class="borda"></div>
            <a href="">
                <li>Quem Somos</li>
            </a>
            <div class="borda"></div>
        </ul>
    </nav>
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
        <?php
        if ($produtExist) {
            while ($dados_produtos = mysqli_fetch_assoc($result)) {
                echo "<div class='card'>";
                echo "<img src=\"" . $dados_produtos['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
                echo "<div class='card-body'>";
                echo "<h2 class='card-title'>" . $dados_produtos['nome'] . " - " . $dados_produtos['cor_principal'] . "</h2>";
                echo "<h2 class='card-price'>R$" . $dados_produtos['preco'] . "</h2>";
                echo "<form id=\"carrinho\">";
                echo "<input type=\"hidden\" name=\"id_produto\" value=" . $dados_produtos['id_produto'] . "></input>";
                echo "<input type=\"text\" name=\"quantidade\" value=\"1\" pattern=\"\d*\" maxlength=\"4\" style=\" width:100px; text-align:center\" placeholder=\"Quantidade\"></input>";
                echo "<button type=\"submit\">Adicionar ao Carrinho</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class=\"card\">";
            echo "<div class=\"card-body\">";
            echo "<p><ion-icon name=\"close-circle\"></ion-icon></p>";
            echo "<h2 class=\"card-title\">Produto não encontrado.</h2>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
    <footer>
        <div class="infos" id="infos">
            <div class="item-footer" id="item-footer1">
                <h1>Sobre nós</h1>
                <p>Somos uma empresa de confecção de camisas, bandeiras e designs, vendemos itens prontos já feitos
                    por
                    nossa empresa!</p>
            </div>
            <div class="item-footer" id="item-footer2">
                <h1>Nossos contatos</h1>
                <p>random@teste.com</p>
                <p>1199999999999999</p>
            </div>
        </div>
        <p class="copy">Copyrights © 2024 - EVF SPORTS</p>
    </footer>

    <script>
        $(document).ready(function () {
            $('#carrinho').on('submit', function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'add_carrinho.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#modalLabel').html(response);
                        $('#resultadoModal').modal('show');
                    }
                });
            });
        });
    </script>

    <script src="js/user-animation.js"></script>
    <script src="js/nav-animation.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>