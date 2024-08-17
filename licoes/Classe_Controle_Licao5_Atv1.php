<?php 

require("/opt/lampp/htdocs/GL-BACKEND/utils/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'get_licao5_info') {


    $stmt = $conn->prepare("SELECT CONTEUDO_TEXTO, CONTEUDO_TIPO, CONTEUDO_TAG2, CONTEUDO_TAG3 FROM TB_CONTEUDOS WHERE CONTEUDO_TAG1 = 'Licao5_Atv1'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result === false) {
        throw new Exception("Nenhum resultado encontrado");
    }

    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}