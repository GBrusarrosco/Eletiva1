<?php
require_once 'cabecalho.php';
require_once 'navbar.php';
require_once '../funcoes/funcionarios.php';
require_once '../funcoes/cargos.php';
require_once '../funcoes/turno_trabalho.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID do funcionário inválido ou não fornecido.</div>";
    exit;
}

$id = (int)$_GET['id'];
$funcionario = retornaUsuarioPorId($id);

if (!$funcionario) {
    echo "<div class='alert alert-danger'>Funcionário com ID $id não encontrado.</div>";
    exit;
}

// Processa a submissão do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? null);
    $cargo_id = (int)($_POST['cargo_id'] ?? 0);
    $turno_id = (int)($_POST['turno_id'] ?? 0);
    $telefone = trim($_POST['telefone'] ?? null);

    // Validações básicas
    if (empty($nome) || empty($email) || !$cargo_id || !$turno_id) {
        echo "<div class='alert alert-danger'>Todos os campos obrigatórios devem ser preenchidos.</div>";
    } else {
        // Atualiza os dados do funcionário
        if ($senha) {
            // Atualiza a senha apenas se for fornecida
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
            alterarFuncionario($id, $nome, $email, $cargo_id, $turno_id, $telefone);
            $stmt = $pdo->prepare("UPDATE funcionario SET senha = :senha WHERE id = :id");
            $stmt->execute([':senha' => $senhaHash, ':id' => $id]);
        } else {
            alterarFuncionario($id, $nome, $email, $cargo_id, $turno_id, $telefone);
        }
        header('Location: funcionarios.php?success=Funcionário atualizado com sucesso');
        exit;
    }
}

$cargos = buscarCargos();
$turnos = buscarTurnos();
?>

<div class="container mt-5">
    <h2>Editar Funcionário</h2>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($funcionario['nome']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($funcionario['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha</label>
            <input type="password" name="senha" id="senha" class="form-control">
            <small class="form-text text-muted">Deixe em branco para manter a senha atual.</small>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="<?= htmlspecialchars($funcionario['telefone'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="cargo_id" class="form-label">Cargo</label>
            <select name="cargo_id" id="cargo_id" class="form-select" required>
                <option value="">Selecione o cargo</option>
                <?php foreach ($cargos as $cargo): ?>
                    <option value="<?= $cargo['id'] ?>" <?= $cargo['id'] == $funcionario['cargo_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cargo['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="turno_id" class="form-label">Turno</label>
            <select name="turno_id" id="turno_id" class="form-select" required>
                <option value="">Selecione o turno</option>
                <?php foreach ($turnos as $turno): ?>
                    <option value="<?= $turno['id'] ?>" <?= $turno['id'] == $funcionario['turno_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($turno['periodo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Dados</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
