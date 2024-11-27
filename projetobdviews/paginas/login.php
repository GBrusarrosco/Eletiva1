<?php 

    require_once('../funcoes/funcionarios.php');
    require_once ('../config/bancodedados.php');
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        try{
            $email = $_POST['email'] ?? "";
            $senha = $_POST['senha'] ?? "";
            if ($email != "" && $senha != ""){
                $funcionario = login($email, $senha);
                var_dump($funcionario);
                if ($funcionario){
                    $_SESSION['funcionario'] = $funcionario['nome'];
                    $_SESSION['nivel'] = $funcionario['nivel'];
                    $_SESSION['id'] = $funcionario['id'];
                    $_SESSION['acesso'] = true;
                    header("Location: dashboard.php");
                } else {
                    $erro = "Credenciais inválidas!";
                }
            }
        } catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    require_once 'cabecalho.php'; 
?>

<div class="container mt-5">
    <h2>Login</h2>
    <form method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <?php
        if(isset($erro)) echo "<p class='text-danger'>$erro</p>";
    ?>
</div>

<?php require_once 'rodape.php'; ?>
