<?php
include '../conexao.php';
?>
<link rel="stylesheet" href="../Estilo/style.css">

<h1>Lista de Animais para Adoção</h1>
<a href="cadastrar_animal.php">Cadastrar Novo Animal</a>
<table border="1">
    <tr>
        <th>ID</th><th>Nome</th><th>Espécie</th><th>Idade</th><th>Descrição</th><th>Ações</th>
    </tr>
    <?php
    $sql = "SELECT * FROM animais";
    $resultado = $conexao->query($sql);
    while ($linha = $resultado->fetch_assoc()):
    ?>
    <tr>
        <td><?= $linha['id'] ?></td>
        <td><?= $linha['nome'] ?></td>
        <td><?= $linha['especie'] ?></td>
        <td><?= $linha['idade'] ?> anos</td>
        <td><?= $linha['descricao'] ?></td>
        <td>
            <a href="editar_animal.php?id=<?= $linha['id'] ?>">Editar</a> |
            <a href="excluir_animal.php?id=<?= $linha['id'] ?>" onclick="return confirm('Deseja excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
