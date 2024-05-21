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
<p><h1>Marque sua consulta</h1></p>
<p>Aqui o usuario deve poder marcar consultas</p>
<!--Formulário para marcar uma consulta-->
<form method="post" action="">
    <!--Formulário para escolher médicos-->
    <label>Escolha o médico da sua consulta:
        <select name="email_medico">
            <option value=""><?php if (!isset($email_medico)) {echo 'Escolha um médico';}?></option>
            <?php
                //Mantém selecionado a opção escolhida.
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email_medico = $_POST['email_medico'];
                }
                if ($email_medico != '') {
                    echo '<option value="' . $email_medico . '"selected>' . $email_medico . '</option>';
                }
                //Busca os emails dos médicos cadastrados
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
        if (!isset($data_escolhida)) {
            $data_escolhida = '';
        }
        //Pegar o dia de hoje de acordo com o sistema
        $hoje = getdate();
        $hoje_ano = strval($hoje['year']);
        $hoje_mes = strval($hoje['mon']);
        $hoje_dia = strval($hoje['mday']);
        if ($hoje_mes != 10 && $hoje_mes != 11 && $hoje_mes != 12) {
            $hoje_mes = '0'.$hoje_mes;
        }
        //Concatena a data de hoje no formato YYYY-MM-DD
        $hoje_data = $hoje_ano . '-' . $hoje_mes . '-' . $hoje_dia;
        //Pega a data escolhida e manda pra mim usar
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['data_escolhida'])) {
                $data_escolhida = $_POST['data_escolhida'];
            }
        }
        //Gera o calendario de escolha html
        if (empty($email_medico)) {
            echo '<input type="date" id="date" name="data_escolhida" min="' . $hoje_data . '" value="' . $data_escolhida . '"" disabled>';
        }
        if (!empty($email_medico) && empty($data_escolhida)) {
            echo '<input type="date" id="date" name="data_escolhida" min="' . $hoje_data . '" value="' . $data_escolhida . '"">';
        }
        if($data_escolhida != '') {
            echo '<input type="date" id="date" name="data_escolhida" min="' . $hoje_data . '" value="' . $data_escolhida . '"">';
        }
        ?>
    </label> <br>
    <label> Escolha um horario:
        <select name="hora_escolhida" <?php if(empty($data_escolhida)) {echo 'disabled';} ?>>
            <option value=""><?php if (!isset($hora_escolhida)) {echo 'Escolha um Horario';}?></option>
            <?php
            if (!empty($data_escolhida)) {
                $stmt = $conn->prepare("SELECT TIME(horario) as horario FROM `tabela_horarios_$email_medico` WHERE DATE(horario)='$data_escolhida'");
                $stmt -> execute();
                $array_medico_horarios = $stmt->fetchALL(PDO::FETCH_COLUMN);

                $stmt = $conn->prepare("SELECT TIME(horario) as horario FROM `tabela_horarios_padrao`");
                $stmt -> execute();
                $array_horarios_padrao = $stmt->fetchALL(PDO::FETCH_COLUMN);

                $array_horarios_disponiveis = array_diff($array_horarios_padrao, $array_medico_horarios);

                foreach($array_horarios_disponiveis as $horarios_disponiveis) {
                    echo '<option value="' . $horarios_disponiveis . '">' . $horarios_disponiveis . '</option>';
                }
            }
            //Mantém selecionado a opção escolhida.
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $hora_escolhida = $_POST['hora_escolhida'];
            }
            if ($hora_escolhida != '') {
                echo '<option value="' . $hora_escolhida . '"selected>' . $hora_escolhida . '</option>';
            }
            ?>
        </select>
    </label> <br>
    <label> Marcar Consulta:
        <input type="submit"> <br>
        <?php
        //Enviar para base de dados o email do paciente e o datetime
        if(!empty($email_medico) && !empty($data_escolhida) && !empty($hora_escolhida)) {
            //Concatenar data e hora e pegar email do paciente
            $datahora = $data_escolhida . ' ' . $hora_escolhida;
            $email_paciente = $_SESSION['email'];
            $stmt = $conn->prepare("INSERT INTO `tabela_horarios_$email_medico` (horario, email_paciente) VALUES ('$datahora', '$email_paciente')");
            $stmt -> execute();
            $stmt = $conn->prepare("INSERT INTO `tabela_registros` (horario, email_paciente, email_medico) VALUES ('$datahora', '$email_paciente', '$email_medico')");
            $stmt -> execute();
            echo 'Agendamento bem sucedido!' . '<br>' . 'Médico: ' . $email_medico . 'Dia: ' . $data_escolhida . 'Horário: ' . $hora_escolhida . '<br>';
        }
        ?>
    </label> <br>
</form>
</body>
</html>