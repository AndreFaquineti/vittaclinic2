<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
require 'C:\xampp\htdocs\vittaclinic2\sistema\lib.php';
if (isset($_SESSION['tipodeusuario'])) {
    if ($_SESSION['tipodeusuario'] != '') {
        header('location: /vittaclinic2/index.php');
    }
}
?>
<?php
if(!isset($_SESSION['email'])) {
    $email = "";
    $senha = "";
} else {
    header('location: /vittaclinic2/index.php');
}
//Pegar o valor do formulário.
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
}
if (!isset($_SESSION['email'])) {
    //Preparo da declaração.
    $stmt = $conn->prepare("SELECT email, senha, tipo FROM tabela_usuarios WHERE email='$email' AND senha='$senha'");
    $stmt->execute();
    //Transforma o statement em um array que eu posso usar.
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($email != "") {
        if (@$usuario['email'] == $email) {
            if ($usuario['senha'] == $senha) {
                echo 'login bem sucedido! <br>';
                $_SESSION['email'] = $email;
                $_SESSION['tipodeusuario'] = $usuario['tipo'];
                header('location: /vittaclinic2/index.php');
                if ($_SESSION['tipodeusuario'] == 'administrador') {
                    header('location: /vittaclinic2/paginas/administradores/administrador_minhapagina.php');
                }
                if ($_SESSION['tipodeusuario'] == 'medico') {
                    header('location: /vittaclinic2/paginas/medicos/medico_minhapagina.php');
                }
                if ($_SESSION['tipodeusuario'] == 'paciente') {
                    header('location: /vittaclinic2/paginas/pacientes/paciente_minhapagina.php');
                }
            }
        } else {
            echo 'Verifique seu email e/ou senha.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>Entrar</title>
    <?php
    seletorDeTemas();
    ?>
</head>
<body>
<?php
include 'C:\xampp\htdocs\vittaclinic2\paginas/comum\header1.php';
?>
<p><h2>Entrar</h2></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email" name="email"> <br>
        Senha: <input type="password" name="senha"> <br>
        <input type="submit">
    </form>
    <p><a href="/vittaclinic2/paginas/comum/registro.php">Registrar</a></p>
</body>
</html>