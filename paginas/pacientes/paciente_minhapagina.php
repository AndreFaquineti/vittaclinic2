<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
require 'C:\xampp\htdocs\vittaclinic2\sistema\lib.php';
filtroAcessoPaciente();
?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>Marque sua consulta</title>
    <?php
    seletorDeTemas();
    ?>  
</head>
<body>
    <p><a href="/vittaclinic2/index.php"><h1>Vitta.Clinic</h1></a></p>
    <?php
    escreverUsuarioEmailTipo();
    ?>
    <p>Paciente minha página.</p>
</body>