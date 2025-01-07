<?php include('protect.php'); ?> <!-- Protege a página, garantindo que apenas usuários autenticados possam acessá-la -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVF SPORTS</title>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon"> <!-- Ícone da aba do navegador -->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
    <!-- Fonte personalizada -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Biblioteca jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript do Bootstrap -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS personalizado -->
    <style>
        /* Estilos para o contêiner principal */
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            width: 100vw;
        }

        .container.form {
            margin-top: 15vh;
            /* Margem superior para separar do topo */
        }

        #camisas {
            margin: 20px;
            /* Margem ao redor do elemento */
        }

        .card {
            color: #000;
            /* Cor do texto no cartão */
        }

        .card.form {
            width: 500px;
            /* Largura do cartão de formulário */
        }

        .card form {
            padding: 12px;
            /* Preenchimento interno do formulário */
            display: flex;
            flex-direction: column;
            /* Alinha elementos em coluna */
        }

        /* Títulos e subtítulos */
        .form .card-title {
            text-align: center;
            margin: 15px 0 5px 0;
            /* Margens em torno do título */
        }

        .card-subtitle {
            font-size: 1rem;
            /* Tamanho da fonte do subtítulo */
            margin: 15px 0 5px 0;
            /* Margens em torno do subtítulo */
            color: #838383;
            /* Cor do subtítulo */
        }

        .modal {
            color: #000;
            /* Cor do texto no modal */
        }

        /* Botões personalizados */
        .flat {
            padding: 8px;
            border-radius: 15px;
            /* Bordas arredondadas */
            font-size: 1.1rem;
            /* Tamanho da fonte */
        }

        .flat:hover {
            transform: scale(1.05);
            /* Efeito de aumento no hover */
            box-shadow: 0px 0px 10px 1px #233dff;
            /* Sombra no hover */
        }

        /* Estilos para o botão de upload de arquivo */
        .custom-file-upload {
            display: inline-block;
            padding: 6px 12px;
            /* Preenchimento do botão */
            margin: 10px 0 5px 0;
            /* Margens ao redor */
            cursor: pointer;
            /* Muda o cursor para indicar que é clicável */
            border: 1px solid #ccc;
            /* Borda do botão */
            border-radius: 4px;
            /* Bordas arredondadas */
            background-color: #f8f9fa;
            /* Cor de fundo */
            color: #333;
            /* Cor do texto */
            width: 80%;
            /* Largura do botão */
        }

        /* Estilo do input de arquivo */
        input[type="file"] {
            display: none;
            /* Esconde o input real */
        }

        /* Estilos para os campos de texto e número */
        input[type="text"],
        input[type="number"] {
            width: 80%;
            /* Largura dos campos */
            padding: 12px;
            /* Preenchimento interno */
            margin: 10px 0 10px 0;
            /* Margens ao redor */
            border-top: none;
            border-bottom: 1px solid #000;
            /* Borda inferior */
            border-left: none;
            border-right: none;
            transition: border-color 0.3s;
            /* Transição suave para a mudança de cor da borda */
            box-sizing: border-box;
            /* Inclui bordas e preenchimento no cálculo da largura */
            font-family: "OpenSauce";
            /* Fonte personalizada */
            font-size: 1rem;
            /* Tamanho da fonte */
            color: #000;
            /* Cor do texto */
            background: #00294910;
            /* Cor de fundo */
        }

        input:focus {
            outline: none;
            /* Remove o contorno padrão do foco */
        }

        input::placeholder {
            color: #000;
            /* Cor do texto do placeholder */
        }

        form p {
            margin-top: 10px;
            /* Margem superior para parágrafos dentro de formulários */
        }

        select {
            margin-left: 5px;
            /* Margem à esquerda */
            padding: 2px;
            /* Preenchimento interno */
        }

        form button {
            margin: 15px 10px 10px 10px;
            /* Margens ao redor dos botões */
        }

        /* Estilos para ícones */
        .icon-left {
            position: absolute;
            /* Posicionamento absoluto */
            top: 10px;
            /* Posição superior */
            left: 10px;
            /* Posição à esquerda */
            font-size: 2rem;
            /* Tamanho do ícone */
            color: orange;
            /* Cor do ícone */
            transition: .8s;
            /* Transição suave */
        }

        .icon-right {
            position: absolute;
            /* Posicionamento absoluto */
            top: 10px;
            /* Posição superior */
            right: 10px;
            /* Posição à direita */
            font-size: 2rem;
            /* Tamanho do ícone */
            color: red;
            /* Cor do ícone */
            transition: .8s;
            /* Transição suave */
        }

        /* Efeito de hover nos ícones */
        .icon-left:hover,
        .icon-right:hover {
            transform: scale(1.2);
            /* Aumenta o tamanho no hover */
        }

        /* Estilos para o botão de excluir */
        .delete {
            display: flex;
            justify-content: center;
            /* Alinha os itens no centro */
            align-items: center;
            /* Alinha os itens verticalmente */
            border: 3px solid red;
            /* Borda vermelha */
            background-color: red;
            /* Cor de fundo vermelha */
        }

        .delete ion-icon {
            margin-left: 8px;
            /* Margem à esquerda do ícone */
            font-size: 1.5rem;
            /* Tamanho do ícone */
        }

        .delete:hover {
            box-shadow: 0px 0px 10px 4px red;
            /* Sombra no hover */
        }

        /* Estilos para o corpo do modal de delete e botões de update */
        .modal-body.delete-btn,
        .buttons-update {
            display: flex;
            justify-content: space-between;
            /* Distribui o espaço entre os itens */
            align-items: center;
            /* Alinha os itens verticalmente */
        }

        /* Estilos responsivos */
        @media all and (max-width: 600px) {
            footer {
                height: 65vh;
                /* Altura do rodapé em telas pequenas */
            }

            .item-footer {
                width: 70vw;
                /* Largura dos itens do rodapé */
            }
        }
    </style>
