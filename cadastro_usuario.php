<?php 
require 'auth_check.php';
require 'conexao.php';

$erro = "";
$mensagem = "";

// Cadastrar usuário
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se já existe
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $check = $stmt->get_result();

    if ($check->num_rows > 0) {
        $erro = "Este email já está cadastrado!";
    } else {
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hash);

        if ($stmt->execute()) {
            $mensagem = "Usuário cadastrado com sucesso!";
        } else {
            $erro = "Erro ao cadastrar usuário.";
        }
    }

    $stmt->close();
}

include 'header.php';
?>

<div class="container">
    <h2>Cadastrar Usuário</h2>

    <?php if($mensagem): ?>
        <div class="mensagem success"><?= $mensagem ?></div>
    <?php endif; ?>

    <?php if($erro): ?>
        <div class="mensagem erro"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <input type="submit" value="Cadastrar">
    </form>
</div>

<?php include 'footer.php'; ?>
