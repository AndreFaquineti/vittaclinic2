<?php
session_start();
require 'C:\xampp\htdocs\vittaclinic2\sistema\conexao.php';
require 'C:\xampp\htdocs\vittaclinic2\sistema\lib.php';
//Redirecionador de não usuario
if (!isset($_SESSION['tipodeusuario'])) {
    header('location: /vittaclinic2/paginas/comum/entrar.php');
}
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
    <p><a href="/vittaclinic2/index.php"><h1>Vitta.Clinic</h1></a></p>
    <?php
    escreverUsuarioEmailTipo();
    ?>
    <p><h1>Marque sua consulta</h1></p>
    <p>Aqui o usuario deve poder marcar consultas</p>
    <p>Um médico não deve poder marcar consultas com si mesmo</p>

    <?php
    //Seletor de médico
    if (!isset($email_medico)) {
        $email_medico = '';
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['email_medico'])) {
            $email_medico = $_POST['email_medico'];
        }
    }
    if ($email_medico != 'nao_selecionado') {
        echo $email_medico . '<br>';
    } else {
        echo 'Selecione um médico.';
    }
    ?>
    <?php
    //Seletor de datas (o formulário ficou em baixo por causa de uma váriavel indefinida)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['data_escolhida'])) {
            $data_escolhida = $_POST['data_escolhida'];
        }
    }
    if (!isset($data_escolhida)) {
        $data_escolhida = '';
    }
    if ($data_escolhida == '') {
        echo 'Escolha uma data';
    }
    ?>
    <form method="post">
        <label> Escolha o médico da sua consulta:
            <select name="email_medico">
            <option value="nao_selecionado"> Lista de médicos </option>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email_medico = $_POST['email_medico'];
                }
                if ($email_medico != 'nao_selecionado') {
                    echo '<option value="' . $email_medico . '"selected>' . $email_medico . '</option>';
                }
                $stmt = $conn->prepare("SELECT email FROM tabela_usuarios WHERE tipo='medico' AND email!='$email_medico'");
                $stmt -> execute();
                $lista_medicos = $stmt->fetchall(PDO::FETCH_ASSOC);
                foreach ($lista_medicos as $medicos) {
                    echo '<option value="' . $medicos['email'] . '">' . $medicos['email'] . '</option>';
                }
            ?>
            </select>
        </label> <br>
        <label>Escolha um dia:
        <?php
        $hoje = getdate();
        $hoje_ano = strval($hoje['year']);
        $hoje_mes = strval($hoje['mon']);
        $hoje_dia = strval($hoje['mday']);
        if ($hoje_mes != 10 && $hoje_mes != 11 && $hoje_mes != 12) {
            $hoje_mes = '0'.$hoje_mes;
        }
        $hoje_data = $hoje_ano . '-' . $hoje_mes . '-' . $hoje_dia;
        echo '<input type="date" id="date" name="data_escolhida" min="' . $hoje_data . '" value="' . $data_escolhida . '"">';
        ?>
        <input type="submit">
        </label>
        <input type="submit">
    </form>
    <?php
    if (isset($email_medico) && $email_medico !='' && isset($data_escolhida) && $data_escolhida !='') {
        $stmt = $conn->prepare("SELECT * FROM `tabela_horarios_$email_medico` WHERE DATE(horario)='$data_escolhida'");
        $stmt -> execute();
        $array_medico_horarios = $stmt->fetchALL(PDO::FETCH_ASSOC);
        foreach ($array_medico_horarios as $medico_horarios) {
        echo 'Horario:' . $medico_horarios['horario'] . ' Paciente:' . $medico_horarios['email_paciente'] . '<br>';
    }
    }
    ?>
</body>
</html>