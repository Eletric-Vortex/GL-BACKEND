<?php

require "/opt/lampp/htdocs/GL-BACKEND/utils/database.php";



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'select_nivel_activity') {
    $cpf = $_GET['cpf'];
    $cod_activity = $_GET['cod_activity'];

    $stmt = $conn->prepare("SELECT NIVEL_ATIVIDADE FROM TB_NIVEL_ATIVIDADE WHERE COD_ESTUDANTE = :cpf AND COD_ATIVIDADE = :cod_activity");
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':cod_activity', $cod_activity);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //TODO: Melhorar este workaround para quando a atividade não tiver pontuação ainda
    if ($result == 0 or $result == null or $result == '') {
        echo json_encode(['status' => 'empty', 'message' => 'not exist']);
    }


    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}





//TODO:Entender melhor como adiciona esse nivel
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['endpoint']) && $_POST['endpoint'] === 'increment_level') {
    $CPF = $_POST['CPF'];
    $cod_activity = $_POST['cod_activity'];

    try {
        $stmt = $conn->prepare("UPDATE TB_NIVEL_ATIVIDADE
SET NIVEL_ATIVIDADE = IFNULL(NIVEL_ATIVIDADE, 0) + 1
WHERE COD_ESTUDANTE = :CPF AND COD_ATIVIDADE = :cod_activity;");

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
}
