<?php include('protect.php');
include('conexao.php');
$sql_camisas = "SELECT * FROM produtos WHERE classificacao = 'camisa';";
$camisas = $mysqli->query($sql_camisas);
$sql_bandeiras = "SELECT * FROM produtos WHERE classificacao = 'bandeira';";
$bandeiras = $mysqli->query($sql_bandeiras);
$sql_logos = "SELECT * FROM produtos WHERE  classificacao = 'logo';";
$logos = $mysqli->query($sql_logos);
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
            flex-wrap: wrap;
            width: 100vw;
        }

        .card {
            color: #000;
        }

        .card.form {
            width: 500px;
        }

        .card form {
            padding: 12px;
            display: flex;
            flex-direction: column;
        }

        .form .card-title {
            text-align: center;
            margin: 15px 0 5px 0;
        }

        .card-subtitle {
            font-size: 1rem;
            margin: 15px 0 5px 0;
            color: #838383;
        }

        .modal {
            color: #000;
        }

        .flat {
            padding: 8px;
            border-radius: 15px;
            font-size: 1.1rem;
        }

        .flat:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 10px 1px #233dff;
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
            /* Esconde o input file original */
        }

        input[type="text"],
        input[type="number"] {
            width: 80%;
            padding: 12px;
            margin: 10px 0 10px 0;
            border-top: none;
            border-bottom: 1px solid #000;
            border-left: none;
            border-right: none;
            transition: border-color 0.3s;
            box-sizing: border-box;
            font-family: "OpenSauce";
            font-size: 1rem;
            color: #000;
            background: #00294910;
        }

        input:focus {
            outline: none;
        }

        input::placeholder {
            color: #000;
        }

        form p {
            margin-top: 10px;
        }

        select {
            margin-left: 5px;
            padding: 2px;
        }

        form button {
            margin: 15px 10px 10px 10px;
        }
    </style>
</head>

