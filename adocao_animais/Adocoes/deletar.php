<?php
require_once '../conexao.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    try {
        $pdo->beginTransaction();
        
        // Buscar informações da adoção
        $stmt_info = $pdo->prepare("SELECT animal_id FROM adocoes WHERE id = ?");
        $stmt_info->execute([$id]);
        $adocao = $stmt_info->fetch();
        
        if ($adocao) {
            // Deletar a adoção
            $stmt = $pdo->prepare("DELETE FROM adocoes WHERE id = ?");
            $stmt->execute([$id]);
            
            // Voltar o status do animal para disponível
            $stmt_update = $pdo->prepare("UPDATE animais SET status = 'disponivel' WHERE id = ?");
            $stmt_update->execute([$adocao['animal_id']]);
            
            $pdo->commit();
            header('Location: listar.php?msg=Adoção cancelada com sucesso! O animal voltou a ficar disponível.');
        } else {
            header('Location: listar.php?erro=Adoção não encontrada!');
        }
    } catch (Exception $e) {
        $pdo->rollback();
        header('Location: listar.php?erro=Erro ao cancelar adoção!');
    }
} else {
    header('Location: listar.php?erro=ID inválido!');
}
exit;
?>