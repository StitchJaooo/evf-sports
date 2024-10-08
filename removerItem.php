<?php
include("conexao.php");
include("protect.php");

// Receber os dados da requisição
$data = json_decode(file_get_contents("php://input"));
$idUsuario = $_SESSION["id_usuario"];

if (isset($data->id)) {
    $id = intval($data->id); // Converte o ID para inteiro para segurança

    // Preparar e executar a consulta para obter o estoque do produto
    $estoqueStmt = $mysqli->prepare("SELECT estoque FROM produtos WHERE id_produto = ?");
    $estoqueStmt->bind_param("i", $id);
    $estoqueStmt->execute();
    $estoqueStmt->bind_result($estoqueAntigo);
    $estoqueStmt->fetch();
    $estoqueStmt->close();

    // Preparar e executar a consulta para obter a quantidade no carrinho
    $checkStmt = $mysqli->prepare("SELECT quantidade FROM carrinho WHERE id_produto = ? AND id_usuario = ?");
    $checkStmt->bind_param("ii", $id, $idUsuario);
    $checkStmt->execute();
    $checkStmt->bind_result($currentQtd);
    $checkStmt->fetch();
    $checkStmt->close();

    // Calcular o novo estoque
    $estoqueNovo = $estoqueAntigo + $currentQtd;

    // Atualizar o estoque
    $stmt2 = $mysqli->prepare("UPDATE produtos SET estoque = ? WHERE id_produto = ?");
    $stmt2->bind_param("ii", $estoqueNovo, $id);
    
    if ($stmt2->execute()) {
        // echo json_encode(['success' => true, 'message' => 'Estoque atualizado com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt2->error]);
    }
    $stmt2->close();

    $stmt = $mysqli->prepare("DELETE FROM carrinho WHERE id_produto = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id, $idUsuario);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID não fornecido']);
}

$mysqli->close();
?>