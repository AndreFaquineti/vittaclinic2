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
        //Gera o calendario de escolha html
        if (empty($email_medico)) {
            echo '<input type="date" id="date" name="data_escolhida" min="' . $hoje_data . '" value="' . $data_escolhida . '"" disabled>';
        }
        if (!empty($email_medico)) {
            echo '<input type="date" id="date" name="data_escolhida" min="' . $hoje_data . '" value="' . $data_escolhida . '"">';
        }
        ?>
        </label> <br>
        <?php
        //Pega a data escolhida e manda pra mim usar
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
echo $email_medico . '<br>';
echo $data_escolhida;
?>

</body>
</html>