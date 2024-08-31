!<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
       if($_SERVER["REQUEST_METHOD"] == 'POST') {
        try
        {
            $menor_valor = PHP_INT_MAX;
            $pos_menor = 0;
            for ($i=1; $i<=7; $i++)
            {
                $valor = $_POST["valor$i"];
                if($valor < $menor_valor)
                {
                    $menor_valor = $valor;
                    $pos_menor = $i;
                }
            }  
            echo "<p>Menor valor: $menor_valor</p>";
            echo "<p>Menor posição: $pos_menor</p>";
        } catch (Exception $e) {
            echo $e->getMessage();            
        } 
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>