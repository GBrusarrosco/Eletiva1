<?php

    declare(strict_types=1);

    require_once '../config/bancodedados.php';

    function gerarDadosGraficoCargos(): array {
        global $pdo;
        $stmt = $pdo->query("
        SELECT 
            c.nome AS cargo, 
            COUNT(f.id) AS quantidade_funcionarios
        FROM 
            cargo c
        LEFT JOIN 
            funcionario f ON c.id = f.cargo_id
        GROUP BY 
            c.id, c.nome
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function buscarCargos(): array {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM cargo");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarCargoPorId(int $id): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM cargo WHERE id = ?");
        $stmt->execute([$id]);
        $cargo = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cargo ? $cargo : null;
    }

    function cadastrarCargo(string $nome): bool {
        global $pdo;

        if (empty($nome)) {
            return false;
        }
        try {

            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO cargo (nome) VALUES (:nome)");
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    function alterarCargo(int $id, string $nome): bool {
        global $pdo;

        if (empty($nome)) {
            return false;
        }
        try {

            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE cargo SET nome = :nome WHERE id = :id");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    function excluirCargo(int $id) : bool {
        global $pdo;

        try {

            $pdo->beginTransaction();
            $stmt = $pdo->prepare("DELETE FROM cargo WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

function criarCargoPadrao(): int {
    global $pdo;

    $nome = 'Administrador';

    try {

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("SELECT id FROM cargo WHERE nome = :nome");
        $stmt->execute([':nome' => $nome]);
        $cargo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cargo) {
            return (int) $cargo['id'];
        }

        $stmt = $pdo->prepare("INSERT INTO cargo (nome) VALUES (:nome)");
        $stmt->execute([':nome' => $nome]);

        $pdo->commit();
        return (int) $pdo->lastInsertId();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo 'Erro: ' . $e->getMessage();
        return 0;
    }
}



