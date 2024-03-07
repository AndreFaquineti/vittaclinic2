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
if(!isset($_SESSION['email'])) {
    $stmt = $conn->prepare("SELECT email FROM tabela_administradores WHERE email='$email'
    UNION SELECT email FROM tabela_medicos WHERE email='$email'
    UNION SELECT email FROM tabela_pacientes WHERE email='$email'");
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($email != '') {
        if ($usuario['email'] == $email) {
            echo 'Esse email já está sendo utilidado.';
        } else {
            $stmt = $conn->prepare("INSERT INTO tabela_pacientes (email, senha, tipo) VALUES ('$email', '$senha', 'paciente')");
            $stmt->execute();
            $stmt = $conn->prepare("SELECT email, senha, tipo FROM tabela_pacientes WHERE email='$email'");
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['tipodeusuario'] = $usuario['tipo'];
            header('location: /vittaclinic2/index.php');
        }
    }
}
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
        Senha: <input type="password" name="senha"> <br>
        <input type="submit">
    </form>
    <p><a href="/vittaclinic2/paginas/comum/entrar.php">Entrar</a></p>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
</body>
</html>