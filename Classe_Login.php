<?php
require 'utils/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'student_login') {
    $login = $_GET['login'];
    $password = md5($_GET['password']);

    $stmt = $conn->prepare("SELECT * FROM TB_USER_ESTUDANTE WHERE USER_ESTUDANTE_LOGIN = :login AND USER_ESTUDANTE_password = :password");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'teacher_login') {
    $login = $_GET['login'];
    $password = $_GET['password'];

    $stmt = $conn->prepare("SELECT * FROM TB_USER_PROFESSOR WHERE USER_PROFESSOR_LOGIN = :login AND USER_PROFESSOR_password = :password");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'monitor_login') {
    $login = $_GET['login'];
    $password = md5($_GET['password']);

    $stmt = $conn->prepare("SELECT * FROM TB_USER_MONITOR WHERE USER_MONITOR_LOGIN = :login AND USER_MONITOR_password = :password");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'adm_login') {
    $login = $_GET['login'];
    $password = md5($_GET['password']);

    $stmt = $conn->prepare("SELECT * FROM TB_USER_ADM WHERE USER_ADM_LOGIN = :login AND USER_ADM_password = :password");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

