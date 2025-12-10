<?php
    // Ao Clicar em sair na pagina home executa
    // Inicia a sessão para poder manipular variáveis de sessão
    session_start();

    // Remove a variável email
    unset($_SESSION['email']);

    // Remove a variável senha
    unset($_SESSION['senha']); 

    // Redireciona o usuário para a página de login
    header("Location: ../home_ministrante/home_ministrante.html");
?>