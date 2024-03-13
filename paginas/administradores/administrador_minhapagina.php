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
    <p><h2>Administrador minha página.</h2></p>
    <?php //Sistema que escreve o usuario.
    if (isset($_SESSION['email'])) {
        echo 'usuario: ' . $_SESSION['email'] . ' tipo: ' . $_SESSION['tipodeusuario'];
    } else {
        echo '<p><a href="/vittaclinic2/paginas/comum/entrar.php">Entrar/Registrar</a></p>';
    }
    ?>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
    <p>
        <h3>Cadastrar médicos</h3>
        <form>
            Email: <input type="email" name="email_medico">
            Senha: <input type="password" name="senha_medico">
            <input type="submit">
        </form>
    </p>
    <p>
        <h3>Cadastrar administradores</h3>
        <form>
            Email: <input type="email" name="email_administrador">
            Senha: <input type="password" name="senha_administrador">
            <input type="submit">
        </form>
    </p>
</body>
</html>