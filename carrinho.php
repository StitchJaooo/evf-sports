<?php
include("protect.php");
include("conexao.php");

$response = [];

$idUsuario = $_SESSION['id_usuario'];

$sql_select = "SELECT c.id_produto, c.id_usuario, u.nome, p.*, c.quantidade FROM carrinho c, usuarios u, produtos p WHERE c.id_usuario = u.ID AND c.id_produto = p.id_produto AND c.id_usuario = ?";
$stmt = $mysqli->prepare($sql_select);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$produtosCarrinho = $stmt->get_result();

$subtotal = 0;
$calculo = 0;
$checkCarrinho = $mysqli->prepare("SELECT * FROM carrinho WHERE id_usuario = ?");
$checkCarrinho->bind_param("i", $idUsuario);
$checkCarrinho->execute();
$result = $checkCarrinho->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $checkPreco = $mysqli->prepare("SELECT preco FROM produtos WHERE id_produto = ?");
        $checkPreco->bind_param("i", $row['id_produto']);
        $checkPreco->execute();
        $checkPreco->bind_result($preco);
        $checkPreco->fetch();
        $checkPreco->close();

        $preco = intval($preco);
        $qtd = intval($row['quantidade']);
        $calculo += $preco * $qtd;
    }
    $subtotal = number_format($calculo, 2);
}

$valorCupom = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $getCupom = $_POST['cupom'];
    $cupom_maiusculo = strtoupper($getCupom);

    $checkCupomExists = $mysqli->prepare("SELECT * FROM cupons WHERE nomeCupom = ?");
    $checkCupomExists->bind_param("s", $cupom_maiusculo);
    $checkCupomExists->execute();
    $resultado = $checkCupomExists->get_result();

    if ($resultado->num_rows > 0) {
        $checkCupomValido = $mysqli->prepare("SELECT valido FROM cupons WHERE nomeCupom = ?");
        $checkCupomValido->bind_param("s", $cupom_maiusculo);
        $checkCupomValido->execute();
        $checkCupomValido->bind_result($valido);
        $checkCupomValido->fetch();
        $checkCupomValido->close();

        if ($valido == 1) {
            $checkCupom = $mysqli->prepare("SELECT valor FROM cupons WHERE nomeCupom = ?");
            $checkCupom->bind_param("s", $cupom_maiusculo);
            $checkCupom->execute();
            $checkCupom->bind_result($valorCupom);
            $checkCupom->fetch();
            $checkCupom->close();
            $valorCupom = number_format($valorCupom, 2);
        } else {
            $response['status'] = 'error';
            $response['message'] = "Cupom não é valido.";
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = "Cupom não encontrado.";
    }
}

$calculoFrete = 30;
$frete = number_format($calculoFrete, 2, ',', '.');

$calculoTotal = $calculo + $calculoFrete - $valorCupom;
$total = number_format($calculoTotal, 2, ',', '.');

