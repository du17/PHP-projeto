<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $idade = $_POST['idade'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO animais (nome, especie, idade, descricao) VALUES ('$nome', '$especie', $idade, '$descricao')";
    $conexao->query($sql);
    header("Location: listar_animais.php");
    exit;
}
?>
<link rel="stylesheet" href="../Estilo/style.css">

<h1>Cadastrar Animal</h1>
<form method="post">
    Nome: <input type="text" name="nome" required><br>
    Espécie: <input type="text" name="especie" required><br>
    Idade: <input type="number" name="idade" required><br>
    Descrição: <textarea name="descricao"></textarea><br>
    <input type="submit" value="Salvar">
</form>
