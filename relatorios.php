<?php
include 'includes/db_connect.php';
include 'auth.php';

$mensagem = "";
$tipo = "";

// Remover cliente
if(isset($_GET['delete_cliente'])){
    $id = intval($_GET['delete_cliente']);
    if(mysqli_query($conn, "DELETE FROM clientes WHERE id=$id")){
        $mensagem = "Cliente removido com sucesso!";
        $tipo = "success";
    } else {
        $mensagem = "Erro ao remover cliente: " . mysqli_error($conn);
        $tipo = "error";
    }
}

// Remover animal
if(isset($_GET['delete_animal'])){
    $id = intval($_GET['delete_animal']);
    if(mysqli_query($conn, "DELETE FROM animais WHERE id=$id")){
        $mensagem = "Animal removido com sucesso!";
        $tipo = "success";
    } else {
        $mensagem = "Erro ao remover animal: " . mysqli_error($conn);
        $tipo = "error";
    }
}

// Marcar consulta como realizada
if(isset($_GET['concluida'])){
    $id = intval($_GET['concluida']);
    if(mysqli_query($conn, "DELETE FROM consultas WHERE id=$id")){
        $mensagem = "Consulta concluída!";
        $tipo = "success";
    } else {
        $mensagem = "Erro ao concluir consulta: " . mysqli_error($conn);
        $tipo = "error";
    }
}

// Pegar dados
$clientes = mysqli_query($conn, "SELECT * FROM clientes");
$animais = mysqli_query($conn, "SELECT * FROM animais");
$consultas = mysqli_query($conn, "SELECT * FROM consultas");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Relatórios - VetCare</title>
<link rel="stylesheet" href="style.css">
<style>
/* Botões bonitos */
.btn-remover, .btn-concluida {
    display: inline-block;
    padding: 5px 12px;
    color: #fff;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}

.btn-remover {
    background-color: #e74c3c;
}

.btn-remover:hover {
    background-color: #c0392b;
    cursor: pointer;
}

.btn-concluida {
    background-color: #27ae60;
}

.btn-concluida:hover {
    background-color: #1e8449;
    cursor: pointer;
}
</style>
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
<li><a href="cadastro_animal.php">Animais</a></li>
<li><a href="agendamento.php">Consultas</a></li>
<li><a href="relatorios.php">Relatórios</a></li>
</ul>
</nav>
</div>
</header>

<section>
<div class="container">

<h3>Clientes</h3>
<table>
<tr>
<th>ID</th>
<th>Nome</th>
<th>CPF</th>
<th>Endereço</th>
<th>Telefone</th>
<th>Email</th>
<th>Ação</th>
</tr>
<?php while($row = mysqli_fetch_assoc($clientes)): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['nome'] ?></td>
<td><?= $row['cpf'] ?></td>
<td><?= $row['endereco'] ?></td>
<td><?= $row['telefone'] ?></td>
<td><?= $row['email'] ?></td>
<td>
<a href="?delete_cliente=<?= $row['id'] ?>" class="btn-remover" onclick="return confirm('Tem certeza que deseja remover este cliente?');">Remover</a>
</td>
</tr>
<?php endwhile; ?>
</table>

<h3>Animais</h3>
<table>
<tr>
<th>ID</th>
<th>Nome</th>
<th>Espécie</th>
<th>Raça</th>
<th>Idade</th>
<th>Sexo</th>
<th>Peso</th>
<th>Dono</th>
<th>Ação</th>
</tr>
<?php while($row = mysqli_fetch_assoc($animais)): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['nome'] ?></td>
<td><?= $row['especie'] ?></td>
<td><?= $row['raca'] ?></td>
<td><?= $row['idade'] ?></td>
<td><?= $row['sexo'] ?></td>
<td><?= $row['peso'] ?></td>
<td><?= $row['cliente_id'] ?></td>
<td>
<a href="?delete_animal=<?= $row['id'] ?>" class="btn-remover" onclick="return confirm('Tem certeza que deseja remover este animal?');">Remover</a>
</td>
</tr>
<?php endwhile; ?>
</table>

<h3>Consultas</h3>
<table>
<tr>
<th>ID</th>
<th>Data</th>
<th>Hora</th>
<th>Animal</th>
<th>Cliente</th>
<th>Veterinário</th>
<th>Observações</th>
<th>Ação</th>
</tr>
<?php while($row = mysqli_fetch_assoc($consultas)): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['data'] ?></td>
<td><?= $row['hora'] ?></td>
<td><?= $row['animal_id'] ?></td>
<td><?= $row['cliente_id'] ?></td>
<td><?= $row['veterinario'] ?></td>
<td><?= $row['observacoes'] ?></td>
<td>
<a href="?concluida=<?= $row['id'] ?>" class="btn-concluida" onclick="return confirm('Marcar consulta como concluída?');">Consulta realizada</a>
</td>
</tr>
<?php endwhile; ?>
</table>

<?php if($mensagem != ""): ?>
<div id="mensagem" class="mensagem-sucesso <?= $tipo ?>">
<?= $mensagem ?>
</div>
<?php endif; ?>

</div>
</section>

<footer class="footer">
<p>© 2025 VetCare - Todos os direitos reservados</p>
</footer>

<script>
const msg = document.getElementById('mensagem');
if(msg){
    msg.classList.add('show');
    setTimeout(() => { msg.classList.remove('show'); }, 3000);
}

const menuLinks = document.querySelectorAll('.menu a');
const menuToggle = document.getElementById('menu-toggle');
menuLinks.forEach(link => { link.addEventListener('click', () => { menuToggle.checked = false; }); });
</script>
</body>
</html>
