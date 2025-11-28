<?php 
require 'auth_check.php';
require 'conexao.php';

// Cadastrar animal
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = htmlspecialchars($_POST['nome']);
    $especie = htmlspecialchars($_POST['especie']);
    $raca = htmlspecialchars($_POST['raca']);
    $idade = intval($_POST['idade']);
    $sexo = htmlspecialchars($_POST['sexo']);
    $peso = floatval($_POST['peso']);
    $cliente_id = intval($_POST['cliente_id']);
    $obs = htmlspecialchars($_POST['observacoes']);

    $stmt = $conn->prepare("INSERT INTO animais (nome, especie, raca, idade, sexo, peso, cliente_id, observacoes) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisdis", $nome, $especie, $raca, $idade, $sexo, $peso, $cliente_id, $obs);
    $stmt->execute();
    $stmt->close();

    header("Location: listar_animais.php?sucesso=1");
    exit;
}
?>

<?php include 'header.php'; ?>

<h2>Cadastrar Animal</h2>
<form method="post">
    Nome: <input type="text" name="nome" required><br>
    Espécie: <input type="text" name="especie" required><br>
    Raça: <input type="text" name="raca"><br>
    Idade: <input type="number" name="idade"><br>
    Sexo: <input type="text" name="sexo"><br>
    Peso: <input type="number" step="0.01" name="peso"><br>
    ID do Dono (cliente): <input type="number" name="cliente_id" required><br>
    Observações:<br>
    <textarea name="observacoes"></textarea><br>
    <button type="submit">Cadastrar</button>
</form>

<?php include 'footer.php'; ?>
