<?php
session_start();
require_once '../conexao.php';

header('Content-Type: application/json');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM empresa WHERE empresa_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $empresa = $resultado->fetch_assoc();

        if ($empresa['empresa_senha'] === $senha) {
            $_SESSION['email'] = $empresa['empresa_email'];
            $_SESSION['cnpj'] = $empresa['empresa_cnpj'];
            $_SESSION['tipo'] = 'empresa';

            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Senha incorreta.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Empresa não encontrada.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Campos obrigatórios ausentes.']);
    exit;
}
?>
