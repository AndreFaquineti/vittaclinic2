<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email" name="email"> <br>
        Senha: <input type="password" name="senha"> <br>
        <input type="submit">
    </form>
    <?php
    //Registro
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
        $stmt = $conn->prepare("SELECT email FROM tabela_usuarios WHERE email='$email'");
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($email != '') {
            if (@$usuario['email'] == $email) {
                echo 'Esse email já está sendo utilizado.';
            } else {
                if ($senha != '') {
                    $stmt = $conn->prepare("INSERT INTO tabela_usuarios (email, senha, tipo) VALUES ('$email', '$senha', 'paciente')");
                    $stmt->execute();
                    $stmt = $conn->prepare("SELECT email, senha, tipo FROM tabela_usuarios WHERE email='$email'");
                    $stmt->execute();
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['email'] = @$usuario['email'];
                    $_SESSION['tipodeusuario'] = $usuario['tipo'];
                    header('location: \vittaclinic2\paginas\pacientes\paciente_minhapagina.php');
                } else {
                    echo 'Digite uma senha válida';
                }
            }
        }
    }
    ?>
    <p><a href="/vittaclinic2/paginas/comum/entrar.php">Entrar</a></p>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
</body>
</html>