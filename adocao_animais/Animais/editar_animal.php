<?php
include '../conexao.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $idade = $_POST['idade'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE animais SET nome='$nome', especie='$especie', idade=$idade, descricao='$descricao' WHERE id=$id";
    $conexao->query($sql);
    header("Location: listar_animais.php");
    exit;
}

$sql = "SELECT * FROM animais WHERE id=$id";
$resultado = $conexao->query($sql);
$animal = $resultado->fetch_assoc();
?>
<link rel="stylesheet" href="../Estilo/style.css">

<h1>Editar Animal</h1>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= $animal['nome'] ?>" required><br>
    Espécie: <input type="text" name="especie" value="<?= $animal['especie'] ?>" required><br>
    Idade: <input type="number" name="idade" value="<?= $animal['idade'] ?>" required><br>
    Descrição: <textarea name="descricao"><?= $animal['descricao'] ?></textarea><br>
    <input type="submit" value="Atualizar">
</form>
