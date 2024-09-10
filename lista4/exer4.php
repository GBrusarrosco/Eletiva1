<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Validação de Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <main class="container">
        <form action="exer4resp.php" method="post">
            <div class="row mb-3">
                <div class="col">
                    <label for="dia" class="form-label">Dia</label>
                    <input type="number" class="form-control" id="dia" name="dia" min="1" max="31" required>
                </div>
                <div class="col">
                    <label for="mes" class="form-label">Mês</label>
                    <input type="number" class="form-control" id="mes" name="mes" min="1" max="12" required>
                </div>
                <div class="col">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="number" class="form-control" id="ano" name="ano" min="1900" max="2100" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Validar Data</button>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
