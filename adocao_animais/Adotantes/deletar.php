<?php
require_once '../conexao.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    // Verificar se o adotante tem adoções
    $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM adocoes WHERE adotante_id = ?");
    $stmt_check->execute([$id]);
    $tem_adocoes = $stmt_check->fetch()['total'] > 0;
    
    if ($tem_adocoes) {
        header('Location: listar.php?erro=Não é possível deletar este adotante pois ele possui adoções registradas!');
        exit;
    }
    
    $stmt = $pdo->prepare("DELETE FROM adotantes WHERE id = ?");
    
    if ($stmt->execute([$id])) {
        header('Location: listar.php?msg=Adotante deletado com sucesso!');
    } else {
        header('Location: listar.php?erro=Erro ao deletar adotante!');
    }
} else {
    header('Location: listar.php?erro=ID inválido!');
}
exit;
?>