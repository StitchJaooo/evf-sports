<?php
include("conexao.php");
if (isset($_POST['id_produto']) && is_numeric($_POST['id_produto'])) {
    $id_produto = intval($_POST['id_produto']);
    $sql = "DELETE FROM produtos WHERE id_produto = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id_produto);
        if ($stmt->execute()) {
            echo "Produto deletado com sucesso.";
        } else {
            echo "Erro ao deletar o produto: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $mysqli->error;
    }
} else {
    echo "ID de produto inválido ou não fornecido.";
}
$mysqli->close();
?>
