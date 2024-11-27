<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/cargos.php';

session_start();
if (!isset($_SESSION['acesso']) || $_SESSION['nivel'] != 'adm') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    echo "<div class='alert alert-danger'>ID inválido.</div>";
    require_once 'rodape.php';
    exit;
}

$cargo = buscarCargoPorId((int)$id);

if (!$cargo) {
    echo "<div class='alert alert-danger'>Cargo não encontrado.</div>";
    require_once 'rodape.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    if (excluirCargo((int)$id)) {
        header('Location: cargos.php?success=Cargo excluído com sucesso');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erro ao excluir o cargo.</div>";
    }
}
?>

<div class="container mt-5">
    <h2>Excluir Cargo</h2>

    <p>Tem certeza de que deseja excluir o cargo abaixo?</p>
    <ul>
        <li><strong>Nome:</strong> <?= htmlspecialchars($cargo['nome']) ?></li>
    </ul>
    <form method="post">
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="cargos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
