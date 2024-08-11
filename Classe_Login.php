<?php
require 'utils/database.php';

header('Content-Type: application/json');

// Recebe os parâmetros via POST
$login = $_POST['login'];
$senha = md5($_POST['senha']);

// Função para executar a consulta e retornar os resultados
function queryDatabase($conn, $table, $loginColumn, $login, $senha) {
    $sql = "SELECT * FROM $table WHERE $loginColumn='$login' AND USER_SENHA='$senha'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Executa as consultas para cada tabela
$tables = array(
    'TB_USER_ESTUDANTE' => 'USER_ESTUDANTE_LOGIN',
    'TB_USER_PROFESSOR' => 'USER_PROFESSOR_LOGIN',
    'TB_USER_MONITOR' => 'USER_MONITOR_LOGIN',
    'TB_USER_ADM' => 'USER_ADM_LOGIN'
);

$results = array();
foreach ($tables as $table => $loginColumn) {
    $results[$table] = queryDatabase($conn, $table, $loginColumn, $login, $senha);
}

// Retorna os resultados em formato JSON
echo json_encode($results);
