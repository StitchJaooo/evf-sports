
<?php

session_start();

if(!isset($_SESSION['nome'])) {
    die(include("erro-401.php"));
}

?>

