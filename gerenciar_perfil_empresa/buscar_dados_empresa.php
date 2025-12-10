<?php
session_start();
require_once '../conexao.php';

// Oculta erros HTML
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json');

// Verifica se a sessão da empresa está ativa
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Empresa não está logada.']);
    exit;
}

$email = $_SESSION['email'];

$sql = "SELECT empresa_nome, empresa_email, empresa_cnpj, empresa_telefone, empresa_cep, empresa_uf, empresa_cidade, empresa_logradouro, empresa_num AS numero FROM empresa WHERE empresa_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado && $resultado->num_rows > 0) {
    $empresa = $resultado->fetch_assoc();
    echo json_encode(['success' => true, 'empresa' => $empresa]);
} else {
    echo json_encode(['success' => false, 'message' => 'Empresa não encontrada.']);
}
?>
