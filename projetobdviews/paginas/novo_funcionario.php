<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/funcionarios.php';
    require_once '../funcoes/cargos.php';
    require_once '../funcoes/turno_trabalho.php';

    $erro = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $nivel = $_POST['nivel'];
            $cargo_id = $_POST['cargo_id'];
            $turno_id = $_POST['turno_id'];

            if (empty($nome) || empty($email) || empty($senha) || empty($cargo_id) || empty($turno_id) || empty($nivel)) {
                $erro = "Todos os campos são obrigatórios!";
            } else {
                if (cadastrarFuncionario($nome, $email, $senha, $nivel, $cargo_id, $turno_id)){
                    header('Location: funcionarios.php');
                    exit();
                } else {
                    $erro = "Erro ao criar o usuário!";
                }
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }

?>

<div class="container mt-5">
    <h2>Criar Novo Funcionário</h2>

    <?php if (!empty($erro)): ?>

        <p class="text-danger"><?= $erro ?></p>

    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nivel" class="form-label">Nível</label>
            <select name="nivel" id="nivel" class="form-select" required>
                <option value="">Selecione o nível</option>
                <option value="adm">Administrador</option>
                <option value="user">Usuário</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cargo_id" class="form-label">Cargo</label>
            <select name="cargo_id" id="cargo_id" class="form-select" required>
                <option value="">Selecione o cargo</option>
                <?php
                $cargos = buscarCargos(); // Função para buscar cargos
                foreach ($cargos as $cargo):
                    ?>
                    <option value="<?= $cargo['id'] ?>"><?= $cargo['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="turno_id" class="form-label">Turno</label>
            <select name="turno_id" id="turno_id" class="form-select" required>
                <option value="">Selecione o turno</option>
                <?php
                $turnos = buscarTurnos();
                foreach ($turnos as $turno):
                    ?>
                    <option value="<?= $turno['id'] ?>"><?= $turno['periodo'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Criar Funcionário</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
