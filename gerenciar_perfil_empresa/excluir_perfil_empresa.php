<?php
session_start();
require_once '../conexao.php';

header('Content-Type: application/json');

// Verifica se a empresa está logada
if (!isset($_SESSION['cnpj']) || $_SESSION['tipo'] !== 'empresa') {
    echo json_encode(['success' => false, 'message' => 'Empresa não está logada.']);
    exit;
}

$cnpj = $_SESSION['cnpj'];

try {
    $sql = "DELETE FROM empresa WHERE empresa_cnpj = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cnpj);

    if ($stmt->execute()) {
        session_destroy();
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir empresa.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
}
?>
