<?php require_once '../conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Adotantes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>👥 Lista de Adotantes</h1>
        <a href="../index.php" class="btn">← Voltar ao Início</a>
        <a href="adicionar.php" class="btn btn-success">+ Adicionar Adotante</a>
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
                <th>Email</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Data Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM adotantes ORDER BY id DESC");
            while ($adotante = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>{$adotante['id']}</td>";
                echo "<td>{$adotante['nome']}</td>";
                echo "<td>{$adotante['email']}</td>";
                echo "<td>{$adotante['telefone']}</td>";
                echo "<td>{$adotante['cpf']}</td>";
                echo "<td>" . date('d/m/Y', strtotime($adotante['data_cadastro'])) . "</td>";
                echo "<td>";
                echo "<a href='editar.php?id={$adotante['id']}' class='btn btn-warning'>Editar</a>";
                echo "<a href='deletar.php?id={$adotante['id']}' class='btn btn-danger' onclick='return confirm(\"Tem certeza?\")'>Deletar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>