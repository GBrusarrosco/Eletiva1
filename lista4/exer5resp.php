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
            function calculaRaiz(float $valor) {
                if($valor < 0) {
                    return false;
                } else {
                    return sqrt($valor);
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               try {
                    $valor = (float) $_POST['value'];
                    $resultado = calculaRaiz($valor);
                    if( $resultado) {
                        echo "O valor enviado transformado em raiz é: $resultado";
                    } else {
                        echo "o valor informado é menor que 0";
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