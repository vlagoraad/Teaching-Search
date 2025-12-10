<?php
session_start();
header('Content-Type: application/json');
require_once('../conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf']) || !isset($_SESSION['tipo'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$cpf = $_SESSION['cpf'];
$tipo = $_SESSION['tipo'];

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$data_nasc = $_POST['data_nasc'] ?? '';
$nova_senha = $_POST['senha'] ?? '';
$conf_senha = $_POST['conf_senha'] ?? '';

if ($nova_senha !== $conf_senha) {
    echo json_encode(['success' => false, 'message' => 'As senhas não coincidem']);
    exit;
}

if ($tipo === 'aluno') {
    if (!empty($nova_senha)) {
        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        $sql = "UPDATE aluno SET aluno_nome = ?, aluno_email = ?, aluno_data_nasc = ?, aluno_senha = ? WHERE aluno_cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $data_nasc, $senha_hash, $cpf);
    } else {
        $sql = "UPDATE aluno SET aluno_nome = ?, aluno_email = ?, aluno_data_nasc = ? WHERE aluno_cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $data_nasc, $cpf);
    }
} elseif ($tipo === 'ministrante') {
    if (!empty($nova_senha)) {
        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        $sql = "UPDATE ministrante SET ministrante_nome = ?, ministrante_email = ?, ministrante_data_nasc = ?, ministrante_senha = ? WHERE ministrante_cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $data_nasc, $senha_hash, $cpf);
    } else {
        $sql = "UPDATE ministrante SET ministrante_nome = ?, ministrante_email = ?, ministrante_data_nasc = ? WHERE ministrante_cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $data_nasc, $cpf);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Tipo de usuário inválido']);
    exit;
}

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar: ' . $stmt->error]);
}
?>
