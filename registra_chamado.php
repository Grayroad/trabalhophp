<?php

require_once("db.class.php");
require_once("validador_acesso.php");
//Montando o texto

$titulo = $_POST['titulo'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];
$idUsuario = $_SESSION["id"];

$sql = "INSERT INTO tb_chamado (idUsuario, idCategoria, titulo, descricao) VALUES ($idUsuario, $categoria, '$titulo', '$descricao');";

$objDb = new db();

$linq = $objDb->conecta_mysql();
$resultado_id = mysqli_query($linq, $sql);

//echo $texto;
header('Location: abrir_chamado.php?mensagem=1');
