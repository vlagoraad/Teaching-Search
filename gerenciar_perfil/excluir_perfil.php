<?php
session_start();
header('Content-Type: application/json');
require_once '../conexao.php';

// Verifica se a sessão está corretamente configurada
if (!isset($_SESSION['cpf']) || !isset($_SESSION['tipo'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado ou sessão inválida']);
    exit;
}

// Verifica confirmação
if (!isset($_POST['confirmacao']) || $_POST['confirmacao'] !== 'sim') {
    echo json_encode(['success' => false, 'message' => 'Confirmação inválida']);
    exit;
}

$cpf = $_SESSION['cpf'];
$tipo = $_SESSION['tipo'];

// Escolhe a tabela certa
if ($tipo === 'aluno') {
    $sql = "DELETE FROM aluno WHERE aluno_cpf = ?";
} elseif ($tipo === 'ministrante') {
    $sql = "DELETE FROM ministrante WHERE ministrante_cpf = ?";
} else {
    echo json_encode(['success' => false, 'message' => 'Tipo de usuário inválido']);
    exit;
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);

if ($stmt->execute()) {
    session_destroy();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao excluir perfil: ' . $stmt->error]);
}
?>
