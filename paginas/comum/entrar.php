<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
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
    $stmt = $conn->prepare("SELECT email, senha, tipo FROM tabela_administradores WHERE email='$email' AND senha='$senha'
    UNION SELECT email, senha, tipo FROM tabela_medicos WHERE email='$email' AND senha='$senha'
    UNION SELECT email, senha, tipo FROM tabela_pacientes WHERE email='$email' AND senha='$senha'");
    $stmt->execute();
    //Trás como array associativo, onde as chaves são os nomes das colunas.
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    //Transforma o statement em um array que eu posso usar.
    if ($email != "") {
        if ($usuario['email'] == $email) {
            if ($usuario['senha'] == $senha) {
                echo 'login bem sucedido! <br>';
                $_SESSION['email'] = $email;
                $_SESSION['tipodeusuario'] = $usuario['tipo'];
                header('location: /vittaclinic2/index.php');
            } else {
                echo 'Verifique sua senha.';
            }
        } else {
            echo 'Verifique seu email.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>Entrar</title>
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
    <p><h2>Entrar</h2></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email" name="email"> <br>
        Senha: <input type="password" name="senha"> <br>
        <input type="submit">
    </form>
    <p><a href="/vittaclinic2/paginas/comum/registro.php">Registrar</a></p>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
</body>
</html>