<?php include('protect.php');
include('conexao.php');
$sql_camisas = "SELECT * FROM produtos WHERE classificacao = 'camisa';";
$camisas = $mysqli->query($sql_camisas);
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

        .container.form {
            margin-top: 15vh;
        }

        #camisas {
            margin: 20px;
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

        .icon-left {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 2rem;
            color: orange;
            transition: .8s;
        }

        .icon-right {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2rem;
            color: red;
            transition: .8s;
        }

        .icon-left:hover,
        .icon-right:hover {
            transform: scale(1.2);
        }

        .delete {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 3px solid red;
            background-color: red;
        }

        .delete ion-icon {
            margin-left: 8px;
            font-size: 1.5rem;
        }

        .delete:hover {
            box-shadow: 0px 0px 10px 4px red;
        }

        .modal-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
    </style>
</head>

<body>
    <header class="scrolled">
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="flat" data-dismiss="modal">Cancelar</button>
                    <button class="flat delete" data-dismiss="modal" id="confirmDeleteBtn">Excluir
                        <ion-icon name="trash"></ion-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container form">
        <div class="card form">
            <h2 class="card-title">Adicionar produto</h2>
            <form id="meuForm" enctype="multipart/form-data">
                <input type="text" name="nome" placeholder="nome" required>

                <p>Tipo:
                    <select name="classificacao" class="flat" required>
                        <option value="camisa">Camisa</option>
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

                <input type="number" name="estoque" placeholder="estoque" required>

                <button type="submit" class="flat">Adicionar Item</button>
            </form>
        </div>
    </div>

    <div class="section" id="camisas">
        <h1>Camisas</h1>
    </div>
    <div class="container">
        <?php
        while ($dados_camisas = mysqli_fetch_assoc($camisas)) {
            echo "<div class='card'>";
            echo "<div class=\"icon-left\"><ion-icon name=\"pencil\"></ion-icon></div>";
            echo "<div class=\"icon-right\" onclick=\"Delete(" . $dados_camisas['id_produto'] . ")\"><ion-icon name=\"trash\"></ion-icon></div>";
            echo "<h4 class='card-estoque-adm'>Estoque: " . $dados_camisas['estoque'] . "</h4>";
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
    <div class="section" id="logos">
        <h1>Logos</h1>
        <div class="container">
            <?php
            while ($dados_logos = mysqli_fetch_assoc($logos)) {
                echo "<div class='card'>";
                echo "<div class=\"icon-left\"><ion-icon name=\"pencil\"></ion-icon></div>";
                echo "<div class=\"icon-right\" onclick=\"Delete(" . $dados_logos['id_produto'] . ")\"><ion-icon name=\"trash\"></ion-icon></div>";
                echo "<h4 class='card-estoque-adm'>Estoque: " . $dados_logos['estoque'] . "</h4>";
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
        function Delete(id_produto) {
            $('#modalDeleteLabel').html('Você tem certeza que deseja deletar este produto?');
            $('#deleteModal').modal('show');
            document.getElementById('confirmDeleteBtn').onclick = function () {
                DeleteProduct(id_produto);
            };
        }

        function DeleteProduct(id_produto) {
            $.ajax({
                url: 'delete_produto.php',
                type: 'POST',
                data: { id_produto: id_produto },
                success: function (response) {
                    $('#modalLabel').html(response);
                    $('#resultadoModal').modal('show');
                },
                error: function () {
                    $('#modalLabel').html('Erro ao enviar os dados.');
                    $('#resultadoModal').modal('show');
                }
            });
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
                    url: 'add_produto.php',
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>