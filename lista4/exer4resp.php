<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <main>
        <?php
            function verificaData(int $dia, int $mes, int $ano): string {
                if (checkdate($mes, $dia, $ano)) {
                    return sprintf('%02d/%02d/%04d', $dia, $mes, $ano);
                } else {
                    return '';
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               try {
                    $dia = intval($_POST['dia']);
                    $mes = intval($_POST['mes']);
                    $ano = intval($_POST['ano']);
                    $resultado = verificaData($dia, $mes, $ano);
                    if ($resultado) {
                        echo "A Data enviada está correta formatada da seguinte forma: $resultado";
                    } else {
                        echo "O valor informado não é válido.";
                    }
               } catch (Exception $e) {
                    echo "Erro: " . $e->getMessage();
               }
            }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
