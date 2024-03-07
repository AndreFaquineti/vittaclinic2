<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
if(!isset($_SESSION['email'])) {
    $email = "";
    $senha = "";
} else {
    header('location: /vittaclinic2/index.php');
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
}
//precisa verificar se o email já existe e, se sim, não permitir o registro.
?>
<!doctype html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>Registro</title>
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
    <p><h2>Registro</h2></p>
    <p>Nessa página o paciente deve poder se registrar.</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email" name="email"> <br>
        Senha: <input type="password" name="Senha"> <br>
        <input type="submit">
    </form>
    <p><a href="/vittaclinic2/paginas/comum/entrar.php">Entrar</a></p>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
</body>
</html>