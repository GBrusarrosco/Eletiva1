<?php
    declare(strict_types = 1);
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
    <?php
        function soma(int $a, int $b): int{
            return $a + $b;
        } 
        
        function subtracao(int $a, int $b): int{
            echo "Subtração: " . ($a - $b);
        }
        
        function saudacao(string $nome = "Visitante"): void{
            echo "Olá $nome";
        }

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            try {
                $valor1 = $_POST['valor1'];
                $valor2 = $_POST['valor2'];
                $soma = soma($valor1, $valor2);
                echo "O valor da soma é: $soma";
                subtracao($valor1, $valor2);
                saudacao();
                saudacao("Vanessa");
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>