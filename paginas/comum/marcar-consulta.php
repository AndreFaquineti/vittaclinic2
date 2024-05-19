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
<p><a href="/vittaclinic2/index.php"><h1>Vitta.Clinic</h1></a></p>
<?php
escreverUsuarioEmailTipo();
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
            <!--Opção Vazia-->
            <option value="09:00">09:00</option>
            <option value="09:20">09:20</option>
            <option value="09:40">09:40</option>
            <?php
            $opcao_hora = 10;
            for ($opcao_hora = 10; $opcao_hora <= 17; $opcao_hora++) {
                echo '<option value="' . $opcao_hora . ':00"> ' . $opcao_hora . ':00</option>';
                echo '<option value="' . $opcao_hora . ':20"> ' . $opcao_hora . ':20</option>';
                echo '<option value="' . $opcao_hora . ':40"> ' . $opcao_hora . ':40</option>';
            }
            ?>
        </select>
    </label> <br>
    <label> Marcar Consulta:
        <input type="submit">
    </label> <br>
    <?php
    if (empty($email_medico)) {
        echo 'Escolha um médico. <br>';
    }
    if(empty($data_escolhida)) {
        echo 'Escolha uma data. <br>';
    }
    ?>
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
<?php
if(isset($email_medico)){
    echo $email_medico . '<br>';
}
if(isset($email_medico)){
    echo $data_escolhida;
}
?>

</body>
</html>