
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
       if($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            $valor = $_POST['valor'];
            $qtd_caracteres = strlen($valor);
            $maiusculo = strtoupper($valor);
            $minusculo = strtolower($valor);
            $dia = 30;
            $mes = 2;
            $ano = 2024;
            if(checkdate($mes, $dia, $ano)) {
                echo "Data válida";
            } else {
                echo "Data inválida";
            }
            $menor = min(1,2,3,4,5,6);
            echo "O menor valor é: $menor";
            $maior = max(1,2,3,4,5,6);
            echo "o maior valor é: $maior";
            $aleatorio = rand(1, 100);
            echo "Aleatório $aleatorio";
            $numero = 1567.98;
            $valor_formatado = number_format($numero, 2, ",", ".");
            echo "Valor formatado $valor_formatado";
            echo "Maiúsculo $maiusculo";
            echo "Minúsculo $minusculo";
            echo "Quantidade de caracteres $qtd_caracteres";
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
       }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>