<?php
include '../conexao.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE adotantes SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id";
    $conexao->query($sql);
    header("Location: listar_adotantes.php");
    exit;
}

$sql = "SELECT * FROM adotantes WHERE id=$id";
$resultado = $conexao->query($sql);
$adotante = $resultado->fetch_assoc();
?>
<link rel="stylesheet" href="../Estilo/style.css">

<h1>Editar Adotante</h1>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= $adotante['nome'] ?>" required><br>
    E-mail: <input type="email" name="email" value="<?= $adotante['email'] ?>" required><br>
    Telefone: <input type="text" name="telefone" value="<?= $adotante['telefone'] ?>" required><br>
    <input type="submit" value="Atualizar">
</form>
