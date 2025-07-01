<?php require_once '../conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Animais</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>🐕 Lista de Animais</h1>
        <a href="../index.php" class="btn">← Voltar ao Início</a>
        <a href="adicionar.php" class="btn btn-success">+ Adicionar Animal</a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['erro'])): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($_GET['erro']); ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Espécie</th>
                <th>Raça</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM animais ORDER BY id DESC");
            while ($animal = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>{$animal['id']}</td>";
                echo "<td>{$animal['nome']}</td>";
                echo "<td>{$animal['especie']}</td>";
                echo "<td>{$animal['raca']}</td>";
                echo "<td>{$animal['idade']} anos</td>";
                echo "<td>" . ($animal['sexo'] == 'M' ? 'Macho' : 'Fêmea') . "</td>";
                echo "<td><span class='status-{$animal['status']}'>" . ucfirst($animal['status']) . "</span></td>";
                echo "<td>";
                echo "<a href='editar.php?id={$animal['id']}' class='btn btn-warning'>Editar</a>";
                echo "<a href='deletar.php?id={$animal['id']}' class='btn btn-danger' onclick='return confirm(\"Tem certeza?\")'>Deletar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>