<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
require 'C:\xampp\htdocs\vittaclinic2\sistema\lib.php';
?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>VittaClinic</title>
    <?php
    $_SESSION['tema'] = 1;
    seletorDeTemas();
    ?>
</head>
<body>
    <a href="/vittaclinic2/index.php"><h1>Vitta.Clinic</h1></a>
    <?php
    escreverUsuarioEmailTipo();
    minhaPaginaTipoUsuario();
    ?>
    <p><a href="/vittaclinic2/paginas/comum/marcar-consulta.php">Marcar Consulta</a></p>
<?php
$stmt = $conn->prepare("SELECT * FROM tabela_usuarios");
$stmt->execute();
$lista_emails = $stmt->fetchall(PDO::FETCH_ASSOC);

foreach ($lista_emails as $emails) {
    echo $emails['tipo'] . ' ' . '----' . ' ' . $emails['email'] . '<br>';
}
?>
</body>
</html>