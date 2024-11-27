<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/cargos.php';

$cargos = buscarCargos();
if (!$cargos || !is_array($cargos)) {
    echo "<div class='alert alert-danger'>Erro ao carregar os cargos.</div>";
    require_once 'rodape.php';
    exit;
}
?>

<div class="container mt-5">
    <h2>Gerenciamento de Cargos</h2>
    <a href="novo_cargo.php" class="btn btn-success mb-3">Novo Cargo</a>
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cargos as $cargo): ?>
            <tr>
                <td><?= htmlspecialchars($cargo['id']) ?></td>
                <td><?= htmlspecialchars($cargo['nome']) ?></td>
                <td>
                    <a href="editar_cargo.php?id=<?= htmlspecialchars($cargo['id']) ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_cargo.php?id=<?= htmlspecialchars($cargo['id']) ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
