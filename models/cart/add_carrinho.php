<?php
include("../../protect.php");
include("../../conexao.php");
header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON
$response = []; // Inicializa a variável de resposta
if (!isset($_SESSION['id_usuario'])) {
    $response['status'] = 'error';
    $response['message'] = "Você precisa estar logado para adicionar ao carrinho.";
    
}

$id_usuario = $_SESSION['id_usuario'];

if (isset($_POST["quantidade"]) && isset($_POST["id_produto"])) {
    $quantidade = intval($_POST['quantidade']);
    $idProduto = intval($_POST['id_produto']);

    // Verificando o estoque do produto
    $stmt = $mysqli->prepare('SELECT estoque FROM produtos WHERE id_produto = ?');
    $stmt->bind_param("i", $idProduto);
    $stmt->execute();
    $stmt->bind_result($estoque);
    $stmt->fetch();
    $stmt->close();

    if ($estoque === null) {
        $response['status'] = 'error';
        $response['message'] = "Produto não encontrado.";
        
    }

    // Verifica se o estoque é suficiente
    if ($estoque >= $quantidade) {
        // Atualiza o estoque do produto
        $novoEstoque = $estoque - $quantidade;
        $stmtUpdateEstoque = $mysqli->prepare("UPDATE produtos SET estoque = ? WHERE id_produto = ?");
        $stmtUpdateEstoque->bind_param("ii", $novoEstoque, $idProduto);
        $stmtUpdateEstoque->execute();
        $stmtUpdateEstoque->close();

        // Verificando se o produto já está no carrinho
        $sqlCheck = "SELECT quantidade FROM carrinho WHERE id_usuario = ? AND id_produto = ?";
        $stmtCheck = $mysqli->prepare($sqlCheck);
        $stmtCheck->bind_param("ii", $id_usuario, $idProduto);
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
            $stmtUpdate->bind_param("iii", $novaQuantidade, $id_usuario, $idProduto);
            if ($stmtUpdate->execute()) {
                $response['status'] = 'success';
                $response['message'] = "Produto adicionado ao carrinho.";
            } else {
                $response['status'] = 'error';
                $response['message'] = "Erro ao atualizar a quantidade.";
            }
            $stmtUpdate->close();
        } else {
            // Produto não existe no carrinho, inserir novo registro
            $sqlInsert = "INSERT INTO carrinho (id_usuario, id_produto, quantidade) VALUES (?, ?, ?)";
            $stmtInsert = $mysqli->prepare($sqlInsert);
            $stmtInsert->bind_param("iii", $id_usuario, $idProduto, $quantidade);
            if ($stmtInsert->execute()) {
                $response['status'] = 'success';
                $response['message'] = "Produto adicionado ao carrinho.";
            } else {
                $response['status'] = 'error';
                $response['message'] = "Erro ao adicionar item.";
            }
            $stmtInsert->close();
        }
        $stmtCheck->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = "Estoque insuficiente.";
    }
} else {
    $response['status'] = 'error';
    $response['message'] = "ID do produto ou quantidade não foram informados.";
}

echo json_encode($response);

$mysqli->close();
?>
