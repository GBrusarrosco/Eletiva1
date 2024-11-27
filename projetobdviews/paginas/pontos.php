<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/funcionarios.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$funcionario_id = $_SESSION['id'] ?? null;

if (!$funcionario_id) {
    echo "<div class='alert alert-danger'>Usuário não autenticado.</div>";
    require_once 'rodape.php';
    exit;
}

$pontos = listarPontos($funcionario_id);
if (!$pontos || !is_array($pontos)) {
    echo "<div class='alert alert-danger'>Erro ao carregar os pontos registrados.</div>";
    require_once 'rodape.php';
    exit;
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Gerenciamento de Pontos</h2>
        <a href="batida_ponto.php" class="btn btn-danger">Bater ponto</a>
    </div>
    <table class="table table-hover table-striped mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Funcionário</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Tipo</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pontos as $ponto): ?>
            <tr>
                <td><?= htmlspecialchars($ponto['id'] ?? 'ID não definido') ?></td>
                <td><?= htmlspecialchars($ponto['funcionario_nome'] ?? 'Nome não definido') ?></td>
                <td><?= htmlspecialchars($ponto['data'] ?? 'Data não definida') ?></td>
                <td><?= htmlspecialchars($ponto['horario'] ?? 'Hora não definida') ?></td>
                <td><?= ucfirst(htmlspecialchars($ponto['tipo'] ?? 'Tipo não definido')) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
