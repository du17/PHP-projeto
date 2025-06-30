<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO adotantes (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";
    $conexao->query($sql);
    header("Location: listar_adotantes.php");
    exit;
}
?>
<link rel="stylesheet" href="../Estilo/style.css">

<h1>Cadastrar Adotante</h1>
<form method="post">
    Nome: <input type="text" name="nome" required><br>
    E-mail: <input type="email" name="email" required><br>
    Telefone: <input type="text" name="telefone" required><br>
    <input type="submit" value="Salvar">
</form>
