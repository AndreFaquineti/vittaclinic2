<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>VittaClinic</title>
</head>
<body>
    <a href="/vittaclinic2/index.php"><h1>Vitta.Clinic</h1></a>
    <?php //Sistema que escreve o usuario.
    if (isset($_SESSION['email'])) {
        echo 'usuario: ' . $_SESSION['email'] . ' tipo: ' . $_SESSION['tipodeusuario'];
    } else {
        echo '<p><a href="/vittaclinic2/paginas/comum/entrar.php">Entrar/Registrar</a></p>';
    }
    ?>
    <p><a href="/vittaclinic2/paginas/pacientes/marcar-consulta.php">Marcar Consulta</a></p>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
</body>
</html>