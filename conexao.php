<?php
$conn = mysqli_connect("localhost", "root", "root", "projetofinal"); #estabelece a conexao com o banco

if (!$conn) {
    die("Erro!" . mysqli_connect_error()); # se der erro
}
?>
