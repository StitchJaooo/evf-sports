<?php
use LDAP\Result;
include("protect.php");
include("conexao.php");

if (isset($_POST['quantidade'])) {
    $quantidade = intval($_POST['quantidade']); // Obtém a quantidade e a converte para um inteiro
}
if (isset($_POST['id_produto'])) {
    $idProduto = intval($_POST['id_produto']); // Obtém o ID do produto
}
$idUsuario = $_SESSION['id_usuario'];

if ($idProduto > 0) {

    // Verificando se o produto já está no carrinho
    $sqlCheck = "SELECT quantidade FROM carrinho WHERE id_usuario = ? AND id_produto = ?";
    $stmtCheck = $mysqli->prepare($sqlCheck);
    $stmtCheck->bind_param("ii", $idUsuario, $idProduto);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        // Produto já existe no carrinho, atualizar quantidade
        $stmtCheck->bind_result($quantidadeExistente);
        $stmtCheck->fetch();

        // Atualizando a quantidade
        $novaQuantidade = $quantidadeExistente + $quantidade; // Somando a nova quantidade
        $sqlUpdate = "UPDATE carrinho SET quantidade = ? WHERE id_usuario = ? AND id_produto = ?";
        $stmtUpdate = $mysqli->prepare($sqlUpdate);
        $stmtUpdate->bind_param("iii", $novaQuantidade, $idUsuario, $idProduto);

        if ($stmtUpdate->execute()) {
            echo "Quantidade atualizada com sucesso.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erro ao atualizar a quantidade: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();
    } else {
        // Produto não existe no carrinho, inserir novo registro
        $sqlInsert = "INSERT INTO carrinho (id_usuario, id_produto, quantidade) VALUES (?, ?, ?)";
        $stmtInsert = $mysqli->prepare($sqlInsert);
        $stmtInsert->bind_param("iii", $idUsuario, $idProduto, $quantidade);

        if ($stmtInsert->execute()) {
            echo "Produto adicionado ao carrinho.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erro ao adicionar item: " . $stmtInsert->error;
        }

        $stmtInsert->close();
    }

    $stmtCheck->close();
}
$idProduto=0;
$quantidade=0;

$sqlVerificaUsuario = "SELECT COUNT(*) FROM `carrinho` WHERE id_usuario = " . $idUsuario;

if ($sqlVerificaUsuario > 0) {
    $sql_select = "SELECT c.id_usuario, u.nome, p.*, c.quantidade FROM carrinho c, usuarios u, produtos p WHERE c.id_usuario = u.ID AND c.id_produto = p.id_produto AND c.id_usuario = " . $idUsuario;
    $produtosCarrinho = $mysqli->query($sql_select);

    while ($dados_produtos = mysqli_fetch_assoc($produtosCarrinho)) {
        echo "<div class='card'>";
        echo "<img src=\"" . $dados_produtos['imagem'] . "\" alt='Imagem do Card' class='card-img'>";
        echo "<div class='card-body'>";
        echo "<h2 class='card-title'>" . $dados_produtos['nome'] . " - " . $dados_produtos['cor_principal'] . "</h2>";
        echo "<h2 class='card-price'>R$" . $dados_produtos['preco'] . "</h2>";
        echo "<p>Quantidade: " . $dados_produtos['quantidade'] . "</p>"; // Exibindo a quantidade
        echo "<button id=\"remover\" onclick=\"removerItem(" . $dados_produtos["id_produto"] . ")\">REMOVER</button>";
        echo "<button id=\"aumentar\" onclick=\"aumentarItem(" . $dados_produtos["id_produto"] . ")\">+</button>";
        if($dados_produtos['quantidade'] == 1) {
            echo "<button id=\"diminuir\" disabled \">-</button>";
        } else {
            echo "<button id=\"diminuir\" onclick=\"diminuirItem(" . $dados_produtos["id_produto"] . ")\">-</button>";
        }
        echo "</div>";
        echo "</div>";
    }
} else {
    echo ("Carrinho Vazio");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVF SPORTS</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
</head>

<body>
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
    </script>
</body>

</html>