<?php 
require 'auth_check.php';
require 'conexao.php';

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM consultas WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$consulta = $stmt->get_result()->fetch_assoc();
$stmt->close();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $animal = intval($_POST['animal_id']);
    $cliente = intval($_POST['cliente_id']);
    $vet = htmlspecialchars($_POST['veterinario']);
    $obs = htmlspecialchars($_POST['observacoes']);

    $stmt = $conn->prepare("UPDATE consultas SET data=?, hora=?, animal_id=?, cliente_id=?, veterinario=?, observacoes=? WHERE id=?");
    $stmt->bind_param("ssiissi", $data, $hora, $animal, $cliente, $vet, $obs, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: listar_consultas.php?sucesso=1");
    exit;
}
?>

<?php include 'header.php'; ?>

<h2>Editar Consulta</h2>

<form method="post">
    Data: <input type="date" name="data" value="<?= $consulta['data'] ?>"><br>
    Hora: <input type="time" name="hora" value="<?= $consulta['hora'] ?>"><br>
    ID Animal: <input type="number" name="animal_id" value="<?= $consulta['animal_id'] ?>"><br>
    ID Dono: <input type="number" name="cliente_id" value="<?= $consulta['cliente_id'] ?>"><br>
    Veterinário: <input type="text" name="veterinario" value="<?= $consulta['veterinario'] ?>"><br>
    Observações: <textarea name="observacoes"><?= $consulta['observacoes'] ?></textarea><br>

    <button type="submit">Salvar</button>
</form>

<?php include 'footer.php'; ?>
