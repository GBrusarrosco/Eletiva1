<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/turno_trabalho.php';

$turnos = buscarTurnos();
?>

<div class="container mt-5">
    <h2>Gerenciamento de Turnos</h2>
    <a href="novo_turno.php" class="btn btn-success mb-3">Novo Turno</a>
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Período</th>
            <th>Horário Início</th>
            <th>Horário Fim</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($turnos as $turno): ?>
            <tr>
                <td><?= $turno['id'] ?></td>
                <td><?= $turno['periodo'] ?></td>
                <td><?= $turno['horario_inicio'] ?></td>
                <td><?= $turno['horario_fim'] ?></td>
                <td>
                    <a href="editar_turno.php?id=<?= $turno['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_turno.php?id=<?= $turno['id'] ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
