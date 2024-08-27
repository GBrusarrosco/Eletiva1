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
        $capital = (float) $_POST['valor1'] ?? 0;
        $taxa_juros = (int) $_POST['valor2'] ?? 0;
        $periodo = (int) $_POST['valor3'] ?? 0;
        $juros_compostos = $capital * ((1 + $taxa_juros) ** $periodo);
        echo "<p>O valor dos juros compostos é: </p>" . number_format($juros_compostos, 2, ',', '.') . " m²";
    } catch(Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php

