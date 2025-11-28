<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?erro=proibido");
    exit;
}
?>
