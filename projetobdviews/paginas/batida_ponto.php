<?php
require_once '../funcoes/funcionarios.php';
session_start();

if (!isset($_SESSION['acesso']) || $_SESSION['nivel'] !== 'user') {
    header('Location: login.php');
    exit;
}

$funcionario_id = $_SESSION['id'];
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    if (registrarPonto($funcionario_id, $tipo)) {
        $mensagem = "Ponto registrado com sucesso!";
        header('Location: pontos.php');
    } else {
        $mensagem = "Erro ao registrar ponto. Verifique se já bateu o ponto do mesmo tipo hoje.";
    }
}

require_once 'cabecalho.php';
?>

    <div class="container mt-5">
        <h2>Bater Ponto</h2>
        <form method="post">
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Ponto</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <?php if ($mensagem): ?>
            <p class="mt-3 text-success"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>
    </div>

<?php require_once 'rodape.php'; ?>