<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/funcionarios.php';


    if ($_SESSION['nivel'] !== 'adm') {
        header('Location: dashboard.php');
        exit();
    }


    $funcionarios = buscarFuncionarios();
?>
?>

<div class="container mt-5">
    <h2>Gerenciamento de Funcionários</h2>
    <a href="novo_funcionario.php" class="btn btn-success mb-3">Novo Funcionário</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Nível</th>
                <th>Cargo</th>
                <th>Turno</th>
            </tr>
        </thead>
        <tbody>
            
            <?php

                $funcionarios = buscarFuncionarios();
                foreach ($funcionarios as $f):
            ?>

            <tr>
                <td><?= $f['id'] ?></td>
                <td><?= htmlspecialchars($f['nome']) ?></td>
                <td><?= htmlspecialchars($f['email']) ?></td>
                <td><?= $f['telefone'] ?? 'Não informado' ?></td>
                <td><?= $f['nivel'] === 'adm' ? 'Administrador' : 'Usuário'; ?></td>
                <td><?= htmlspecialchars($f['cargo']) ?></td>
                <td><?= htmlspecialchars($f['turno']) ?></td>
                <td>
                    <a href="editar_funcionario.php?id=<?= $f['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_funcionario.php?id=<?= $f['id'] ?>" class="btn btn-danger"
                       onclick="return confirm('Tem certeza de que deseja excluir este funcionário?');">Excluir</a>
                </td>
            </tr>

            <?php    
                endforeach;
            ?>
            
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
