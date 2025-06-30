<?php
include '../conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM animais WHERE id=$id";
$conexao->query($sql);

header("Location: listar_animais.php");
exit;
