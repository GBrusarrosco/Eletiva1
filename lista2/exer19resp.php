\<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reposta Exercício 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    try {
        $dia = (int) $_POST['valor1'] ?? 0;
        $valor_hora = $dia * 24;
        $valor_minuto = $valor_hora * 60;
        $valor_segundo = $valor_minuto * 60;
        echo "O valor do dia informado em horas é $valor_hora, e o valor em minutos é $valor_minuto, e o valor em segundos é $valor_segundo";
    } catch(Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php

