<?php

require("utils/database.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_nivel_atividade') {
    $codEstudante = $_GET['cod_estudante'];
    $codAtividade = $_GET['cod_atividade'];

    $stmt = $conn->prepare("SELECT NIVEL_ATIVIDADE FROM TB_NIVEL_ATIVIDADE WHERE COD_ESTUDANTE = :cod_estudante AND COD_ATIVIDADE = :cod_atividade");
    $stmt->bindParam(':cod_estudante', $codEstudante);
    $stmt->bindParam(':cod_atividade', $codAtividade);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
