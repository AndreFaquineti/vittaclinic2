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
<?php
include 'C:\xampp\htdocs\vittaclinic2\paginas/comum\header1.php';
?>
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