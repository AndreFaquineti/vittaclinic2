<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
require 'C:\xampp\htdocs\vittaclinic2\sistema\lib.php';
filtroAcessoPaciente();
?>
<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title>Marque sua consulta</title>
    <?php
    seletorDeTemas();
    ?>  
</head>
<body>
<?php
include 'C:\xampp\htdocs\vittaclinic2\paginas/comum\header1.php';
?>
<p>Paciente minha página.</p>
<p>
<table>
    <tr>
        <th>Paciente</th>
        <th>Médico</th>
        <th>Horario</th>
    </tr>
    <?php
    //Conversão de variaveis
    $email_paciente = $_SESSION['email'];
    //Buscar os dados associados ao paciente
    $stmt = $conn->prepare("SELECT * FROM tabela_registros WHERE email_paciente = '$email_paciente'");
    $stmt->execute();
    $array_lista_consultas = $stmt->fetchall(PDO::FETCH_ASSOC);
    //Escrever as rows de acordo com as informações dos arrays
    foreach ($array_lista_consultas as $lista_consultas) {
        echo
        '<tr>
            <td>' . $lista_consultas['email_paciente'] .'</td>
            <td>' . $lista_consultas['email_medico'] .'</td>
            <td>' . $lista_consultas['horario'] . '</td>
         </tr>';
    };
    ?>
</table>
</p>
</body>