// Chave PIX
$pixKey = "chavePix"; // Substitua pela sua chave PIX

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVF SPORTS</title>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .main {
            display: flex;
            flex-direction: column;
            justify-content: start;
            width: 80vw;
            height: auto;
            margin-top: 19.5vh;
            padding: 0vh 10vw 0vh 10vw;
            /* background-color: gray; */
            position: relative;
            color: #000;
        }


        .main-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            height: 15vh;
            margin-bottom: 5vh;
        }

        .main h1 {
            padding: 5px 35px 5px 35px;
            color: #12229d;
            font: 2.3rem 'OpenSauceBold';
            letter-spacing: -2px;
            border-bottom: 3px solid #cae8ff;
        }

        table,
        td,
        th {
            border: 1px solid #e6e6e6;
            border-collapse: collapse;
            background-color: #fff;
            font: 1rem 'OpenSauceRegular';
        }

        .tabelas {
            width: 80vw;
            background-color: #fff;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            position: relative;
        }

        /* Tabela do carrinho */
        .produtos {
            width: 40vw;
            height: 28vh;
        }

        .produtos img {
            width: 100%;
            height: auto;
            aspect-ratio: 1;
            object-fit: cover;
            cursor: pointer;
        }

        .produtos img:active {
            background-color: #fff;
            border: 1px solid #e6e6e6;
            transform: scale(1.3);
            z-index: 3;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2);
        }

        .produtos th {
            position: sticky;
            top: 0px;
            /* top: 15vh; */
        }

        th {
            background-color: #e6e6e6;
            width: auto;
            height: 7vh;
            padding: 0px 15px 0px 15px;
            user-select: none;
        }

        td {
            width: 11vw;
            text-align: center;
        }

        .viewProduct {
            width: 18vw;
            user-select: none;
        }

        .nameProduct {
            width: 42vw;
        }


        .cost {
            width: 18vw;
        }

        .quantity {
            width: 11vw;
        }

        /* Tabela de pagamento */
        .pagamento {
            width: 30vw;
            height: 35vh;
            text-align: left;
        }

        .pagamento td {
            padding-left: 15px;
            border: none;
            text-align: left;
            font: 1rem 'OpenSauceBold';
        }

        .pagamento tr {
            border: 1px solid #e6e6e6;
        }

        .trCupom {
            color: #737373;
        }

        /* Área Cupom e Pagamento */

        button {
            width: 10vw;
            height: 6vh;
            background-color: #06168f;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'OpenSauceBold';
        }

        .areaPagamento {
            height: 45vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: end;
            /* background: red; */
            position: sticky;
            top: 20vh;
            /* top: 35vh; */
        }

        .areaCupom {
            width: 15vw;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-top: 20px;
            padding: 15px;
            background-color: #ffffff00;
            backdrop-filter: blur(5px);
            border-radius: 20px;
            font: 1rem 'OpenSauceRegular';
            position: sticky;
            bottom: 0px;
        }

        #cupom {
            width: auto;
            height: 5vh;
            margin: 10px 0px;
            border: 1px solid #737373;
            border-radius: 8px;
            outline: none;
        }

        #aplicar {
            width: 7vw;
            height: 5vh;
        }

        footer {
            height: 50vh;
        }

        nav {
            margin-top: -15vh;
        }

        #botoes {
            display: flex;
            width: 100%;
            margin-top: 10px;
            justify-content: center;
            align-items: center;
        }

        .atualizar {
            border: none;
            cursor: pointer;
            background-color: none;
            font-size: 1.8rem;
            margin: 0 10px -20px 10px;
        }

        .mais {
            color: #233dff;
        }

        .menos {
            font-size: 2.8rem;
            color: red;
        }

        header {
            animation: none;
        }

        .modal {
            color: #000;
        }

        .delete {
            /* Alinha os itens verticalmente */
            border: 3px solid red;
            /* Borda vermelha */
            background-color: red;
            /* Cor de fundo vermelha */
        }

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

        .delete:hover {
            box-shadow: 0px 0px 10px 4px red;
            /* Sombra no hover */
        }


        @media all and (max-width: 600px) {

            .main,
            .produtos,
            .tabelas {
                width: 100vw;
            }

            .main {
                margin-top: -2vh;
                padding: 0;
                justify-content: center;
            }

            .tabelas {
                flex-direction: column;
            }

            footer {
                height: 70vh;
            }

            .item-footer h1 {
                width: 80%;
                font-size: 1.8rem;
                margin-left: 4vw
            }

            .item-footer p {
                margin-top: -5px;
                width: 80%;
                margin-left: 5vw
            }

            .card.img {
                height: auto;
            }

            #cupom {
                width: 30vw;
            }

            #aplicar {
                width: 20vw;
            }

            #pagar {
                margin: 20px;
                width: 40vw;
            }

            .areaCupom {
                width: 40vw;
            }

            .areaPagamento {
                margin-top: 20px;
                align-items: center;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php
    include("includes/header-fixo.php"); // Inclui o cabeçalho fixo
    include("includes/nav.html"); // Inclui a navegação
    ?>

    <div class="modal fade" id="pixModal" tabindex="-1" role="dialog" aria-labelledby="pixModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pixModalLabel">Concluir Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Para concluir o pagamento, use a seguinte chave PIX:</p>
                    <h4>PIX FALSO</h4>
                    <h4>R$: <?php echo $total; ?></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="flat delete" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja remover este item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="flat" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="flat delete" id="confirmButton">Remover</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sucesso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Mensagem de sucesso será injetada aqui -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="flat" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Erro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Mensagem de erro será injetada aqui -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="flat delete" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="main">
        <div class="tabelas">
            <table class="produtos">
                <tr class="topoTable">
                    <th id="excluir"></th>
                    <th id="img">Imagem</th>
                    <th id="produto">Produto</th>
                    <th id="preco">Preço</th>
                    <th id="quantidade">Quant.</th>
                </tr>
                <?php
                while ($dados_produtos = mysqli_fetch_assoc($produtosCarrinho)) {
                    echo "<tr>";
                    echo "<td onclick=\"removerItem(" . $dados_produtos['id_produto'] . ")\"><ion-icon name='close-outline'></ion-icon></td>";
                    echo "<td class='viewProduct'><img src='" . $dados_produtos['imagem'] . "' alt='Imagem do Produto'></td>";
                    echo "<td class='nameProduct'>" . $dados_produtos['nome'] . " - " . $dados_produtos['cor_principal'] . "</td>";
                    echo "<td class='cost'>R$" . $dados_produtos['preco'] . "</td>";
                    echo "<td class='quantity'>" . $dados_produtos['quantidade'] . "
                    <div id=\"botoes\">
                    <div class='atualizar menos' onclick=\"diminuirItem(" . $dados_produtos['id_produto'] . ")\">-</div>
                    <div class='atualizar mais' onclick=\"aumentarItem(" . $dados_produtos['id_produto'] . ")\">+</div>
                    </div>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <div class="areaPagamento">
                <table class="pagamento">
                    <tr class="Tilte">
                        <th id="total">Total</th>
                        <th id="valor">Valor</th>
                    </tr>
                    <tr class="subTotal">
                        <td>SUBTOTAL</td>
                        <td id="valorSubTotal"><?php echo $subtotal ?></td>
                    </tr>
                    <tr class="frete">
                        <td>FRETE</td>
                        <td id="valorFrete"><?php echo $frete ?></td>
                    </tr>
                    <tr class="trCupom">
                        <td>CUPOM</td>
                        <td id="tdCupom"><?php echo $valorCupom ?></td>
                    </tr>
                    <tr class="total">
                        <td>TOTAL</td>
                        <td id="valorTotal"><?php echo $total ?></td>
                    </tr>
                </table>

                <button id="pagar" onclick="mostrarInfoPix()">
                    Pagar com PIX
                </button>

                <script>
                    function mostrarInfoPix() {
                        $('#pixModal').modal('show'); 
                    }
                </script>
            </div>
        </div>
    </div>
    </div>
    <div class="areaCupom">
        <form action="carrinho.php" method="POST">
            <label for="cupom">DIGITE SEU CUPOM:</label>
            <input type="text" name="cupom" id="cupom" placeholder="CUPOM">
            <button id="aplicar" onclick="aplicar('cupom')">Aplicar</button>
        </form>
    </div>
    </div>
    <?php
    include("includes/footer.html");
    ?>


    <script src="assets/js/user-animation.js"></script>
    <script src="assets/js/nav-animation.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function removerItem(id) {
            $('#confirmModal').modal('show'); // Exibe o modal de confirmação

            $('#confirmButton').off('click').on('click', function () {
                $.ajax({
                    url: 'models/cart/remove_carrinho.php',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({ id: id }),
                    success: function (data) {
                        if (data.success) {
                            $('#successModal .modal-body').text('Item removido com sucesso!');
                            $('#successModal').modal('show'); // Exibe o modal de sucesso
                            $('#successModal').on('hidden.bs.modal', function () {
                                location.reload();
                            });
                        } else {
                            $('#errorModal .modal-body').text('Erro ao remover o item: ' + data.message);
                            $('#errorModal').modal('show'); // Exibe o modal de erro
                        }
                    },
                    error: function (error) {
                        console.error('Erro:', error);
                        $('#errorModal .modal-body').text('Erro ao processar a solicitação.');
                        $('#errorModal').modal('show');
                    }
                });
            });
        }

        function aumentarItem(id) {
            $.ajax({
                url: 'models/cart/atualizar_carrinho.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({ id: id, qtd: 1 }),
                success: function (data) {
                    if (data.success) {
                        location.reload();
                    } else {
                        $('#errorModal .modal-body').text('Erro ao aumentar o item: ' + data.message);
                        $('#errorModal').modal('show');
                    }
                },
                error: function (error) {
                    console.error('Erro:', error);
                    $('#errorModal .modal-body').text('Erro ao processar a solicitação.');
                    $('#errorModal').modal('show');
                }
            });
        }

        function diminuirItem(id) {
            $.ajax({
                url: 'models/cart/atualizar_carrinho.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({ id: id, qtd: -1 }),
                success: function (data) {
                    if (data.success) {
                        location.reload();
                    } else {
                        $('#errorModal .modal-body').text('Erro ao diminuir o item: ' + data.message);
                        $('#errorModal').modal('show');
                    }
                },
                error: function (error) {
                    console.error('Erro:', error);
                    $('#errorModal .modal-body').text('Erro ao processar a solicitação.');
                    $('#errorModal').modal('show');
                }
            });
        }

    </script>
</body>

</html>