<?php
include('conexao.php');

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

$nomecad = $_POST['nomecad'];
$emailcad = $_POST['emailcad'];
$senhacad = $_POST['senhacad'];

$senhacad_hash = password_hash($senhacad, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (nome, email, senha, perfil) VALUES ('$nomecad', '$emailcad', '$senhacad_hash', 'USR')";

$response = []; // Inicializa a variável de resposta

if ($mysqli->query($sql) === TRUE) {
    $response['status'] = 'success';
    $response['message'] = "Cadastro realizado com sucesso!";
} else {
    $response['status'] = 'error';
    $response['message'] = "Erro: " . $sql . ", " . $mysqli->error;
}

$mysqli->close();

// Retorna a resposta em formato JSON
echo json_encode($response);
?>
