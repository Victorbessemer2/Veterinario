<?php
require 'auth_check.php';
require 'conexao.php';

// Verificar se foi passado ID
if (!isset($_GET['id'])) {
    header("Location: listar_animais.php?erro=sem_id");
    exit;
}

$id = intval($_GET['id']);

// Buscar dados do animal
$stmt = $conn->prepare("SELECT * FROM animais WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$animal = $result->fetch_assoc();
$stmt->close();

if (!$animal) {
    header("Location: listar_animais.php?erro=nao_encontrado");
    exit;
}

// Se enviou o formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = $_POST['idade'];
    $sexo = $_POST['sexo'];
    $peso = $_POST['peso'];
    $cliente_id = $_POST['cliente_id'];
    $observacoes = $_POST['observacoes'];

    $stmt = $conn->prepare("
        UPDATE animais 
        SET nome=?, especie=?, raca=?, idade=?, sexo=?, peso=?, cliente_id=?, observacoes=?
        WHERE id=?
    ");
    $stmt->bind_param(
        "sssisdisi",
        $nome, $especie, $raca, $idade, $sexo, $peso, $cliente_id, $observacoes, $id
    );

    if ($stmt->execute()) {
        header("Location: listar_animais.php?sucesso=editado");
        exit;
    } else {
        $erro = "Erro ao atualizar: " . $stmt->error;
    }
    $stmt->close();
}
?>

<?php include 'header.php'; ?>

<div class="container">
    <h2>Editar Animal</h2>

    <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

    <form method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $animal['nome'] ?>" required>

        <label>Espécie:</label>
        <input type="text" name="especie" value="<?= $animal['especie'] ?>" required>

        <label>Raça:</label>
        <input type="text" name="raca" value="<?= $animal['raca'] ?>">

        <label>Idade:</label>
        <input type="number" name="idade" value="<?= $animal['idade'] ?>">

        <label>Sexo:</label>
        <input type="text" name="sexo" value="<?= $animal['sexo'] ?>">

        <label>Peso (kg):</label>
        <input type="number" step="0.01" name="peso" value="<?= $animal['peso'] ?>">

        <label>ID do Dono (cliente_id):</label>
        <input type="number" name="cliente_id" value="<?= $animal['cliente_id'] ?>" required>

        <label>Observações:</label>
        <textarea name="observacoes"><?= $animal['observacoes'] ?></textarea>

        <input type="submit" value="Salvar Alterações">
    </form>
</div>

<?php include 'footer.php'; ?>
