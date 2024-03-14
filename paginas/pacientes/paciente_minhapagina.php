<?php
session_start();
//Redirecionador de acesso não autorizado
if (isset($_SESSION['tipodeusuario'])) {
    if ($_SESSION['tipodeusuario'] != 'paciente') {
        header('location: /vittaclinic2/index.php');
    }
} else {
    header('location: /vittaclinic2/paginas/comum/entrar.php');
}
?>
<a href="/vittaclinic2/index.php">Vittaclinic</a>
<p>Paciente minha página.</p>