<?php

require("/opt/lampp/htdocs/GL-BACKEND/utils/database.php");

// Função para executar a consulta e retornar os resultados
function fetchData($conn, $sql) {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result === false || empty($result)) {
        throw new Exception("Nenhum resultado encontrado");
    }
    return $result;
}

// TEMPLATE TEMPORARIO
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'get_licao2_info') {

    try {
        $result_name_empresa = fetchData($conn, "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG2 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Nome' AND CONTEUDO_TAG1 = 'Empresa'");
        $result_desc_empresa = fetchData($conn, "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG2 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Descricao' AND CONTEUDO_TAG1 = 'Empresa'");
        $result_logo = fetchData($conn, "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG1, CONTEUDO_TAG2 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Logo'");

        $response = [
            'name_empresa' => $result_name_empresa,
            'desc_empresa' => $result_desc_empresa,
            'logo' => $result_logo
        ];

        header('Content-Type: application/json');
        echo json_encode($response);

    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    }

    exit();
}