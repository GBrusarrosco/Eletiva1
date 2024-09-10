<php
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
            function contemPalavra(string $palavra, string $palavra2):string{
               if(str_contains($palavra, $palavra2))
               {
                return true;
               } else {
                return false;
               }
               
            }
            if($_SERVER('REQUEST_METHOD') == 'POST') {
               try {
                $palavra = $_POST['palavra'];
                $palavra2 = $_POST['palavra2'];
                if(contemPalavra($palavra)){
                    echo "A substring '$substring' está contida na string.";
                } else {
                    echo "A substring '$substring' não está contida na string.";
                }
               } catch(Execption $e) {
                    echo "Erro" . $e->getMessage();
               }
            }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>