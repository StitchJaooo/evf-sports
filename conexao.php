<?php

$usuario = 'root';
$senha = '';
$database = 'evfsports';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli-> error){
    die("Falha ao conectar ao banco de dados" . $mysqli->error);
}