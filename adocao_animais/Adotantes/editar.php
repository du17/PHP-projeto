<?php
require_once '../conexao.php';

$id = $_GET['id'] ?? 0;

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    
    try {
        $stmt = $pdo->prepare("UPDATE adotantes SET nome=?, email=?, telefone=?, endereco=?, cpf=? WHERE id=?");
        
        if ($stmt->execute([$nome, $email, $telefone, $endereco, $cpf, $id])) {
            header('Location: listar.php?msg=Adotante atualizado com sucesso!');
            exit;
        }
    } catch (PDOException $e) {
        $erro = "Erro ao atualizar adotante. Verifique se o email ou CPF já não estão cadastrados.";
    }
}

$stmt = $pdo->prepare("SELECT * FROM adotantes WHERE id = ?");
$stmt->execute([$id]);
$adotante = $stmt->fetch();

if (!$adotante) {
    header('Location: listar.php?erro=Adotante não encontrado!');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Adotante</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>✏️ Editar Adotante: <?php echo htmlspecialchars($adotante['nome']); ?></h1>
        <a href="listar.php" class="btn">← Voltar à Lista</a>
    </div>

    <?php if (isset($erro)): ?>
        <div class="alert alert-error"><?php echo $erro; ?></div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required value="<?php echo htmlspecialchars($adotante['nome']); ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($adotante['email']); ?>">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($adotante['telefone']); ?>">
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required value="<?php echo htmlspecialchars($adotante['cpf']); ?>">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <textarea id="endereco" name="endereco"><?php echo htmlspecialchars($adotante['endereco']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-warning btn-large">Atualizar Adotante</button>
        </form>
    </div>
</body>
</html>