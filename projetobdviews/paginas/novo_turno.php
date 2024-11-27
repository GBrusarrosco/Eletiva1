<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/turno_trabalho.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $periodo = $_POST['periodo'];
        $horario_inicio = $_POST['horario_inicio'];
        $horario_fim = $_POST['horario_fim'];

        if (empty($periodo) || empty($horario_inicio) || empty($horario_fim)) {
            $erro = "Todos os campos são obrigatórios!";
        } elseif (!cadastrarTurno($periodo, $horario_inicio, $horario_fim)) {
            $erro = "Erro ao cadastrar turno!";
        } else {
            header('Location: turnos.php');
            exit();
        }
    } catch (Exception $e) {
        $erro = "Erro: " . $e->getMessage();
    }
}
?>

<div class="container mt-5">
    <h2>Criar Novo Turno</h2>
    <?php if (!empty($erro)): ?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="periodo" class="form-label">Período</label>
            <input type="text" name="periodo" id="periodo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="horario_inicio" class="form-label">Horário Início</label>
            <input type="time" name="horario_inicio" id="horario_inicio" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="horario_fim" class="form-label">Horário Fim</label>
            <input type="time" name="horario_fim" id="horario_fim" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar Turno</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
