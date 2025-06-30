<?php
$servername = "127.0.0.1";    // ou "localhost"
$username   = "root";
$password   = "root";             // root não tem senha no seu XAMPP
$dbname     = "bd_adocao";
$port       = 3306;           // porta padrão do MySQL no XAMPP (mudei de 3307 para 3306)

// Cria a conexão especificando a porta
$conexao = new mysqli($servername, $username, $password, $dbname, $port);

// Verifica conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Define charset para UTF-8
$conexao->set_charset("utf8");
?>