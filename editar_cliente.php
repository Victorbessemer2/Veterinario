<?php 
require 'auth_check.php';
require 'conexao.php';
include 'header.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM clientes WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = htmlspecialchars($_POST['nome']);
    $telefone = htmlspecialchars($_POST['telefone']);

    $stmt = $conn->prepare("UPDATE clientes SET nome=?, telefone=? WHERE id=?");
    $stmt->bind_param("ssi", $nome, $telefone, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: cadastro_cliente.php?editado=1");
    exit;
}
?>

<section>
<div class="container">
<h2>Editar Cliente</h2>

<form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $cliente['nome'] ?>" required>

    <label>Telefone:</label>
    <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>" required>

    <button type="submit">Salvar</button>
</form>

</div>
</section>

<?php include 'footer.php'; ?>
