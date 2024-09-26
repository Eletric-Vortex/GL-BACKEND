<?php

// connection.Sql = "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG1 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Lugar' AND CONTEUDO_TAG1 = 'Lição 7 Atividade 1';";

// connection.Sql = "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG1 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Direção' AND CONTEUDO_TAG1 = 'Lição 7 Atividade 1';";


//A LICAO 7 NÃO TEM CONTEUDO DE LUGAR NEM DIREÇÃO NO BANCO

require "/opt/lampp/htdocs/GL-BACKEND/utils/database.php";
require_once "/opt/lampp/htdocs/GL-BACKEND/utils/global.php";



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'get_licao7_info') {

    try {
        $result_lugar = fetchData($conn, "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG1 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Lugar' AND CONTEUDO_TAG1 = 'Lição 7 Atividade 1'");
        $result_direcao = fetchData($conn, "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG1 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Direção' AND CONTEUDO_TAG1 = 'Lição 7 Atividade 1'");

        $response = [
            'lugar' => $result_lugar,
            'direcao' => $result_direcao
        ];

        header('Content-Type: application/json');
        echo json_encode($response);

    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    }

    exit();
}