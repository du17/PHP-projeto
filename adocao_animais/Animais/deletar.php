<?php
require_once '../conexao.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    // Verificar se o animal tem adoções
    $stmt_check = $pdo->prepare("SELECT COUNT(*) as total FROM adocoes WHERE animal_id = ?");
    $stmt_check->execute([$id]);
    $tem_adocoes = $stmt_check->fetch()['total'] > 0;
    
    if ($tem_adocoes) {
        header('Location: listar.php?erro=Não é possível deletar este animal pois ele possui adoções registradas!');
        exit;
    }
    
    $stmt = $pdo->prepare("DELETE FROM animais WHERE id = ?");
    
    if ($stmt->execute([$id])) {
        header('Location: listar.php?msg=Animal deletado com sucesso!');
    } else {
        header('Location: listar.php?erro=Erro ao deletar animal!');
    }
} else {
    header('Location: listar.php?erro=ID inválido!');
}
exit;
?>