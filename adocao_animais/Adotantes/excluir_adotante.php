<?php
include '../conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM adotantes WHERE id=$id";
$conexao->query($sql);

header("Location: listar_adotantes.php");
exit;
