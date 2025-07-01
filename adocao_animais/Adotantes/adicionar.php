<?php
require_once '../conexao.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO adotantes (nome, email, telefone, endereco, cpf) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$nome, $email, $telefone, $endereco, $cpf])) {
            header('Location: listar.php?msg=Adotante adicionado com sucesso!');
            exit;
        }
    } catch (PDOException $e) {
        $erro = "Erro ao cadastrar adotante. Verifique se o email ou CPF já não estão cadastrados.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Adotante</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>➕ Adicionar Novo Adotante</h1>
        <a href="listar.php" class="btn">← Voltar à Lista</a>
    </div>

    <?php if (isset($erro)): ?>
        <div class="alert alert-error"><?php echo $erro; ?></div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required value="<?php echo $_POST['nome'] ?? ''; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo $_POST['email'] ?? ''; ?>">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(11) 99999-9999" value="<?php echo $_POST['telefone'] ?? ''; ?>">
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required value="<?php echo $_POST['cpf'] ?? ''; ?>">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <textarea id="endereco" name="endereco" placeholder="Rua, número, bairro, cidade..."><?php echo $_POST['endereco'] ?? ''; ?></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-large">Salvar Adotante</button>
        </form>
    </div>
</body>
</html>