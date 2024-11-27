<?php

declare(strict_types=1);

require_once "../config/bancodedados.php";
require_once "../funcoes/turno_trabalho.php";
require_once "../funcoes/cargos.php";
function buscarFuncionarios() : array
{
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT f.*, c.nome AS cargo, t.periodo AS turno 
        FROM funcionario f
        JOIN cargo c ON f.cargo_id = c.id
        JOIN turno t ON f.turno_id = t.id
        ORDER BY f.nome
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function alterarFuncionario(int $id, string $nome, string $email, int $cargo_id, int $turno_id, ?string $telefone = null) : bool {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM funcionario WHERE id = :id");
    $stmt->execute([':id' => $id]);
    if ($stmt->fetchColumn() == 0) {
        return false;
    }
    $stmt = $pdo->prepare("UPDATE funcionario 
    SET nome = :nome, email = :email, telefone = :telefone, cargo_id = :cargo_id, turno_id = :turno_id
    WHERE id = :id");

    return $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':telefone' => $telefone,
        ':cargo_id' => $cargo_id,
        ':turno_id' => $turno_id,
        ':id' => $id
    ]);
}



function cadastrarFuncionario(string $nome, string $email, string $senha, string $nivel, int $cargo_id, int $turno_id,  ?string $telefone = null): bool {
    global $pdo;

    if (empty($nome) || empty($email) || empty($senha) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    try {

        $pdo->beginTransaction();

        //validar cargo_id
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM cargo WHERE id = :id");
        $stmt->execute([':id' => $cargo_id]);
        if ($stmt->fetchColumn() == 0) {
            return false;
        }

        //validar turno_id
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM turno WHERE id = :id");
        $stmt->execute([':id' => $turno_id]);
        if ($stmt->fetchColumn() == 0) {
            return false;
        }

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO funcionario 
        (nome, email, telefone, cargo_id, turno_id, senha, nivel) 
        VALUES (:nome, :email, :telefone, :cargo_id, :turno_id, :senha, :nivel)");

        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':cargo_id' => $cargo_id,
            ':turno_id' => $turno_id,
            ':senha' => $senhaHash,
            ':nivel' => $nivel
        ]);

        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
        return false;
    }
}

function excluirFuncionario(int $id): bool {
    global $pdo;
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("DELETE FROM funcionario WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
        return false;
    }
}

function login(string $email, string $senha){
    global $pdo;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return null;
    }

    cadastrarFuncionarioPadraoAdm();

    $stament = $pdo->prepare("SELECT * FROM funcionario WHERE email = ?");
    $stament->execute([$email]);
    $funcionario = $stament->fetch(PDO::FETCH_ASSOC);

    if($funcionario && password_verify($senha, $funcionario['senha'])) {
        return $funcionario;
    }
    return null;
}

function cadastrarFuncionarioPadraoAdm() {
    global $pdo;

    $email = 'adm@adm.com';

    $stmt = $pdo->prepare("SELECT id FROM funcionario WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        return;
    }

    $nome = 'Administrador';
    $senha = 'adm';
    $nivel = 'adm';
    $telefone = null;

    $cargo_id = criarCargoPadrao();
    $turno_id = cadastrarTurnoPadrao();


    cadastrarFuncionario($nome, $email, $senha, $nivel, $cargo_id, $turno_id, $telefone);
}

function registrarPonto(int $funcionario_id, string $tipo): bool {
    global $pdo;

    if (!in_array($tipo, ['entrada', 'saida'])) {
        return false;
    }

    try {
        $hoje = date('Y-m-d');

        $stmt = $pdo->prepare("
            SELECT tipo
            FROM batida_ponto
            WHERE funcionario_id = :funcionario_id AND data = :data AND tipo = :tipo
        ");
        $stmt->execute([
            ':funcionario_id' => $funcionario_id,
            ':data' => $hoje,
            ':tipo' => $tipo
        ]);

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            return false;
        }

        $stmt = $pdo->prepare("
            INSERT INTO batida_ponto (funcionario_id, data, horario, tipo)
            VALUES (:funcionario_id, :data, NOW(), :tipo)
        ");
        $stmt->execute([
            ':funcionario_id' => $funcionario_id,
            ':data' => $hoje,
            ':tipo' => $tipo
        ]);

        return true;
    } catch (PDOException $e) {
        echo "Erro ao registrar ponto: " . $e->getMessage();
        return false;
    }
}

function retornaUsuarioPorId(int $id) : ?array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT f.*, c.nome AS cargo, t.periodo AS turno 
                           FROM funcionario f
                           JOIN cargo c ON f.cargo_id = c.id
                           JOIN turno t ON f.turno_id = t.id
                           WHERE f.id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}