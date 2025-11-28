<?php
$servername = "localhost";
$username = "root";
$password = "";

// Conecta no MySQL
$conn = new mysqli($servername, $username, $password);

// Checa conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criar banco com InnoDB habilitado
if ($conn->query("CREATE DATABASE IF NOT EXISTS clinica_veterinaria CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci") === TRUE) {
    echo "Banco criado ou já existe.<br>";
} else {
    die("Erro ao criar banco: " . $conn->error);
}

// Seleciona o banco
$conn->select_db("clinica_veterinaria");

// =========================
//  CRIA TABELA USUÁRIOS
// =========================
$conn->query("
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
");

// ADMIN padrão
$senhaAdmin = password_hash("123456", PASSWORD_DEFAULT);
$conn->query("
INSERT IGNORE INTO usuarios (email, senha)
VALUES ('admin@vetcare.com', '$senhaAdmin');
");

// =========================
//  CRIA TABELA CLIENTES
// =========================
$conn->query("
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    cpf VARCHAR(20),
    endereco VARCHAR(255),
    telefone VARCHAR(20),
    email VARCHAR(100)
) ENGINE=InnoDB;
");

// =========================
//  CRIA TABELA ANIMAIS
// =========================
$conn->query("
CREATE TABLE IF NOT EXISTS animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    especie VARCHAR(50),
    raca VARCHAR(50),
    idade INT,
    sexo VARCHAR(10),
    peso DECIMAL(5,2),
    cliente_id INT NOT NULL,
    observacoes TEXT,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;
");

// =========================
//  CRIA TABELA CONSULTAS
// =========================
$conn->query("
CREATE TABLE IF NOT EXISTS consultas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data DATE,
    hora TIME,
    animal_id INT NOT NULL,
    cliente_id INT NOT NULL,
    veterinario VARCHAR(100),
    observacoes TEXT,

    FOREIGN KEY (animal_id) REFERENCES animais(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;
");

// =========================
//  INSERE DADOS DE TESTE
// =========================

// CLIENTES
$conn->query("
INSERT INTO clientes (nome, cpf, endereco, telefone, email) VALUES
('João Silva', '123.456.789-00', 'Rua A, 100', '11999999999', 'joao@email.com'),
('Maria Oliveira', '987.654.321-00', 'Rua B, 200', '11888888888', 'maria@email.com')
");

// PEGAR IDS DOS CLIENTES
$cliente1 = $conn->insert_id;

// ANIMAIS
$conn->query("
INSERT INTO animais (nome, especie, raca, idade, sexo, peso, cliente_id, observacoes) VALUES
('Rex', 'Cachorro', 'Labrador', 5, 'Macho', 32.5, 1, 'Muito dócil'),
('Mimi', 'Gato', 'Persa', 3, 'Fêmea', 4.2, 2, 'Gosta de arranhar móveis')
");

// CONSULTAS
$conn->query("
INSERT INTO consultas (data, hora, animal_id, cliente_id, veterinario, observacoes) VALUES
('2025-01-10', '14:00:00', 1, 1, 'Dr. Marcos', 'Consulta de rotina'),
('2025-01-11', '10:30:00', 2, 2, 'Dra. Ana', 'Vacinação anual')
");

echo "<br>Tabelas criadas, relacionadas e populadas com sucesso!<br>";
echo "<br><a href='index2.php'>Ir para pagina inicial</a>";

$conn->close();
?>
