<?php
require 'auth_check.php';
require 'conexao.php';

if (!isset($_GET['id'])) {
    header("Location: listar_animais.php?erro=sem_id");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM animais WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar_animais.php?sucesso=excluido");
} else {
    header("Location: listar_animais.php?erro=nao_excluiu");
}

$stmt->close();
exit;
?>
