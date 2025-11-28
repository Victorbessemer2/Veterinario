<?php 
require 'auth_check.php';
require 'conexao.php';
?>

<?php include 'header.php'; ?>

<h2>Consultas Agendadas</h2>

<?php if(isset($_GET['sucesso'])): ?>
<div class="msg success">Ação realizada com sucesso!</div>
<?php endif; ?>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th><th>Data</th><th>Hora</th><th>ID Animal</th><th>ID Dono</th><th>Veterinário</th><th>Ações</th>
</tr>

<?php
$stmt = $conn->prepare("SELECT * FROM consultas");
$stmt->execute();
$res = $stmt->get_result();

while($row = $res->fetch_assoc()):
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['data'] ?></td>
    <td><?= $row['hora'] ?></td>
    <td><?= $row['animal_id'] ?></td>
    <td><?= $row['cliente_id'] ?></td>
    <td><?= $row['veterinario'] ?></td>

    <td>
        <a href="editar_consulta.php?id=<?= $row['id'] ?>">Editar</a>
        <a href="excluir_consulta.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir consulta?')">Excluir</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<?php include 'footer.php'; ?>
