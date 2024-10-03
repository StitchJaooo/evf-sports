<?php
include("conexao.php");
include("protect.php");

// Receber os dados da requisição
$data = json_decode(file_get_contents("php://input"));
$idUsuario = $_SESSION["id_usuario"];

if (isset($data->id)) {
    $id = intval($data->id); // Converte o ID para inteiro para segurança

    // Preparar a consulta de exclusão
    $stmt = $mysqli->prepare("DELETE FROM carrinho WHERE id_produto = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id, $idUsuario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID não fornecido']);
}

$mysqli->close();
?>