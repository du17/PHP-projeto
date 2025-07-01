<?php
require_once '../conexao.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = $_POST['idade'];
    $sexo = $_POST['sexo'];
    $descricao = $_POST['descricao'];
    
    $stmt = $pdo->prepare("INSERT INTO animais (nome, especie, raca, idade, sexo, descricao) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt->execute([$nome, $especie, $raca, $idade, $sexo, $descricao])) {
        header('Location: listar.php?msg=Animal adicionado com sucesso!');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Animal</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        <h1>➕ Adicionar Novo Animal</h1>
        <a href="listar.php" class="btn">← Voltar à Lista</a>
    </div>

    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="especie">Espécie:</label>
                <select id="especie" name="especie" required>
                    <option value="">Selecione...</option>
                    <option value="Cão">Cão</option>
                    <option value="Gato">Gato</option>
                    <option value="Coelho">Coelho</option>
                    <option value="Pássaro">Pássaro</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="raca">Raça:</label>
                <input type="text" id="raca" name="raca">
            </div>

            <div class="form-group">
                <label for="idade">Idade (anos):</label>
                <input type="number" id="idade" name="idade" min="0" max="30">
            </div>

            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="">Selecione...</option>
                    <option value="M">Macho</option>
                    <option value="F">Fêmea</option>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" placeholder="Descreva o temperamento e características do animal..."></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-large">Salvar Animal</button>
        </form>
    </div>
</body>
</html>