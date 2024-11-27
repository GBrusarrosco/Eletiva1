<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/funcionarios.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $id = intval($_POST['id']);
            if (excluirFuncionario($id)){
                header('Location: funcionarios.php');
                exit();
            } else {
                $erro = "Erro ao excluir o usuário!";
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    } else {
        if (isset($_GET['id'])){
            $id = intval($_GET['id']);
            $funcionario = retornaUsuarioPorId($id);
            if ($funcionario == null){
                header('Location: funcionarios.php');
                exit();
            }
        } else {
            header('Location: funcionarios.php');
            exit();
        }
    }
    
?>

<div class="container mt-5">
    <h2>Excluir Funcionário</h2>

    <p>Tem certeza de que deseja excluir o funcionário abaixo?</p>

    <ul>
        <li><strong>Nome: <?= htmlspecialchars($funcionario['nome']) ?></strong> </li>
        <li><strong>Email: <?= htmlspecialchars($funcionario['email']) ?></strong> </li>
        <li><strong>Nível: <?= $funcionario['nivel'] == 'adm' ? 'Administrador' : 'Usuário' ?></strong> </li>
        <li><strong>Cargo: <?= htmlspecialchars($funcionario['cargo']) ?></strong></li>
        <li><strong>Turno: <?= htmlspecialchars($funcionario['turno']) ?></strong></li>
    </ul>

    <form method="post">
        <input type="hidden" name="id" value="<?= $funcionario['id'] ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="funcionarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
