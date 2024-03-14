<?php
session_start();
//Redirecionador de acesso não autorizado
if (isset($_SESSION['tipodeusuario'])) {
    if ($_SESSION['tipodeusuario'] != 'paciente') {
        header('location: /vittaclinic2/index.php');
    }
} else {
    header('location: /vittaclinic2/paginas/comum/entrar.php');
}
?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>Marque sua consulta</title>
</head>
<body>
    <p><a href="/vittaclinic2/index.php"><h1>Vitta.Clinic</h1></a></p>
    <?php //Sistema que escreve o usuario.
    if (isset($_SESSION['email'])) {
        echo 'usuario: ' . $_SESSION['email'] . ' tipo: ' . $_SESSION['tipodeusuario'];
    } else {
        echo '<p><a href="/vittaclinic2/paginas/comum/entrar.php">Entrar/Registrar</a></p>';
    }
    ?>
    <p><h1>Marque sua consulta</h1></p>
    <P>Essa pagina só pode ser acessada por pacientes</P>
    <p>Aqui o usuario deve poder marcar consultas</p>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
</body>
</html>