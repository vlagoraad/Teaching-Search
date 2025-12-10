<?php
session_start();
header('Content-Type: application/json');
require_once '../conexao.php'; // caminho pode variar

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf']) || !isset($_SESSION['tipo'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$cpf = $_SESSION['cpf'];
$tipo = $_SESSION['tipo']; // 'aluno' ou 'ministrante'

// Define a tabela e campos com base no tipo
if ($tipo === 'aluno') {
    $sql = "SELECT aluno_nome AS nome, aluno_email AS email, aluno_cpf AS cpf, aluno_data_nasc AS data_nasc FROM aluno WHERE aluno_cpf = ?";
} elseif ($tipo === 'ministrante') {
    $sql = "SELECT ministrante_nome AS nome, ministrante_email AS email, ministrante_cpf AS cpf, ministrante_data_nasc AS data_nasc FROM ministrante WHERE ministrante_cpf = ?";
} else {
    echo json_encode(['success' => false, 'message' => 'Tipo de usuário inválido']);
    exit;
}

// Executa com segurança
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $dados = $result->fetch_assoc();
    echo json_encode(['success' => true, 'dados' => $dados]);
} else {
    echo json_encode(['success' => false, 'message' => 'Dados não encontrados']);
}
