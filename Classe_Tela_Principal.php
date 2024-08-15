<?php

require("utils/database.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'get_nivel_atividade') {
    $codEstudante = $_GET['cod_estudante'];
    $codAtividade = $_GET['cod_atividade'];

    $stmt = $conn->prepare("SELECT NIVEL_ATIVIDADE FROM TB_NIVEL_ATIVIDADE WHERE COD_ESTUDANTE = :cod_estudante AND COD_ATIVIDADE = :cod_atividade");
    $stmt->bindParam(':cod_estudante', $codEstudante);
    $stmt->bindParam(':cod_atividade', $codAtividade);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //TODO: Melhorar este workaround para quando a atividade não tiver pontuação ainda
    if ($result == 0 or $result == null or $result == '') {
        echo json_encode(['status'=> 'empty','message'=> 'not exist']);
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
