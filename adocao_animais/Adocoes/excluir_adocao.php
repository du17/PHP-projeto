<?php
include '../conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM adocoes WHERE id=$id";
$conexao->query($sql);

header("Location: listar_adocoes.php");
exit;
