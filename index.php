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
    if (isset($_SESSION['tipodeusuario'])) {
        if ($_SESSION['tipodeusuario'] == 'administrador') {
            echo '<p><a href="/vittaclinic2/paginas/administradores/administrador_minhapagina.php">Minha Página</a></p>';
        }
        if ($_SESSION['tipodeusuario'] == 'medico') {
            echo '<p><a href="/vittaclinic2/paginas/medicos/medico_minhapagina.php">Minha Página</a></p>';
        }
        if ($_SESSION['tipodeusuario'] == 'paciente') {
            echo '<p><a href="/vittaclinic2/paginas/pacientes/paciente_minhapagina.php">Minha Página</a></p>';
        }
    }
    ?>
    <p><a href="/vittaclinic2/paginas/pacientes/marcar-consulta.php">Marcar Consulta</a></p>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
</body>
</html>