<body>
    <header>
        <ion-icon name="menu" class="nav-menu"></ion-icon>
        <img src="assets/logo.png" alt="">
        <div class="usuario">
            <ion-icon name="cart"></ion-icon>
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
            <a href="#bandeiras">
                <li data-section="bandeiras">Bandeiras</li>
            </a>
            <div class="borda"></div>
            <a href="#logos">
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

    <div class="section" id="home">
        <h1>Bem vindo ao nosso site!</h1>
        <h3>Encontre aqui a camiseta que é do seu jeito!</h3>
        <div class="buttons">
            <a href="#camisas">
                <button class="flat">Coleção de camisas</button>
            </a>
            <button class="raised">Montar sua camisa</button>
        </div>
    </div>
    <div class="propaganda" id="propaganda">
        <div class="anuncio">
            <ion-icon name="car-sport" class="icons-anuncio"></ion-icon>
            <h1 class="anuncio-title">Frete Grátis</h1>
            <h3 class="anuncio-sub">Para toda zona leste - SP</h3>
        </div>
        <div class="anuncio">
            <ion-icon name="call" class="icons-anuncio"></ion-icon>
            <h1 class="anuncio-title">Suporte 24H</h1>
            <h3 class="anuncio-sub">Atendimento online a todo momento.</h3>
        </div>
        <div class="anuncio">
            <ion-icon name="refresh-outline" class="icons-anuncio"></ion-icon>
            <h1 class="anuncio-title">Dinheiro de volta</h1>
            <h3 class="anuncio-sub">Em caso de erro, tenha seu dinheiro de volta.</h3>
        </div>
    </div>
    <div class="section" id="camisas">
        <p>Conheça agora as melhoras camisas de interclasse de todas as escolas deste país!!!</p>
        <h1>Camisas já feitas</h1>
    </div>
    <div class="container">
        <div class="card form">
            <h2 class="card-title">Formulário</h2>
            <form id="meuForm" enctype="multipart/form-data">
                <input type="text" name="nome" placeholder="nome" required>

                <p>Tipo:
                    <select name="classificacao" class="flat" required>
                        <option value="camisa">Camisa</option>
                        <option value="bandeira">Bandeira</option>
                        <option value="logo">Logo</option>
                    </select>
                </p>

                <input type="number" name="ano" min="2000" max="2100" placeholder="ano" required>

                <label class="custom-file-upload">
                    <input type="file" id="imageUpload" name="imagem" accept="image/*" placeholder="Imagem" required />
                    Imagem
                </label>
                <div id="fileName" class="mt-2"></div>

                <input type="text" name="cor_principal" placeholder="cor principal" required>

                <input type="number" name="preco" step="0.01" placeholder="preco" required>

                <button type="submit" class="flat">Adicionar Item</button>
            </form>
        </div>
        <?php
        while ($dados_camisas = mysqli_fetch_assoc($camisas)) {
            echo "<div class='card' onclick=\"Delete(" . $dados_camisas['id_produto'] . ")\">";
            echo "<img src=\"" . $dados_camisas['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
            echo "<div class='card-body'>";
            echo "<h2 class='card-title'>" . $dados_camisas['nome'] . " - " . $dados_camisas['cor_principal'] . "</h2>";
            echo "<h2 class='card-price'>R$" . $dados_camisas['preco'] . "</h2>";
            echo "<h2 class='card-subtitle'> COD PRODUTO: " . $dados_camisas['id_produto'] . "</h2>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="section" id="bandeiras">
        <p>Confira as melhores Bandeiras de interclasse de todas as escolas do Brasil!</p>
        <h1>Bandeiras</h1>
        <div class="container">
            <?php
            while ($dados_bandeiras = mysqli_fetch_assoc($bandeiras)) {
                echo "<div class='card'>";
                echo "<img src=\"" . $dados_bandeiras['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
                echo "<div class='card-body'>";
                echo "<h2 class='card-title'>" . $dados_bandeiras['nome'] . " - " . $dados_bandeiras['cor_principal'] . "</h2>";
                echo "<h2 class='card-price'>R$" . $dados_bandeiras['preco'] . "</h2>";
                echo "<h2 class='card-subtitle'> COD PRODUTO: " . $dados_bandeiras['id_produto'] . "</h2>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <div id="create">
        <button class="flat">Crie sua bandeira
            <ion-icon name="flag"></ion-icon>
        </button>
    </div>
    <div class="section" id="logos">
        <p>Veja também os melhores Escudos e Logos de interclasse de todas os campeonatos deste país!!!</p>
        <h1>Logos</h1>
        <div class="container">
            <?php
            while ($dados_logos = mysqli_fetch_assoc($logos)) {
                echo "<div class='card'>";
                echo "<img src=\"" . $dados_logos['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
                echo "<div class='card-body'>";
                echo "<h2 class='card-title'>" . $dados_logos['nome'] . " - " . $dados_logos['cor_principal'] . "</h2>";
                echo "<h2 class='card-price'>R$" . $dados_logos['preco'] . "</h2>";
                echo "<h2 class='card-subtitle'> COD PRODUTO: " . $dados_logos['id_produto'] . "</h2>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <div id="create">
        <button class="flat">Crie sua Logo
            <ion-icon name="add-circle"></ion-icon>
        </button>
    </div>
    <footer>
        <div class="infos">
            <div class="item-footer">
                <h1>Sobre nós</h1>
                <p>Somos uma empresa de confecção de camisas, bandeiras e designs, vendemos itens prontos já feitos
                    por
                    nossa empresa!</p>
            </div>
            <div class="item-footer">
                <h1>Nossos contatos</h1>
                <p>random@teste.com</p>
                <p>1199999999999999</p>
            </div>
        </div>
        <p class="copy">Copyrights © 2024 - EVF SPORTS</p>
    </footer>

    <script>
        function Delete(idproduto) {
            $('#modalLabel').html('Você tem certeza que deseja deletar o produto com ID: ' + idproduto + '?');
            $('#resultadoModal').modal('show');
        }

        document.getElementById('imageUpload').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'Nenhum arquivo selecionado';
            document.getElementById('fileName').textContent = fileName;
        });

        $(document).ready(function () {
            $('#meuForm').on('submit', function (event) {
                event.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: 'add_item.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#modalLabel').html(response);
                        $('#resultadoModal').modal('show');
                    },
                    error: function () {
                        $('#modalLabel').html('Erro ao enviar os dados.');
                        $('#resultadoModal').modal('show');
                    }
                });
            });
        });
    </script>

    <script src="js/user-animation.js"></script>
    <script src="js/nav-animation.js"></script>
    <script src="js/header-animation.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>