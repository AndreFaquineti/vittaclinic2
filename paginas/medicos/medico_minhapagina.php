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
<?php
include 'C:\xampp\htdocs\vittaclinic2\paginas/comum\header_mp_especial.php';
?>
<p>Médico minha página.</p>
</body>
</html>