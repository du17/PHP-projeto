<?php require_once '../conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Adoções</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>❤️ Lista de Adoções</h1>
        <a href="../index.php" class="btn">← Voltar ao Início</a>
        <a href="adicionar.php" class="btn btn-success">+ Registrar Adoção</a>
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
                <th>Animal</th>
                <th>Adotante</th>
                <th>Data da Adoção</th>
                <th>Observações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("
                SELECT a.*, 
                       an.nome as animal_nome, an.especie, an.raca,
                       ad.nome as adotante_nome, ad.email
                FROM adocoes a
                JOIN animais an ON a.animal_id = an.id
                JOIN adotantes ad ON a.adotante_id = ad.id
                ORDER BY a.data_adocao DESC
            ");
            
            while ($adocao = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>{$adocao['id']}</td>";
                echo "<td>{$adocao['animal_nome']} ({$adocao['especie']} - {$adocao['raca']})</td>";
                echo "<td>{$adocao['adotante_nome']}<br><small>{$adocao['email']}</small></td>";
                echo "<td>" . date('d/m/Y', strtotime($adocao['data_adocao'])) . "</td>";
                echo "<td>" . (strlen($adocao['observacoes']) > 50 ? substr($adocao['observacoes'], 0, 50) . '...' : $adocao['observacoes']) . "</td>";
                echo "<td>";
                echo "<a href='deletar.php?id={$adocao['id']}' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja cancelar esta adoção?\")'>Cancelar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>