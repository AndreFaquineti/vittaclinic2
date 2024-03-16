<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
require 'C:\xampp\htdocs\vittaclinic2\sistema\lib.php';
//Redirecionador de não usuario
if (!isset($_SESSION['tipodeusuario'])) {
    header('location: /vittaclinic2/paginas/comum/entrar.php');
}
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
    <p><h1>Marque sua consulta</h1></p>
    <p>Aqui o usuario deve poder marcar consultas</p>
    <p>Um médico não deve poder marcar consultas com si mesmo</p>
</body>
</html>