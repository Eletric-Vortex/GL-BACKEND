<?php 

//ESTA LICAO ESTA INCOMPLETA TAMBEM

require("/opt/lampp/htdocs/GL-BACKEND/utils/database.php");
require_once "/opt/lampp/htdocs/GL-BACKEND/utils/global.php";




if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'get_licao8_info') {

    try {
        $name = fetchData($conn, "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG1 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Nome' AND (CONTEUDO_TAG1 = 'Masculino' OR CONTEUDO_TAG1 = 'Feminino')");
        $last_name = fetchData($conn, "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG1 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Sobrenome'");
        $rooms = fetchData($conn, "SELECT CONTEUDO_TEXTO FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Rooms'");
        $job_desc = fetchData($conn, "SELECT CONTEUDO_TEXTO FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Job_Description'");

        $response = [
            'name' => $name,
            'last_name' => $last_name,
            'rooms' => $rooms,
            'job_desc' => $job_desc
        ];

        header('Content-Type: application/json');
        echo json_encode($response);

    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    }

    exit();
}