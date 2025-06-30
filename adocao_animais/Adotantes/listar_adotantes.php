<?php
include '../conexao.php';
?>
<link rel="stylesheet" href="../Estilo/style.css">

<h1>Lista de Adotantes</h1>
<a href="cadastrar_adotante.php">Cadastrar Novo Adotante</a>
<table border="1">
    <tr>
        <th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th>
    </tr>
    <?php
    $resultado = $conexao->query("SELECT * FROM adotantes");
    while ($adotante = $resultado->fetch_assoc()):
    ?>
    <tr>
        <td><?= $adotante['id'] ?></td>
        <td><?= $adotante['nome'] ?></td>
        <td><?= $adotante['email'] ?></td>
        <td><?= $adotante['telefone'] ?></td>
        <td>
            <a href="editar_adotante.php?id=<?= $adotante['id'] ?>">Editar</a> |
            <a href="excluir_adotante.php?id=<?= $adotante['id'] ?>" onclick="return confirm('Deseja excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
