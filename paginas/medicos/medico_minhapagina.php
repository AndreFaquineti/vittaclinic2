<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
require 'C:\xampp\htdocs\vittaclinic2\sistema\lib.php';
filtroAcessoMedico();
?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>VittaClinic</title>
    <?php
    seletorDeTemas();
    ?>  
</head>
<body>
    <p><a href="/vittaclinic2/index.php"><h1>Vitta.Clinic</h1></a></p>
    <?php
    escreverUsuarioEmailTipo();
    ?>
    <p>Médico minha página.</p>
</body>
</html>