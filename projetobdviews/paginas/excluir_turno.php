<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/turno_trabalho.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: turnos.php');
    exit();
}

$turno = buscarTurnoPorId((int)$id);
if (!$turno) {
    header('Location: turnos.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (removerTurno((int)$id)) {
        header('Location: turnos.php');
        exit();
    } else {
        $erro = "Erro ao excluir turno.";
    }
}
?>

<div class="container mt-5">
    <h2>Excluir Turno</h2>
    <p>Tem certeza de que deseja excluir o turno abaixo?</p>
    <ul>
        <li><strong>Período:</strong> <?= $turno['periodo'] ?></li>
        <li><strong>Horário Início:</strong> <?= $turno['horario_inicio'] ?></li>
        <li><strong>Horário Fim:</strong> <?= $turno['horario_fim'] ?></li>
    </ul>
    <form method="post">
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="turnos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
