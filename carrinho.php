<?php
include("protect.php");
include("conexao.php");

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

$calculoFrete = 20;
$frete = number_format($calculoFrete, 2);
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

        #botoes{
            display: flex;
            width: 100%;
            margin-top: 10px;
            justify-content: center;
            align-items: center;
        }
        
        .atualizar{
            border: 1px solid gray;
            width: 40%;
            /* flex:0.5; */
            cursor: pointer;
            background-color: #e6e6e6;
        }

        header{
            animation: none;
        }

        @media all and (max-width: 600px) {

            .main,
            .produtos,
            .tabelas {
                width: 100vw;
            }

            .main {
                margin: 18vh 0 0 0;
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

            #cupom{
                width: 30vw;
            }
            #aplicar{
                width: 20vw;
            }
            #pagar {
                margin: 20px;
                width: 40vw;
            }
            .areaCupom{
                width: 40vw;
            }
            .areaPagamento{
                margin-top: 20px;
                align-items: center;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header class="scrolled">
        <ion-icon name="menu" class="nav-menu"></ion-icon>
        <a href="logged.php">
            <img src="assets/logo.png" alt="">
        </a>
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
            <a href="logged.php">
                <li data-section="home" class="selecionado">Home</li>
            </a>
            <div class="borda"></div>
            <a href="logged.php">
                <li data-section="camisas">Camisas</li>
            </a>
            <div class="borda"></div>
            <a href="logged.php">
                <li data-section="logos">Logos</li>
            </a>
            <div class="borda"></div>
            <a href="logged.php">
                <li>Quem Somos</li>
            </a>
            <div class="borda"></div>
        </ul>
    </nav>

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
    <div class="main">
        <div class="tabelas">

            <table class="produtos">
                <tr class="topoTable">
                    <th id="excluir"><!--<ion-icon name="close-outline"></ion-icon>--></th>
                    <th id="img">Imagem</th>
                    <th id="produto">Produto</th>
                    <th id="preco">Preço</th>
                    <th id="quantidade">Quant.</th>
                </tr>
                <?php
                while ($dados_produtos = mysqli_fetch_assoc($produtosCarrinho)) {
                    echo "<tr>";
                    echo "<td><ion-icon name='close-outline'></ion-icon></td>";
                    echo "<td class='viewProduct'><img src='" . $dados_produtos['imagem'] . "' alt='Imagem do Produto'></td>";
                    echo "<td class='nameProduct'>" . $dados_produtos['nome'] . " - " . $dados_produtos['cor_principal'] . "</td>";
                    echo "<td class='cost'>R$" . $dados_produtos['preco'] . "</td>";
                    echo "<td class='quantity'>" . $dados_produtos['quantidade'] . "
                    <div id=\"botoes\">
                    <div class='atualizar' onclick=\"diminuirItem(". $dados_produtos['id_produto'].")\">-</div>
                    <div class='atualizar' onclick=\"aumentarItem(". $dados_produtos['id_produto'].")\">+</div>
                    </div>
                    </td>";                    echo "</tr>";
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
                        <td><?php echo $subtotal ?></td>
                    </tr>
                    <tr class="frete">
                        <td>FRETE</td>
                        <td><?php echo $frete ?></td>
                    </tr>
                    <tr class="trCupom">
                        <td>CUPOM</td>
                        <td id="tdCupom">10.00</td>
                    </tr>
                    <tr class="total">
                        <td>TOTAL</td>
                        <td><?php $total ?></td>
                        </r>
                </table>

                <button id="pagar">
                    Pagar
                </button>

            </div>

        </div>
        <div class="areaCupom">
            <label for="cupom">DIGITE SEU CUPOM:</label>
            <input type="text" name="cupom" id="cupom" placeholder="CUPOM">
            <button id="aplicar" onclick="aplicar('cupom')">Aplicar</button>
        </div>
    </div>
    <footer>
        <div class="infos">
            <div class="item-footer">
                <h1>Sobre nós</h1>
                <p>Somos uma empresa de confecção de camisas e designs, vendemos itens prontos já feitos por
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


    <script src="js/user-animation.js"></script>
    <script src="js/nav-animation.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function removerItem(id) {
            if (confirm("Você tem certeza que deseja remover este item?")) {
                fetch('removerItem.php', { // O arquivo PHP que processará a exclusão
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: id }), // Enviando o ID como JSON
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                            alert("Item removido com sucesso!");
                        } else {
                            alert("Erro ao remover o item: " + data.message);
                        }
                    })
                    .catch((error) => {
                        console.error('Erro:', error);
                    });
            }
        }

        function aumentarItem(id) {
            fetch('atualizarItem.php', { // O arquivo PHP que processará a exclusão
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id, qtd: 1 }), // Enviando o ID como JSON
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert("Erro ao aumentar o item: " + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Erro:', error);
                });
        }

        function diminuirItem(id) {
            fetch('atualizarItem.php', { // O arquivo PHP que processará a exclusão
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id, qtd: -1 }), // Enviando o ID como JSON
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert("Erro ao diminuir o item: " + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Erro:', error);
                });
        }

        function aplicar(id) {
            cupom = document.getElementById(id);
            valor = cupom.value.toUpperCase();
            if (valor === "CUPOM ESPECIAL") {
                alert("Cupom aplicado com sucesso!");
                var tdCupom = document.getElementById("tdCupom");
                tdCupom.innerText = 20.00;
            } else {
                alert("Cupom inválido.");
                }
        }
    </script>
</body>

</html>