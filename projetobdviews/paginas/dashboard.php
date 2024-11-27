<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/cargos.php';
require_once '../funcoes/funcionarios.php';

$funcionario_id = $_SESSION['id'];
$total_pontos_mes = 0;
$dados_pontos = [];
$dados_cargos = gerarDadosGraficoCargos();


if ($_SESSION['nivel'] === 'user') {

    $total_pontos_mes = listarPontosPorMes($funcionario_id)['total_pontos'];
}


if ($_SESSION['nivel'] === 'adm') {
    $funcionarios = buscarFuncionarios();
    foreach ($funcionarios as $funcionario) {
        $dados_pontos[] = [
            'nome' => $funcionario['nome'],
            'total_pontos' => listarPontosPorMes($funcionario['id'])['total_pontos']
        ];
    }
}

?>

<main class="container">
    <div class="container mt-5">
        <h2>Dashboard</h2>

        <?php if ($_SESSION['nivel'] === 'user'): ?>
            <!-- Exibir gráfico de batidas de ponto no mês para 'user' -->
            <div id="chart_div_pontos" style="width: 100%; height: 500px;"></div>
        <?php elseif ($_SESSION['nivel'] === 'adm'): ?>
            <!-- Exibir gráfico de número de funcionários por cargo para 'adm' -->
            <div id="chart_div_cargos" style="width: 100%; height: 500px;"></div>
        <?php endif; ?>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Carregar a biblioteca do Google Charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            <?php if ($_SESSION['nivel'] === 'user'): ?>
            // Gráfico de Batidas de Ponto para usuário
            var data = google.visualization.arrayToDataTable([
                ['Funcionário', 'Batidas de Ponto'],
                ['Você', <?= $total_pontos_mes ?>] // Exibe a quantidade de batidas de ponto do usuário
            ]);

            var options = {
                title: 'Quantidade de Batidas de Ponto no Mês',
                hAxis: {title: 'Funcionário', titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0},
                chartArea: {width: '70%', height: '70%'}
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div_pontos'));
            chart.draw(data, options);
            <?php elseif ($_SESSION['nivel'] === 'adm'): ?>
            // Gráfico de Número de Funcionários por Cargo para administrador
            var data = google.visualization.arrayToDataTable([
                ['Cargo', 'Quantidade de Funcionários'],
                <?php foreach ($dados_cargos as $d): ?>
                ['<?= $d['cargo'] ?>', <?= $d['quantidade_funcionarios'] ?>],
                <?php endforeach; ?>
            ]);

            var options = {
                title: 'Número de Funcionários por Cargo',
                hAxis: {title: 'Cargos', titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0},
                chartArea: {width: '70%', height: '70%'}
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div_cargos'));
            chart.draw(data, options);
            <?php endif; ?>
        }
    </script>
</main>

<?php require_once 'rodape.php'; ?>
