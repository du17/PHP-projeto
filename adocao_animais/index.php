<?php require_once 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Adoção de Animais</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <h1>🐾 Sistema de Adoção de Animais</h1>
        <p>Conectando corações e patinhas</p>
    </div>

    <div class="main-menu">
        <div class="menu-item">
            <h3>🐕 Animais</h3>
            <p>Gerencie os animais disponíveis para adoção</p>
            <a href="animais/listar.php" class="btn btn-large">Acessar</a>
        </div>

        <div class="menu-item">
            <h3>👥 Adotantes</h3>
            <p>Cadastre e gerencie os adotantes</p>
            <a href="adotantes/listar.php" class="btn btn-large">Acessar</a>
        </div>

        <div class="menu-item">
            <h3>❤️ Adoções</h3>
            <p>Registre e acompanhe as adoções realizadas</p>
            <a href="adocoes/listar.php" class="btn btn-large">Acessar</a>
        </div>
    </div>

    <div class="card">
        <h2>Sobre o Sistema</h2>
        <p>Este sistema foi desenvolvido para facilitar o processo de adoção de animais, permitindo:</p>
        <ul>
            <li>Cadastro e controle de animais disponíveis</li>
            <li>Gestão de adotantes interessados</li>
            <li>Registro e acompanhamento de adoções</li>
        </ul>
    </div>
</body>
</html>