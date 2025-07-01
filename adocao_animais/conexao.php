<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'bd_adocao';
$username = 'root';
$password = '';
$port = '3307';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
