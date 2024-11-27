<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/funcionarios.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$funcionarioId = $_SESSION['id'];

$funcionario = retornaUsuarioPorId($funcionarioId);

if (!$funcionario) {
    echo "<div class='alert alert-danger'>Erro: Não foi possível carregar as informações do funcionário.</div>";
    require_once 'rodape.php';
    exit;
}
?>

<div class="container mt-5">
    <h2>Minhas Informações</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dados Pessoais</h5>
            <p><strong>Nome:</strong> <?= htmlspecialchars($funcionario['nome']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($funcionario['email']) ?></p>
            <p><strong>Telefone:</strong> <?= htmlspecialchars($funcionario['telefone'] ?? 'Não informado') ?></p>
        </div>
        <div class="card-body">
            <h5 class="card-title">Informações de Trabalho</h5>
            <p><strong>Cargo:</strong> <?= htmlspecialchars($funcionario['cargo']) ?></p>
            <p><strong>Turno:</strong> <?= htmlspecialchars($funcionario['turno']) ?></p>
        </div>
    </div>
</div>

<?php require_once 'rodape.php'; ?>
