<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_animal = $_POST['id_animal'];
    $id_adotante = $_POST['id_adotante'];
    $data = $_POST['data_adocao'];

    $sql = "INSERT INTO adocoes (id_animal, id_adotante, data_adocao) VALUES ($id_animal, $id_adotante, '$data')";
    $conexao->query($sql);
    header("Location: listar_adocoes.php");
    exit;
}

// buscar animais
$animais = $conexao->query("SELECT * FROM animais");

// buscar adotantes
$adotantes = $conexao->query("SELECT * FROM adotantes");
?>
<link rel="stylesheet" href="../Estilo/style.css">

<h1>Registrar Adoção</h1>
<form method="post">
    Animal:
    <select name="id_animal" required>
        <option value="">Selecione</option>
        <?php while ($a = $animais->fetch_assoc()): ?>
            <option value="<?= $a['id'] ?>"><?= $a['nome'] ?> (<?= $a['especie'] ?>)</option>
        <?php endwhile; ?>
    </select><br>

    Adotante:
    <select name="id_adotante" required>
        <option value="">Selecione</option>
        <?php while ($u = $adotantes->fetch_assoc()): ?>
            <option value="<?= $u['id'] ?>"><?= $u['nome'] ?></option>
        <?php endwhile; ?>
    </select><br>

    Data da Adoção:
    <input type="date" name="data_adocao" required><br>

    <input type="submit" value="Registrar">
</form>
