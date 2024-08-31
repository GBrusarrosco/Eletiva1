!<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resposta Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
       if($_SERVER["REQUEST_METHOD"] == 'POST') {
        try
        {
            $valor_produto = (int) $_POST["valor1"];   
            if($valor_produto > 100) 
            {
               $valor_final = $valor_produto - (($valor_produto * 15) / 100);
               echo "O valor final a ser pago com o desconto de 15% é R$: $valor_final";
            } else 
            {
               $valor_final = $valor_produto;
               echo "O valor final a ser pago é: $valor_final";
            }
        } catch (Exception $e) {
            echo $e->getMessage();            
        } 
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>