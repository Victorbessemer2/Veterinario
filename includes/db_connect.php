<?php
$servername = "localhost";
$username = "root"; // usuário padrão do XAMPP
$password = "";     // senha padrão do XAMPP
$database = "clinica_veterinaria";

// Criar conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
