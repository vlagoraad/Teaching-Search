<?php
// Inicia a sessão
session_start();

// Verifica se o botão foi clicado e se os campos email e senha não estão vazios
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

    // Chama a conexão com o banco de dados
    include_once('../conexao.php');

    // Recebe os valores enviados pelo formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tp_cadastro = $_POST['tp_cadastro'];

    // Verifica tipo de cadastro e prepara a query
    if ($tp_cadastro === 'ministrante') {
        $sql = "SELECT * FROM ministrante WHERE ministrante_email = '$email' AND ministrante_senha = '$senha'";
    } elseif ($tp_cadastro === 'aluno') {
        $sql = "SELECT * FROM aluno WHERE aluno_email = '$email' AND aluno_senha = '$senha'";
    } else {
        // Tipo inválido
        header('Location: login.html');
        exit;
    }

    // Executa a consulta no banco de dados
    $result = $conn->query($sql);

    // Verifica se encontrou um usuário
    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = $result->fetch_assoc();

        // Define as variáveis de sessão com os dados do usuário
        $_SESSION['email'] = $usuario[$tp_cadastro . '_email'];
        $_SESSION['senha'] = $usuario[$tp_cadastro . '_senha'];
        $_SESSION['cpf'] = $usuario[$tp_cadastro . '_cpf'];
        $_SESSION['tipo'] = $tp_cadastro;

        // Redireciona para a home correspondente
        if ($tp_cadastro === 'aluno') {
            header('Location: ../home_aluno_logado/home_aluno.php');
        } else {
            header('Location: ../home_ministrante_logada/home_ministrante.php');
        }
        exit;
    } else {
        // Login inválido
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['cpf']);
        unset($_SESSION['tipo']);

        header('Location: login.html');
        exit;
    }
} else {
    // Campos obrigatórios não preenchidos
    header('Location: login.html');
    exit;
}
?>
