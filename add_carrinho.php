<?php
include("protect.php");
include("conexao.php");
if (!isset($_SESSION['id_usuario'])) {
    echo "Você precisa estar logado para adicionar ao carrinho.";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

if (isset($_POST['id_produto'])) {
    $id_produto = intval($_POST['id_produto']);
    $sql = "SELECT quantidade FROM carrinho WHERE id_usuario = ? AND id_produto = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nova_quantidade = $row['quantidade'] + 1;
        $update_sql = "UPDATE carrinho SET quantidade = ? WHERE id_usuario = ? AND id_produto = ?";
        $stmt = $mysqli->prepare($update_sql);
        $stmt->bind_param("iii", $nova_quantidade, $id_usuario, $id_produto);
        $stmt->execute();
    } else {
        $insert_sql = "INSERT INTO carrinho (id_usuario, id_produto, quantidade) VALUES (?, ?, 1)";
        $stmt = $mysqli->prepare($insert_sql);
        $stmt->bind_param("ii", $id_usuario, $id_produto);
        $stmt->execute();
    }

    echo "Produto adicionado ao carrinho com sucesso!";
} else {
    echo "ID do produto não foi informado.";
}

$mysqli->close();
?>