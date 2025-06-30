<?php
include '../conexao.php';
?>
<link rel="stylesheet" href="../Estilo/style.css">

<h1>Lista de Adoções</h1>
<a href="cadastrar_adocao.php">Registrar Nova Adoção</a>
<table border="1">
    <tr>
        <th>ID</th><th>Animal</th><th>Adotante</th><th>Data</th><th>Ações</th>
    </tr>
    <?php
    $sql = "SELECT adocoes.id, animais.nome AS animal, adotantes.nome AS adotante, adocoes.data_adocao
            FROM adocoes
            JOIN animais ON adocoes.id_animal = animais.id
            JOIN adotantes ON adocoes.id_adotante = adotantes.id";

    $resultado = $conexao->query($sql);
    while ($linha = $resultado->fetch_assoc()):
    ?>
    <tr>
        <td><?= $linha['id'] ?></td>
        <td><?= $linha['animal'] ?></td>
        <td><?= $linha['adotante'] ?></td>
        <td><?= $linha['data_adocao'] ?></td>
        <td>
            <a href="excluir_adocao.php?id=<?= $linha['id'] ?>" onclick="return confirm('Deseja excluir esta adoção?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
