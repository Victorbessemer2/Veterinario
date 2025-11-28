<?php 
require 'auth_check.php';
require 'conexao.php';
include 'header.php';

$mensagem = "";

// Inserir cliente
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = htmlspecialchars($_POST['nome']);
    $telefone = htmlspecialchars($_POST['telefone']);

    $stmt = $conn->prepare("INSERT INTO clientes (nome, telefone) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $telefone);
    $stmt->execute();
    $stmt->close();

    $mensagem = "Cliente cadastrado!";
}

// Lista de clientes
$result = $conn->query("SELECT * FROM clientes ORDER BY id DESC");
?>

<section>
<div class="container">
<h2>Clientes</h2>

<?php if ($mensagem): ?>
<p class="msg sucesso"><?= $mensagem ?></p>
<?php endif; ?>

<form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Telefone:</label>
    <input type="text" name="telefone" required>

    <button type="submit">Cadastrar</button>
</form>

<h3>Lista de Clientes</h3>
<table class="tabela">
<tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Ações</th></tr>

<?php while($c = $result->fetch_assoc()): ?>
<tr>
    <td><?= $c['id'] ?></td>
    <td><?= $c['nome'] ?></td>
    <td><?= $c['telefone'] ?></td>
    <td>
        <a href="editar_cliente.php?id=<?= $c['id'] ?>">Editar</a> |
        <a href="excluir_cliente.php?id=<?= $c['id'] ?>">Excluir</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</div>
</section>

<?php include 'footer.php'; ?>
