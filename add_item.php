<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $tipo = $_POST['classificacao'];
    $ano = $_POST['ano'];
    $cor_principal = $_POST['cor_principal'];
    $preco = $_POST['preco'];
    
    $imagem_dir = 'assets/';
    $imagem_path = $imagem_dir . basename($_FILES['imagem']['name']);
    
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_path)) {
        $sql = "INSERT INTO produtos (nome, classificacao, ano, cor_principal, preco, imagem) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssisss", $nome, $tipo, $ano, $cor_principal, $preco, $imagem_path);
        
        if ($stmt->execute()) {
            echo "Item adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar item: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
}

$mysqli->close();
?>