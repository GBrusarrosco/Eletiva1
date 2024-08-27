\<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reposta Exercício 12</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    try {
        $peso = (float) $_POST['valor1'] ?? 0;
        $altura = (float) $_POST['valor2'] ?? 0;
        $imc = ($peso * $altura) ** 2;
        echo "<p>O IMC é: </p>" . number_format($imc, 2, ',', '.') . " m²";
    } catch(Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php
