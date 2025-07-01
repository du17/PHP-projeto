<?php
require_once '../conexao.php';

$id = $_GET['id'] ?? 0;

if ($_POST) {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = $_POST['idade'];
    $sexo = $_POST['sexo'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    
    $stmt = $pdo->prepare("UPDATE animais SET nome=?, especie=?, raca=?, idade=?, sexo=?, descricao=?, status=? WHERE id=?");
    
    if ($stmt->execute([$nome, $especie, $raca, $idade, $sexo, $descricao, $status, $id])) {
        header('Location: listar.php?msg=Animal atualizado com sucesso!');
        exit;
    }
}

$stmt = $pdo->prepare("SELECT * FROM animais WHERE id = ?");
$stmt->execute([$id]);
$animal = $stmt->fetch();

if (!$animal) {
    header('Location: listar.php?erro=Animal não encontrado!');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>✏️ Editar Animal: <?php echo htmlspecialchars($animal['nome']); ?></h1>
        <a href="listar.php" class="btn">← Voltar à Lista</a>
    </div>

    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($animal['nome']); ?>" required>
            </div>

            <div class="form-group">
                <label for="especie">Espécie:</label>
                <select id="especie" name="especie" required>
                    <option value="Cão" <?php echo $animal['especie'] == 'Cão' ? 'selected' : ''; ?>>Cão</option>
                    <option value="Gato" <?php echo $animal['especie'] == 'Gato' ? 'selected' : ''; ?>>Gato</option>
                    <option value="Coelho" <?php echo $animal['especie'] == 'Coelho' ? 'selected' : ''; ?>>Coelho</option>
                    <option value="Pássaro" <?php echo $animal['especie'] == 'Pássaro' ? 'selected' : ''; ?>>Pássaro</option>
                    <option value="Outro" <?php echo $animal['especie'] == 'Outro' ? 'selected' : ''; ?>>Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="raca">Raça:</label>
                <input type="text" id="raca" name="raca" value="<?php echo htmlspecialchars($animal['raca']); ?>">
            </div>

            <div class="form-group">
                <label for="idade">Idade (anos):</label>
                <input type="number" id="idade" name="idade" value="<?php echo $animal['idade']; ?>" min="0" max="30">
            </div>

            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="M" <?php echo $animal['sexo'] == 'M' ? 'selected' : ''; ?>>Macho</option>
                    <option value="F" <?php echo $animal['sexo'] == 'F' ? 'selected' : ''; ?>>Fêmea</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="disponivel" <?php echo $animal['status'] == 'disponivel' ? 'selected' : ''; ?>>Disponível</option>
                    <option value="adotado" <?php echo $animal['status'] == 'adotado' ? 'selected' : ''; ?>>Adotado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($animal['descricao']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-warning btn-large">Atualizar Animal</button>
        </form>
    </div>
</body>
</html>