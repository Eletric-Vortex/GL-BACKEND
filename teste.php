<?php

require "utils/database.php";

if (
    ($_SERVER['REQUEST_METHOD'] === 'POST') &&
    isset($_REQUEST['endpoint']) && $_REQUEST['endpoint'] === 'teste'
) {
    // Verifica se os parâmetros necessários estão presentes
    $missingParams = [];
    if (!isset($_POST['CPF'])) {
        $missingParams[] = 'CPF';
    }
    if (!isset($_POST['cod_activity'])) {
        $missingParams[] = 'cod_activity';
    }

    if (!empty($missingParams)) {
        $missingParamsStr = implode(', ', $missingParams);
        error_log("Missing required parameters: $missingParamsStr");
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => "Missing required parameters: $missingParamsStr"]);
        exit();
    }

    $CPF = $_POST['CPF'];
    $cod_activity = $_POST['cod_activity'];

    try {
        // Verifica se a conexão com o banco de dados está OK
        if (!$conn) {
            throw new PDOException("Failed to connect to the database");
        }

        // Log para debug
        error_log("Updating record for CPF: $CPF and cod_activity: $cod_activity");

        $stmt = $conn->prepare("UPDATE TB_NIVEL_ATIVIDADE SET NIVEL_ATIVIDADE = IFNULL(NIVEL_ATIVIDADE, 0) + 1 WHERE COD_ESTUDANTE = :CPF AND COD_ATIVIDADE = :cod_activity;");

        $stmt->bindParam(':CPF', $CPF);
        $stmt->bindParam(':cod_activity', $cod_activity);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            $result = ['status' => 'success', 'message' => 'Atualização realizada com sucesso'];
        } else {
            $result = ['status' => 'error', 'message' => 'Nenhum registro atualizado'];
        }
    } catch (PDOException $e) {
        $result = ['status' => 'error', 'message' => 'Erro ao executar a atualização: ' . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($result);

    exit();
} else {
    // Log para debug
    $errorMessage = "Invalid request method or missing endpoint parameter";
    if (!isset($_REQUEST['endpoint'])) {
        $errorMessage = "Missing endpoint parameter";
    } elseif ($_REQUEST['endpoint'] !== 'teste') {
        $errorMessage = "Invalid endpoint value";
    }

    error_log($errorMessage);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $errorMessage]);
    exit();
}