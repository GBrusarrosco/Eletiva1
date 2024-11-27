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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    if (empty($nome)) {
        echo "<div class='alert alert-danger'>O campo Nome é obrigatório.</div>";
    } else {
        if (alterarCargo((int)$id, $nome)) {
            header('Location: cargos.php?success=Cargo atualizado com sucesso');
            exit;
        } else {
            echo "<div class='alert alert-danger'>Erro ao atualizar o cargo.</div>";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Editar Cargo</h2>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($cargo['nome']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Cargo</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
