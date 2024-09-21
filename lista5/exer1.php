<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <form action="" method="POST">
        <?php for($i=1; $i <= 5; $i++): ?>
        <input type="text" name="nomes[]" placeholder ="Valor <?= $i ?>"/>
        <input type="tel" name="telefones[]" placeholder ="telefone <?= $i ?>"/>
        <?php endfor; ?>
        <button type="submit">Enviar</button>
    </form>

    <?php
     if ($_SERVER['REQUEST_METHOD'] == "POST"){
            try {
                $nomes = $_POST['nomes'];
                $telefones = $_POST['telefones'];
                $novo_array = [];
                foreach($nomes as $chave => $valor) {
                    if(!isset($novo_array[$valor]) && !in_array($telefones[$chave], $novo_array)){
                        $novo_array[$valor] = $telefones[$chave];
                    }
                }
                print_r($novo_array);
            } catch(Exception $e){
                echo $e->getMessage();
            }
        }
    ?>
  </body>
</html>