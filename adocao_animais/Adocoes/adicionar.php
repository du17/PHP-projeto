<?php
require_once '../conexao.php';

if ($_POST) {
    $animal_id = $_POST['animal_id'];
    $adotante_id = $_POST['adotante_id'];
    $data_adocao = $_POST['data_adocao'];
    $observacoes = $_POST['observacoes'];
    
    try {
        $pdo->beginTransaction();
        
        // Inserir a adoção
        $stmt = $pdo->prepare("INSERT INTO adocoes (animal_id, adotante_id, data_adocao, observacoes) VALUES (?, ?, ?, ?)");
        $stmt->execute([$animal_id, $adotante_id, $data_adocao, $observacoes]);
        
        // Atualizar status do animal para adotado
        $stmt_update = $pdo->prepare("UPDATE animais SET status = 'adotado' WHERE id = ?");
        $stmt_update->execute([$animal_id]);
        
        $pdo->commit();
        
        header('Location: listar.php?msg=Adoção registrada com sucesso!');
        exit;
    } catch (Exception $e) {
        $pdo->rollback();
        $erro = "Erro ao registrar adoção: " . $e->getMessage();
    }
}

// Buscar animais disponíveis
$stmt_animais = $pdo->query("SELECT * FROM animais WHERE status = 'disponivel' ORDER BY nome");
$animais = $stmt_animais->fetchAll();

// Buscar adotantes
$stmt_adotantes = $pdo->query("SELECT * FROM adotantes ORDER BY nome");
$adotantes = $stmt_adotantes->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Adoção</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>❤️ Registrar Nova Adoção</h1>
        <a href="listar.php" class="btn">← Voltar à Lista</a>
    </div>

    <?php if (isset($erro)): ?>
        <div class="alert alert-error"><?php echo $erro; ?></div>
    <?php endif; ?>

    <?php if (empty($animais)): ?>
        <div class="alert alert-warning">
            <strong>Atenção:</strong> Não há animais disponíveis para adoção no momento. 
            <a href="../animais/adicionar.php">Cadastre um animal</a> primeiro.
        </div>
    <?php endif; ?>

    <?php if (empty($adotantes)): ?>
        <div class="alert alert-warning">
            <strong>Atenção:</strong> Não há adotantes cadastrados. 
            <a href="../adotantes/adicionar.php">Cadastre um adotante</a> primeiro.
        </div>
    <?php endif; ?>

    <?php if (!empty($animais) && !empty($adotantes)): ?>
    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="animal_id">Animal:</label>
                <select id="animal_id" name="animal_id" required>
                    <option value="">Selecione um animal...</option>
                    <?php foreach ($animais as $animal): ?>
                        <option value="<?php echo $animal['id']; ?>">
                            <?php echo htmlspecialchars($animal['nome']) . " - " . $animal['especie'] . " (" . $animal['raca'] . ")"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="adotante_id">Adotante:</label>
                <select id="adotante_id" name="adotante_id" required>
                    <option value="">Selecione um adotante...</option>
                    <?php foreach ($adotantes as $adotante): ?>
                        <option value="<?php echo $adotante['id']; ?>">
                            <?php echo htmlspecialchars($adotante['nome']) . " - " . $adotante['email']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="data_adocao">Data da Adoção:</label>
                <input type="date" id="data_adocao" name="data_adocao" required value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label for="observacoes">Observações:</label>
                <textarea id="observacoes" name="observacoes" placeholder="Observações sobre a adoção..."></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-large">Registrar Adoção</button>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>