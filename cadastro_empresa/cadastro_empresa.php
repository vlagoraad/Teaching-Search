<?php
header('Content-Type: application/json');
require_once '../conexao.php';

// Recebe os dados do formulário
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$cnpj = $_POST['cnpj'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$cep = $_POST['cep'] ?? '';
$uf = $_POST['uf'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$logradouro = $_POST['logradouro'] ?? '';
$numero = $_POST['numero'] ?? null;
$senha = $_POST['senha'] ?? '';
$conf_senha = $_POST['conf_senha'] ?? '';

// Valida número
if (!is_numeric($numero)) {
    echo json_encode(['success' => false, 'message' => 'Número inválido']);
    exit;
}
$numero = (int)$numero;

// Verifica se as senhas coincidem
if ($senha !== $conf_senha) {
    echo json_encode(['success' => false, 'message' => 'As senhas não coincidem']);
    exit;
}

// Escapa os dados
$nome = $conn->real_escape_string($nome);
$email = $conn->real_escape_string($email);
$cnpj = $conn->real_escape_string($cnpj);
$telefone = $conn->real_escape_string($telefone);
$cep = $conn->real_escape_string($cep);
$uf = $conn->real_escape_string($uf);
$cidade = $conn->real_escape_string($cidade);
$logradouro = $conn->real_escape_string($logradouro);
$senha = $conn->real_escape_string($senha);
$conf_senha = $conn->real_escape_string($conf_senha);

// Monta e executa a query
$sql = "INSERT INTO empresa (
            empresa_nome, empresa_email, empresa_cnpj, empresa_telefone,
            empresa_cep, empresa_uf, empresa_cidade, empresa_logradouro,
            empresa_num, empresa_senha, empresa_conf_senha
        ) VALUES (
            '$nome', '$email', '$cnpj', '$telefone',
            '$cep', '$uf', '$cidade', '$logradouro',
            $numero, '$senha', '$conf_senha'
        )";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar: ' . $conn->error]);
}

$conn->close();