</head>

<body>
    <?php
    include("includes/header-fixo.php"); // Inclui o cabeçalho fixo
    include("includes/nav.html"); // Inclui a navegação
    ?>

    <!-- Modal para mostrar resultados de ações -->
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

    <!-- Modal de confirmação de exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel"></h5> <!-- Título do modal -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span> <!-- Botão de fechar modal -->
                    </button>
                </div>
                <div class="modal-body delete-btn">
                    <button class="flat" data-dismiss="modal">Cancelar</button> <!-- Botão para cancelar a exclusão -->
                    <button class="flat delete" data-dismiss="modal" id="confirmDeleteBtn">Excluir
                        <ion-icon name="trash"></ion-icon> <!-- Ícone de lixeira -->
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para atualização de produto -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel"></h5> <!-- Título do modal -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span> <!-- Botão de fechar modal -->
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" enctype="multipart/form-data"> <!-- Formulário para atualização de produto -->
                        <input type="text" name="idproduto" placeholder="id_produto" id="id_produto" readonly>
                        <!-- ID do produto (somente leitura) -->
                        <input type="text" name="nome-update" placeholder="nome" required>
                        <!-- Campo para nome do produto -->

                        <p>Tipo:
                            <select name="classificacao-update" class="flat" required>
                                <option value="camisa">Camisa</option> <!-- Opção de tipo: Camisa -->
                                <option value="logo">Logo</option> <!-- Opção de tipo: Logo -->
                            </select>
                        </p>

                        <input type="number" name="ano-update" min="2000" max="2100" placeholder="ano" required>
                        <!-- Campo para ano do produto -->

                        <label class="custom-file-upload"> <!-- Estilização para upload de arquivo -->
                            <input type="file" id="imageUpload-update" name="imagem-update" accept="image/*"
                                placeholder="Imagem" required /> <!-- Campo para upload de imagem -->
                            Imagem
                        </label>
                        <div id="fileName-update" class="mt-2"></div> <!-- Exibição do nome do arquivo selecionado -->

                        <input type="text" name="cor_principal-update" placeholder="cor principal" required>
                        <!-- Campo para cor principal -->

                        <input type="number" name="preco-update" step="0.01" placeholder="preco" required>
                        <!-- Campo para preço do produto -->

                        <input type="number" name="estoque-update" placeholder="estoque" required>
                        <!-- Campo para estoque do produto -->

                        <button type="submit" class="flat">Atualizar Item</button>
                        <!-- Botão para submeter atualização -->
                        <button class="flat delete" data-dismiss="modal">Cancelar</button>
                        <!-- Botão para cancelar atualização -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Container para adicionar produto -->
    <div class="container form">
        <div class="card form">
            <h2 class="card-title">Adicionar produto</h2>
            <form id="meuForm" enctype="multipart/form-data"> <!-- Formulário para adicionar um novo produto -->
                <input type="text" name="nome" placeholder="nome" required> <!-- Campo para nome do produto -->

                <p>Tipo:
                    <select name="classificacao" class="flat" required>
                        <option value="camisa">Camisa</option> <!-- Opção de tipo: Camisa -->
                        <option value="logo">Logo</option> <!-- Opção de tipo: Logo -->
                    </select>
                </p>

                <input type="number" name="ano" min="2000" max="2100" placeholder="ano" required>
                <!-- Campo para ano do produto -->

                <label class="custom-file-upload"> <!-- Estilização para upload de arquivo -->
                    <input type="file" id="imageUpload" name="imagem" accept="image/*" placeholder="Imagem" required />
                    <!-- Campo para upload de imagem -->
                    Imagem
                </label>
                <div id="fileName" class="mt-2"></div> <!-- Exibição do nome do arquivo selecionado -->

                <input type="text" name="cor_principal" placeholder="cor principal" required>
                <!-- Campo para cor principal -->

                <input type="number" name="preco" step="0.01" placeholder="preco" required>
                <!-- Campo para preço do produto -->

                <input type="number" name="estoque" placeholder="estoque" required>
                <!-- Campo para estoque do produto -->

                <button type="submit" class="flat">Adicionar Item</button> <!-- Botão para submeter adição -->
            </form>
        </div>
    </div>

    <?php
    // Inclui arquivos PHP para editar camisas e logos, e o rodapé da página
    include("includes/edit-camisas.php");
    include("includes/edit-logos.php");
    include("includes/footer.html");
    ?>

    <script>
        // Função para exibir modal de confirmação de exclusão
        function Delete(id_produto) {
            $('#modalDeleteLabel').html('Você tem certeza que deseja deletar este produto?'); // Mensagem de confirmação
            $('#deleteModal').modal('show'); // Exibe o modal de exclusão
            document.getElementById('confirmDeleteBtn').onclick = function () {
                DeleteProduct(id_produto); // Chama função para excluir produto se confirmado
            };
        }

        // Função para exibir modal de atualização com dados do produto
        function Update(id_produto) {
            $('#modalUpdateLabel').html('PRODUTO'); // Define o título do modal
            document.getElementById("id_produto").value = id_produto; // Preenche o ID do produto no campo
            $('#updateModal').modal('show'); // Exibe o modal de atualização
        }

        // Função para excluir produto via AJAX
        function DeleteProduct(id_produto) {
            $.ajax({
                url: 'models/product/delete_produto.php', // URL do script PHP para exclusão
                type: 'POST', // Método POST para enviar dados
                data: { id_produto: id_produto }, // Dados a serem enviados
                success: function (response) {
                    $('#modalLabel').html(response); // Exibe resposta do servidor
                    $('#resultadoModal').modal('show'); // Exibe modal com resultado
                },
                error: function () {
                    $('#modalLabel').html('Erro ao enviar os dados.'); // Mensagem de erro
                    $('#resultadoModal').modal('show'); // Exibe modal de erro
                }
            });
        }

        // Função para exibir nome do arquivo selecionado no upload
        document.getElementById('imageUpload').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'Nenhum arquivo selecionado'; // Obtém o nome do arquivo
            document.getElementById('fileName').textContent = fileName; // Exibe o nome do arquivo
        });

        // Função para exibir nome do arquivo selecionado no upload de atualização
        document.getElementById('imageUpload-update').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'Nenhum arquivo selecionado'; // Obtém o nome do arquivo
            document.getElementById('fileName-update').textContent = fileName; // Exibe o nome do arquivo
        });

        // Ao carregar a página, configura o formulário de adição de produto
        $(document).ready(function () {
            $('#meuForm').on('submit', function (event) {
                event.preventDefault(); // Previne o comportamento padrão do formulário

                var formData = new FormData(this); // Cria um objeto FormData com os dados do formulário

                // Faz uma requisição AJAX para adicionar um novo produto
                $.ajax({
                    url: 'models/product/add_produto.php', // URL do script PHP para adição
                    type: 'POST', // Método POST para enviar dados
                    data: formData, // Dados a serem enviados
                    processData: false, // Não processar os dados
                    contentType: false, // Não definir cabeçalho de tipo de conteúdo
                    success: function (response) {
                        $('#modalLabel').html(response); // Exibe resposta do servidor
                        $('#resultadoModal').modal('show'); // Exibe modal com resultado
                    },
                    error: function () {
                        $('#modalLabel').html('Erro ao enviar os dados.'); // Mensagem de erro
                        $('#resultadoModal').modal('show'); // Exibe modal de erro
                    }
                });
            });
        });

        // Ao carregar a página, configura o formulário de atualização de produto
        $(document).ready(function () {
            $('#updateForm').on('submit', function (event) {
                event.preventDefault(); // Previne o comportamento padrão do formulário

                var formData = new FormData(this); // Cria um objeto FormData com os dados do formulário

                // Faz uma requisição AJAX para atualizar um produto
                $.ajax({
                    url: 'models/product/atualizar_produto.php', // URL do script PHP para atualização
                    type: 'POST', // Método POST para enviar dados
                    data: formData, // Dados a serem enviados
                    processData: false, // Não processar os dados
                    contentType: false, // Não definir cabeçalho de tipo de conteúdo
                    success: function (response) {
                        $('#modalLabel').html(response); // Exibe resposta do servidor
                        $('#resultadoModal').modal('show'); // Exibe modal com resultado
                    },
                    error: function () {
                        $('#modalLabel').html('Erro ao enviar os dados.'); // Mensagem de erro
                        $('#resultadoModal').modal('show'); // Exibe modal de erro
                    }
                });
            });
        });
    </script>

    <!-- Scripts para animações e ícones -->
    <script src="assets/js/user-animation.js"></script> <!-- Animações de usuário -->
    <script src="assets/js/nav-animation.js"></script> <!-- Animações de navegação -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <!-- Importa ícones do Ionicons -->
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Importa ícones para navegadores sem suporte a módulos -->
</body>

</html>