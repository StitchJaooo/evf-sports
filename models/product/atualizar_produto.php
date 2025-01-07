<?php
include("../../protect.php");
include("../../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = $_POST['idproduto']; // ID do produto a ser atualizado
    $nome = $_POST['nome-update'];
    $tipo = $_POST['classificacao-update'];
    $ano = $_POST['ano-update'];
    $cor_principal = $_POST['cor_principal-update'];
    $preco = $_POST['preco-update'];
    $estoque = $_POST['estoque-update'];

    if (isset($_FILES['imagem-update']) && $_FILES['imagem-update']['error'] === UPLOAD_ERR_OK) {
        $imagem_dir = '../../assets/img/';
        $imagem_path = $imagem_dir . basename($_FILES['imagem-update']['name']);
        
        if (move_uploaded_file($_FILES['imagem-update']['tmp_name'], $imagem_path)) {
            $imagem_dir = 'assets/img/';
            $imagem_path = $imagem_dir . basename($_FILES['imagem-update']['name']);
            // Atualizar o produto com o caminho da nova imagem
            $sql = "UPDATE produtos SET nome=?, classificacao=?, ano=?, cor_principal=?, preco=?, imagem=?, estoque=? WHERE id_produto=?";
            $stmt = $mysqli->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssisssii", $nome, $tipo, $ano, $cor_principal, $preco, $imagem_path, $estoque, $id_produto);

                if ($stmt->execute()) {
                    echo "Produto atualizado com sucesso!";
                } else {
                    echo "Erro ao atualizar produto: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Erro na preparação da consulta: " . $mysqli->error;
            }
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        echo "Erro no arquivo de imagem.";
    }
}
$mysqli->close();
?>