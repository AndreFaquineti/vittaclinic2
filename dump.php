<form>
        <select name="data">
        <option value="nao_selecionado"> Data </option>
        </select> <br>
    </form>
    <?php
    $hoje = getdate();
    $hoje_dia = $hoje['mday'];
    $hoje_mes = $hoje['mon'];
    $hoje_ano = $hoje['year'];
    echo 'dia: ' . $hoje_dia . '<br>mês: ' . $hoje_mes . '<br>ano: ' . $hoje_ano . '<br';
    ?>
    <?php
    $array1 = array(
        0, 10, 20, 30, 40, 50
    );
    print_r($array1);
    echo '<br>';
    ?>
    <?php
    $current_date = new DateTime();
    $interval = new DateInterval('P30D');
    $end_date = (clone $current_date)->modify('+10 days');

    $period = new DatePeriod($current_date, new DateInterval('P1D'), $end_date);
    foreach ($period as $date) {
        echo $date->format('Y-m-d') . "\n" . '<br>';
    }
    ?>