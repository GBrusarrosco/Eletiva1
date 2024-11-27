<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/cargos.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['acesso']) || $_SESSION['nivel'] != 'adm') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    if (empty($nome)) {
        echo "<div class='alert alert-danger'>O campo Nome é obrigatório.</div>";
    } else {
        if (cadastrarCargo($nome)) {
            header('Location: cargos.php?success=Cargo cadastrado com sucesso');
            exit;
        } else {
            echo "<div class='alert alert-danger'>Erro ao cadastrar o cargo.</div>";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Criar Novo Cargo</h2>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar Cargo</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
