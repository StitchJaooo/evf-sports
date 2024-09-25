<?php

include('protect.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVF SPORTS</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black:regular" rel="stylesheet" />
</head>
<body>
    <p>Você logou!!<?php echo $_SESSION['nome']; ?></p>
    
    <p>
        <a href="logout.php">Sair</a>
    </p>
</body>
</html>