<?php
include("../../protect.php");
include("../../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $tipo = $_POST['classificacao'];
    $ano = $_POST['ano'];
    $cor_principal = $_POST['cor_principal'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem_dir = '../../assets/img/';
        $imagem_path = $imagem_dir . basename($_FILES['imagem']['name']);
        
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_path)) {
            $imagem_dir = 'assets/img/';
            $imagem_path = $imagem_dir . basename($_FILES['imagem']['name']);
            $sql = "INSERT INTO produtos (nome, classificacao, ano, cor_principal, preco, imagem, estoque) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssisssi", $nome, $tipo, $ano, $cor_principal, $preco, $imagem_path, $estoque);

                if ($stmt->execute()) {
                    echo "Item adicionado com sucesso!";
                } else {
                    echo "Erro ao adicionar item: " . $stmt->error;
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