<?php
declare(strict_types = 1);

require_once('../config/bancodedados.php');

function buscarTurnos() : array
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM turno");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarTurnoPorId(int $id) : ?array
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM turno WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $turno = $stmt->fetch(PDO::FETCH_ASSOC);
    return $turno ?: null;
}

function alterarTurno(int $id, string $periodo, string $horario_inicio, string $horario_fim) : bool
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE turno SET periodo = :periodo, horario_inicio = :horario_inicio, horario_fim = :horario_fim WHERE id = :id");

    return $stmt->execute([
        ':periodo' => $periodo,
        ':horario_inicio' => $horario_inicio,
        ':horario_fim' => $horario_fim,
        ':id' => $id
    ]);
}

function cadastrarTurno(string $periodo, string $horario_inicio, string $horario_fim) : bool
{
    global $pdo;

    //validar dados enviados
    if (empty($periodo) || empty($horario_inicio) || empty($horario_fim)) {
        return false;
    }

    //validação dos horarios enviados
    if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $horario_inicio) ||
        !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $horario_fim)) {
        return false;
    }

    try {

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO turno 
        (periodo, horario_inicio, horario_fim) 
        VALUES (:periodo, :horario_inicio, :horario_fim)");

        $stmt->execute([
            ':periodo' => $periodo,
            ':horario_inicio' => $horario_inicio,
            ':horario_fim' => $horario_fim
        ]);

        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
        return false;
    }
}

function removerTurno(int $id) : bool
{
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM turno WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}


function cadastrarTurnoPadrao() : int
{
    global $pdo;
    $periodo = 'Padrão';
    $horario_inicio = '08:00';
    $horario_fim = '18:00';

    $stmt = $pdo->prepare("SELECT id FROM turno WHERE periodo = :periodo AND horario_inicio = :horario_inicio AND horario_fim = :horario_fim");
    $stmt->execute([
        ':periodo' => $periodo,
        ':horario_inicio' => $horario_inicio,
        ':horario_fim' => $horario_fim,
    ]);
    $turno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($turno) {
        return (int) $turno['id'];
    }

    $stmt = $pdo->prepare("INSERT INTO turno (periodo, horario_inicio, horario_fim) VALUES (:periodo, :horario_inicio, :horario_fim)");
    $stmt->execute([
        ':periodo' => $periodo,
        ':horario_inicio' => $horario_inicio,
        ':horario_fim' => $horario_fim,
    ]);

    return (int) $pdo->lastInsertId();
}

