<?php
    session_start();

    // Remove a variável email
    unset($_SESSION['email']);

    // Remove a variável senha
    unset($_SESSION['senha']); 

    // Redireciona o usuário para a página de login
    header("Location: ../home_empresa/home_empresa.html");
    exit;
?>
