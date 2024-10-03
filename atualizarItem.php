<?php
include("conexao.php");
include("protect.php");

// Receber os dados da requisição
$data = json_decode(file_get_contents("php://input"));
$idUsuario = $_SESSION["id_usuario"];

if (isset($data->id)) {
    $id = intval($data->id); // Converte o ID para inteiro para segurança

    // Preparar a consulta de exclusão

    if (isset($data->qtd)) {
        $qtd = intval($data->qtd); // Converte o ID para inteiro para segurança

        if ($qtd == 1) {
            $stmt = $mysqli->prepare("UPDATE carrinho SET quantidade = quantidade + 1  WHERE id_produto = ? AND id_usuario = ?;");
        } else {
            $stmt = $mysqli->prepare("UPDATE carrinho SET quantidade = quantidade - 1 WHERE id_produto = ? AND id_usuario = ?;");
        }
    }
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