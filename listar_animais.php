<?php 
require 'auth_check.php';
require 'conexao.php';
?>

<?php include 'header.php'; ?>

<h2>Animais Cadastrados</h2>

<?php if(isset($_GET['sucesso'])): ?>
<div class="msg success">Ação realizada com sucesso!</div>
<?php endif; ?>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th><th>Nome</th><th>Espécie</th><th>Dono</th><th>Ações</th>
</tr>

<?php
$stmt = $conn->prepare("SELECT * FROM animais");
$stmt->execute();
$res = $stmt->get_result();

while($row = $res->fetch_assoc()):
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['nome'] ?></td>
    <td><?= $row['especie'] ?></td>
    <td><?= $row['cliente_id'] ?></td>

    <td>
        <a href="editar_animal.php?id=<?= $row['id'] ?>">Editar</a>
        <a href="excluir_animal.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir animal?')">Excluir</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<?php include 'footer.php'; ?>
