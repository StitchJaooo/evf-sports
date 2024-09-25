<?php

session_start();

if(!isset($_SESSION['nome'])) {
    die("<h1>401 - Não Autorizado</h1> <br> Você não pode acessar essa página porque não está logado.<p><a href=\"login.php\">Entrar</a></p>");
}

?>