<?php
include("conexao.php");
include("protect.php");

// Receber os dados da requisição

$idProduto = 0; // Inicializa a variável
$quantidade = 0; // Inicializa a variável

$data = json_decode(file_get_contents("php://input"));
$idUsuario = $_SESSION["id_usuario"];

if (isset($data->id)) {
    $id = intval($data->id); // Converte o ID para inteiro para segurança

    // Preparar a consulta de exclusão
    if (isset($data->qtd)) {
        $qtd = intval($data->qtd); // Converte a quantidade para inteiro para segurança

        if ($qtd == 1) {
            // Aumenta a quantidade no carrinho
            $checkStockStmt = $mysqli->prepare("SELECT estoque FROM produtos WHERE id_produto = ?");
            $checkStockStmt->bind_param("i", $id);
            $checkStockStmt->execute();
            $checkStockStmt->bind_result($stock);
            $checkStockStmt->fetch();
            $checkStockStmt->close();

            if ($stock > 0) {
                $stmt = $mysqli->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_produto = ? AND id_usuario = ?");
                $stmt2 = $mysqli->prepare("UPDATE produtos SET estoque = estoque - 1 WHERE id_produto = ?");
                $stmt2->bind_param("i", $id);
                
                // Executa as consultas
                $stmt->bind_param("ii", $id, $idUsuario);
                if ($stmt->execute() && $stmt2->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => $stmt->error]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Estoque insuficiente']);
            }
        } else {
            // Diminui a quantidade no carrinho
            
            $checkStmt = $mysqli->prepare("SELECT quantidade FROM carrinho WHERE id_produto = ? AND id_usuario = ?");
            $checkStmt->bind_param("ii", $id, $idUsuario);
            $checkStmt->execute();
            $checkStmt->bind_result($currentQty);
            $checkStmt->fetch();
            $checkStmt->close();
            if ($currentQty > 1) {
                // Atualiza o estoque
                $stmt = $mysqli->prepare("UPDATE carrinho SET quantidade = quantidade - 1 WHERE id_produto = ? AND id_usuario = ?");
                $stmt2 = $mysqli->prepare("UPDATE produtos SET estoque = estoque + 1 WHERE id_produto = ?");
                $stmt2->bind_param("i", $id);
                $stmt2->execute();
                $stmt2->close();
            }

            // Executa a atualização do carrinho
            $stmt->bind_param("ii", $id, $idUsuario);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => $stmt->error]);
            }
        }

        $stmt->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID não fornecido']);
}

$mysqli->close();
?>