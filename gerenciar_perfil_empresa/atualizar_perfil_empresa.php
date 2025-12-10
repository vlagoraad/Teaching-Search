<?php
session_start();
require_once '../conexao.php';
header('Content-Type: application/json');

// Verifica se a empresa está logada
if (!isset($_SESSION['cnpj'])) {
    echo json_encode(['success' => false, 'message' => 'Empresa não autenticada']);
    exit;
}

$cnpj = $_SESSION['cnpj'];

// Coleta os dados do POST
$empresa_nome = $_POST['empresa_nome'] ?? '';
$empresa_email = $_POST['empresa_email'] ?? '';
$empresa_telefone = $_POST['empresa_telefone'] ?? '';
$empresa_cep = $_POST['empresa_cep'] ?? '';
$empresa_uf = $_POST['empresa_uf'] ?? '';
$empresa_cidade = $_POST['empresa_cidade'] ?? '';
$empresa_logradouro = $_POST['empresa_logradouro'] ?? '';
$empresa_num = $_POST['numero'] ?? '';  // aqui o nome no form é "numero", mas no banco é "empresa_num"
$nova_senha = $_POST['senha'] ?? '';
$conf_senha = $_POST['conf_senha'] ?? '';

// Valida senha (se fornecida)
if (!empty($nova_senha) || !empty($conf_senha)) {
    if ($nova_senha !== $conf_senha) {
        echo json_encode(['success' => false, 'message' => 'As senhas não coincidem']);
        exit;
    }
    $empresa_senha = password_hash($nova_senha, PASSWORD_DEFAULT);
} else {
    $empresa_senha = null;
}

try {
    if ($empresa_senha) {
        $sql = "UPDATE empresa SET 
            empresa_nome = ?, empresa_email = ?, empresa_telefone = ?, 
            empresa_cep = ?, empresa_uf = ?, empresa_cidade = ?, 
            empresa_logradouro = ?, empresa_num = ?, empresa_senha = ?
            WHERE empresa_cnpj = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssss",
            $empresa_nome,
            $empresa_email,
            $empresa_telefone,
            $empresa_cep,
            $empresa_uf,
            $empresa_cidade,
            $empresa_logradouro,
            $empresa_num,
            $empresa_senha,
            $cnpj
        );
    } else {
        $sql = "UPDATE empresa SET 
            empresa_nome = ?, empresa_email = ?, empresa_telefone = ?, 
            empresa_cep = ?, empresa_uf = ?, empresa_cidade = ?, 
            empresa_logradouro = ?, empresa_num = ?
            WHERE empresa_cnpj = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssss",
            $empresa_nome,
            $empresa_email,
            $empresa_telefone,
            $empresa_cep,
            $empresa_uf,
            $empresa_cidade,
            $empresa_logradouro,
            $empresa_num,
            $cnpj
        );
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar: ' . $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
}
?>