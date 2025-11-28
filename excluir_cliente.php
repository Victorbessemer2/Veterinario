<?php
require 'auth_check.php';
require 'conexao.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM clientes WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: cadastro_cliente.php?excluido=1");
exit;
?>
