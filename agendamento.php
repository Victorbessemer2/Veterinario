<?php 
require 'auth_check.php';
require 'conexao.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $animal = intval($_POST['animal_id']);
    $cliente = intval($_POST['cliente_id']);
    $vet = htmlspecialchars($_POST['veterinario']);
    $obs = htmlspecialchars($_POST['observacoes']);

    $stmt = $conn->prepare("INSERT INTO consultas (data, hora, animal_id, cliente_id, veterinario, observacoes)
    VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiss", $data, $hora, $animal, $cliente, $vet, $obs);
    $stmt->execute();
    $stmt->close();

    header("Location: listar_consultas.php?sucesso=1");
    exit;
}
?>

<?php include 'header.php'; ?>

<h2>Agendar Consulta</h2>

<form method="post">
    Data: <input type="date" name="data" required><br>
    Hora: <input type="time" name="hora" required><br>
    ID Animal: <input type="number" name="animal_id" required><br>
    ID Dono: <input type="number" name="cliente_id" required><br>
    Veterinário: <input type="text" name="veterinario" required><br>
    Observações: <textarea name="observacoes"></textarea><br>

    <button type="submit">Agendar</button>
</form>

<?php include 'footer.php'; ?>
