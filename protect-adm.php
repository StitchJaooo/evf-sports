<?php

session_start();

if(!isset($_SESSION['nome']) && $_SESSION['perfil'] == 'USR') {
    die(include("erro-401.php"));
}

?>
