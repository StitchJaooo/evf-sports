<?php include('protect.php'); ?>

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

        .modal-body.delete-btn, .buttons-update {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media all and (max-width: 600px) {
            footer {
                height: 65vh;
            }

            .item-footer {
                width: 70vw;
            }
        }
    </style>
</head>

<body>
    <?php
    include("includes/header-fixo.php");
    include("includes/nav.php");
    ?>

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
                <div class="modal-body delete-btn">
                    <button class="flat" data-dismiss="modal">Cancelar</button>
                    <button class="flat delete" data-dismiss="modal" id="confirmDeleteBtn">Excluir
                        <ion-icon name="trash"></ion-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" enctype="multipart/form-data">
                        <input type="text" name="idproduto" placeholder="id_produto" id="id_produto" readonly>
                        <input type="text" name="nome-update" placeholder="nome" required>

                        <p>Tipo:
                            <select name="classificacao-update" class="flat" required>
                                <option value="camisa">Camisa</option>
                                <option value="logo">Logo</option>
                            </select>
                        </p>

                        <input type="number" name="ano-update" min="2000" max="2100" placeholder="ano" required>

                        <label class="custom-file-upload">
                            <input type="file" id="imageUpload-update" name="imagem-update" accept="image/*" placeholder="Imagem"
                                required />
                            Imagem
                        </label>
                        <div id="fileName-update" class="mt-2"></div>

                        <input type="text" name="cor_principal-update" placeholder="cor principal" required>

                        <input type="number" name="preco-update" step="0.01" placeholder="preco" required>

                        <input type="number" name="estoque-update" placeholder="estoque" required>

                        <button type="submit" class="flat" >Atualizar Item</button>
                        <button class="flat delete" data-dismiss="modal">Cancelar</button>
                    </form>
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
    <?php
    include("includes/edit-camisas.php");
    include("includes/edit-logos.php");
    include("includes/footer.html");
    ?>

    <script>
        function Delete(id_produto) {
            $('#modalDeleteLabel').html('Você tem certeza que deseja deletar este produto?');
            $('#deleteModal').modal('show');
            document.getElementById('confirmDeleteBtn').onclick = function () {
                DeleteProduct(id_produto);
            };
        }

        function Update(id_produto) {
            $('#modalUpdateLabel').html('PRODUTO');
            document.getElementById("id_produto").value = id_produto;
            $('#updateModal').modal('show');
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

        document.getElementById('imageUpload-update').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'Nenhum arquivo selecionado';
            document.getElementById('fileName-update').textContent = fileName;
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

        $(document).ready(function () {
            $('#updateForm').on('submit', function (event) {
                event.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: 'atualizar_produto.php',
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