<?php
require 'auth_check.php';
require 'conexao.php';

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM consultas WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: listar_consultas.php?sucesso=1");
exit;
?>
