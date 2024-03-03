<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
?>
<?php
if(!isset($email)) {
    $email = "";
    $senha = "";
}
//Pegar o valor do formulário.
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = ($_POST['email']);
    $senha = ($_POST['senha']);
}
//Preparo da declaração.
$tabela = "tabela_administradores";
$stmt = $conn->prepare("SELECT email, senha FROM $tabela WHERE email='$email' AND senha='$senha'");
$stmt->execute();
//Trás como array associativo, onde as chaves são os nomes das colunas.
$resultado =$stmt->SetFetchMode(PDO::FETCH_ASSOC);
//Transforma o statement em um array que eu posso usar.
foreach($stmt as $usuario);
if (isset($usuario['email'])) {
    if (($usuario['email'] == $email)) {
        if($usuario['senha'] == $senha) {
            $_SESSION['email'] = $email;
            $_SESSION['tipodeusuario'] = "administrador";
        } else {
            echo 'verifique sua senha';
        }
    } else {
        $tabela = "tabela_medicos";
        $stmt = $conn->prepare("SELECT email, senha FROM $tabela WHERE email='$email' AND senha='$senha'");
        $stmt->execute();
        $resultado =$stmt->SetFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt as $usuario);
        if (($usuario['email'] == $email)) {
            if($usuario['senha'] == $senha) {
                $_SESSION['email'] = $email;
                $_SESSION['tipodeusuario'] = "medico";
            } else {
                echo 'verifique sua senha';
            }
        } else {
            $tabela = "tabela_pacientes";
            $stmt = $conn->prepare("SELECT email, senha FROM $tabela WHERE email='$email' AND senha='$senha'");
            $stmt->execute();
            $resultado =$stmt->SetFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt as $usuario);
            if (($usuario['email'] == $email)) {
                if($usuario['senha'] == $senha) {
                    $_SESSION['email'] = $email;
                    $_SESSION['tipodeusuario'] = "paciente";
                } else {
                    echo 'verifique sua senha';
                }
            } else {
                echo 'verifique seu email';
            }
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
    <?php
    if (isset($_SESSION['email'])) {
        echo 'usuario: ' . $_SESSION['email'] . ' tipo: ' . $_SESSION['tipodeusuario'];
    } else {
        echo '<p><a href="/vittaclinic2/paginas/comum/entrar.php">Entrar/Registrar</a></p>';
    }
    ?>
    <p><h2>Entrar</h2></p>
    <p>Nessa página o usuario deve poder fazer login.</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email" name="email"> <br>
        Senha: <input type="password" name="senha"> <br>
        <input type="submit">
    </form>
    <p><a href="/vittaclinic2/paginas/comum/registro.php">Registrar</a></p>
    <p><a href="/vittaclinic2/paginas/comum/sair.php">Sair</a></p>
</body>
</html>