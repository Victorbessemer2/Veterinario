<?php
// header.php — cabeçalho padrão
// Mantém todo seu visual original

if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VetCare</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container">
        <h1>VetCare</h1>
        <nav>
            <input type="checkbox" id="menu-toggle">
            <label for="menu-toggle" class="hamburger"><span></span><span></span><span></span></label>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="cadastro_cliente.php">Clientes</a></li>
                <li><a href="cadastro_animal.php">Cadastrar Animal</a></li>
                <li><a href="listar_animais.php">Lista de Animais</a></li>
                <li><a href="agendamento.php">Consultas</a></li>
                <li><a href="relatorios.php">Relatórios</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </div>
</header>
