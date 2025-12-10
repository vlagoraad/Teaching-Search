<?php
    session_start();
    include_once('../conexao.php');
    //print_r($_SESSION);
    if((!isset  ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: ../home_aluno/home_aluno.html');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_empresa.css">
    <link rel="stylesheet" href="../geralt.css">
    <title>Home empresa</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="../home_empresa_logada/home_empresa.php">Início</a></li>
            <li><a>Gerenciar Cursos</a></li>
            <li><a>Gerenciar Vagas</a></li>
            <li><a href="../gerenciar_perfil_empresa/gerenciar_perfil_empresa.html">Gerenciar Perfil</a></li>
            <li><a href="sair.php">Sair</a></li>
        </ul>
    </nav>
    <div class="side">
        <h1>Bem Vindo(a) ao Teaching Search para Empresas!</h1>
        <p>Conectamos professores capacitados para o ensino de pessoas com deficiência a escolas e instituições que valorizam a inclusão.</p>
        <p>Aqui, você pode gerenciar suas vagas e cursos!</p>
        <button>Ver cursos</button>
    </div>
    <div>
         <img src="../logo.jpg">
    </div>
    <div>
        <h1>Seus Cursos</h1>
        <div class="cursos-lista">
            <a href="../curso_especifico/curso_especifico.html">
                <div class="curso-card">
                    <h3>Braille Básico</h3>
                    <p>PUC-PR</p>
                    <p>30 horas</p>
                </div>
            </a>
            <a href="../curso_especifico/curso_especifico.html">
                <div class="curso-card">
                    <h3>Braille Intermediário</h3>
                    <p>PUC-PR</p>
                    <p>40 horas</p>
                </div>
            </a>
            <a href="../curso_especifico/curso_especifico.html">
                <div class="curso-card">
                    <h3>Braille Avançado</h3>
                    <p>PUC-PR</p>
                    <p>60 horas</p>
                </div>
            </a>
        </div>
    </div>
</body>
</html>