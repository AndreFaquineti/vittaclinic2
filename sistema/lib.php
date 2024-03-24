<?php
//Escreve o email e tipo de usuario ou botão de Entrar/registrar
function escreverUsuarioEmailTipo() {
    if (isset($_SESSION['email'])) {
        echo 'usuario: ' . $_SESSION['email'] . ' tipo: ' . $_SESSION['tipodeusuario'];
        echo ' <a href="/vittaclinic2/paginas/comum/sair.php">Sair</a>';
    } else {
        echo '<p><a href="/vittaclinic2/paginas/comum/entrar.php">Entrar/Registrar</a></p>';
    }
}
//Gerar o link que direciona para a pagina de cada tipo de usuario
function minhaPaginaTipoUsuario() {
    if (isset($_SESSION['tipodeusuario'])) {
        if ($_SESSION['tipodeusuario'] == 'administrador') {
            echo '<p><a href="/vittaclinic2/paginas/administradores/administrador_minhapagina.php">Minha Página</a></p>';
        }
        if ($_SESSION['tipodeusuario'] == 'medico') {
            echo '<p><a href="/vittaclinic2/paginas/medicos/medico_minhapagina.php">Minha Página</a></p>';
        }
        if ($_SESSION['tipodeusuario'] == 'paciente') {
            echo '<p><a href="/vittaclinic2/paginas/pacientes/paciente_minhapagina.php">Minha Página</a></p>';
        }
    }
}
//Seletor de temas
function seletorDeTemas() {
    if (!isset ($_SESSION['tema'])) {
        $_SESSION['tema'] == 0;
    }
    if (isset ($_SESSION['tema'])) {
        if (($_SESSION['tema'] == 0)) {
            echo '<link rel="stylesheet" href="/vittaclinic2/sistema/estilos_light.css">';
        }
        if (($_SESSION['tema'] == 1)) {
            echo '<link rel="stylesheet" href="/vittaclinic2/sistema/estilos_dark.css">';
        }
    }
}
//Redirecionador de não administradores
function filtroAcessoAdmin() {
    if (!isset($_SESSION['tipodeusuario'])) {
        header('location: /vittaclinic2/paginas/comum/entrar.php');
    }
    if ($_SESSION['tipodeusuario'] != 'administrador'){
        header('location: /vittaclinic2/index.php');
    }
}
//Redirecionador de não medicos
function filtroAcessoMedico() {
    if (!isset($_SESSION['tipodeusuario'])) {
        header('location: /vittaclinic2/paginas/comum/entrar.php');
    }
    if ($_SESSION['tipodeusuario'] != 'medico'){
        header('location: /vittaclinic2/index.php');
    }
}
//Redirecionador de não pacientes
function filtroAcessoPaciente() {
    if (!isset($_SESSION['tipodeusuario'])) {
        header('location: /vittaclinic2/paginas/comum/entrar.php');
    }
    if ($_SESSION['tipodeusuario'] != 'paciente'){
        header('location: /vittaclinic2/index.php');
    }
}
//Pegar a data de hoje no formatO YYYY-MM-DD
function dataHoje() {
    $hoje = getdate();
    $hoje_ano = strval($hoje['year']);
    $hoje_mes = strval($hoje['mon']);
    $hoje_dia = strval($hoje['mday']);
    if ($hoje_mes != 10 OR 11 OR 12) {
        $hoje_mes = '0'.$hoje_mes;
    }
    $hoje_data = $hoje_ano . '-' . $hoje_mes . '-' . $hoje_dia;
}
?>