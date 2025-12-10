<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
require_once '../conexao.php'; // conexao com o banco

// pega os dados do form
$tipo = $_POST['tp_cadastro'] ?? '';
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$data_nasc = $_POST['data_nasc'] ?? '';
$senha = $_POST['senha'] ?? '';
$conf_senha = $_POST['conf_senha'] ?? '';

// confere as senhas digitadas
if ($senha !== $conf_senha) {
    echo json_encode(['success' => false, 'message' => 'As senhas não coincidem']);
    exit;
}

// escapa os dados p seguranca
$nome = $conn->real_escape_string($nome);
$email = $conn->real_escape_string($email);
$cpf = $conn->real_escape_string($cpf);
$data_nasc = $conn->real_escape_string($data_nasc);
$senha = $conn->real_escape_string($senha);
$conf_senha = $conn->real_escape_string($conf_senha);

// queries sql
if ($tipo === 'aluno') {
    $sql = "INSERT INTO aluno (aluno_nome, aluno_email, aluno_cpf, aluno_data_nasc, aluno_senha, aluno_conf_senha)
            VALUES ('$nome', '$email', '$cpf', '$data_nasc', '$senha', '$conf_senha')";
} elseif ($tipo === 'ministrante') {
    $sql = "INSERT INTO ministrante (ministrante_nome, ministrante_email, ministrante_cpf, ministrante_data_nasc, ministrante_senha, ministrante_conf_senha)
            VALUES ('$nome', '$email', '$cpf', '$data_nasc', '$senha', '$conf_senha')";
} else {
    echo json_encode(['success' => false, 'message' => 'Tipo de cadastro inválido']);
    exit;
}

// executando a a query
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar: ' . $conn->error]);
}

$conn->close(); #fecha 
?>