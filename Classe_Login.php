<?php
require 'utils/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_user_estudante') {
    $codigo = $_GET['codigo'];
    $senha = md5($_GET['senha']);

    $stmt = $conn->prepare("SELECT * FROM TB_USER_ESTUDANTE WHERE USER_ESTUDANTE_LOGIN = :codigo AND USER_ESTUDANTE_SENHA = :senha");
    $stmt->bindParam(':codigo', $codigo);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_user_professor') {
    $codigo = $_GET['codigo'];
    $senha = $_GET['senha'];

    $stmt = $conn->prepare("SELECT * FROM TB_USER_PROFESSOR WHERE USER_PROFESSOR_LOGIN = :codigo AND USER_PROFESSOR_SENHA = :senha");
    $stmt->bindParam(':codigo', $codigo);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_user_monitor') {
    $codigo = $_GET['codigo'];
    $senha = md5($_GET['senha']);

    $stmt = $conn->prepare("SELECT * FROM TB_USER_MONITOR WHERE USER_MONITOR_LOGIN = :codigo AND USER_MONITOR_SENHA = :senha");
    $stmt->bindParam(':codigo', $codigo);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_user_adm') {
    $codigo = $_GET['codigo'];
    $senha = md5($_GET['senha']);

    $stmt = $conn->prepare("SELECT * FROM TB_USER_ADM WHERE USER_ADM_LOGIN = :codigo AND USER_ADM_SENHA = :senha");
    $stmt->bindParam(':codigo', $codigo);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

