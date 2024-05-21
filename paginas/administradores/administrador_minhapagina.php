<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
require 'C:\xampp\htdocs\vittaclinic2\sistema\lib.php';
filtroAcessoAdmin();
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
<p><h2>Administrador minha página.</h2></p>
    <p>
    <h3>Cadastrar médicos</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email" name="email_medico">
        Senha: <input type="password" name="senha_medico">
        <input type="submit">
    </form>
    <?php
    //Registro de médicos
    if (!isset($email_medico)) {
        $email_medico = '';
        $senha_medico = '';
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['email_medico'])) {
            $email_medico = $_POST['email_medico'];
            $senha_medico = $_POST['senha_medico'];
        }
    }
    if (isset($email_medico) & ($email_medico) != '') {
        $stmt = $conn->prepare("SELECT email FROM tabela_usuarios WHERE email='$email_medico'");
        $stmt->execute();
        $novo_usuario = $stmt-> fetch(PDO::FETCH_ASSOC);
        if (@$novo_usuario['email'] == $email_medico) {
            echo 'Esse email já está sendo utilidado.';
        } else {
            if ($senha_medico != '') {
                $stmt = $conn->prepare("INSERT INTO tabela_usuarios (email, senha, tipo) VALUES ('$email_medico', '$senha_medico', 'medico')");
                $stmt->execute();
                $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS `tabela_horarios_$email_medico`
                                        (horario datetime NOT NULL UNIQUE,
                                        email_paciente varchar(255) NOT NULL,
                                        FOREIGN KEY (email_paciente) REFERENCES tabela_usuarios(email),
                                        PRIMARY KEY (horario)
                                        );");
                $stmt->execute();
                echo 'Médico cadastrado com sucesso.';
            } else {
                echo 'Digite uma senha';
            }
        }
    }
    ?>
    </p>
    <p>
    <h3>Cadastrar administradores</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email: <input type="email" name="email_administrador">
        Senha: <input type="password" name="senha_administrador">
        <input type="submit">
    </form>
    <?php
    //Registro de administradores
    if (!isset($email_administrador)) {
        $email_administrador = '';
        $senha_administrador = '';
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['email_administrador'])) {
            $email_administrador = $_POST['email_administrador'];
            $senha_administrador = $_POST['senha_administrador'];
        }
    }
    if (isset($email_administrador) & ($email_administrador) != '') {
        $stmt = $conn->prepare("SELECT email FROM tabela_usuarios WHERE email='$email_administrador'");
        $stmt->execute();
        $novo_usuario = $stmt-> fetch(PDO::FETCH_ASSOC);
        if (@$novo_usuario['email'] == $email_administrador) {
            echo 'Esse email já está sendo utilidado.';
        } else {
            if ($senha_administrador != '') {
                $stmt = $conn->prepare("INSERT INTO tabela_usuarios (email, senha, tipo) VALUES ('$email_administrador', '$senha_administrador', 'administrador')");
                $stmt->execute();
                echo 'Administrador cadastrado com sucesso.';
            } else {
                echo 'Digite uma senha';
            }
        }
    }
    ?>
    </p>
</body>
</html>