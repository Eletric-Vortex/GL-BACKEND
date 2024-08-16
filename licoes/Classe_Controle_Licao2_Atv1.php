<?php 

require("/opt/lampp/htdocs/GL-BACKEND/utils/database.php");


// ALERT: As querys são muito semelhantes
// TODO: faça o endpoint responder o nome, descrição e logo em apenas uma request/query

// conexao.Sql = "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG2 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Nome' AND CONTEUDO_TAG1 = 'Empresa';";
// conexao.Sql = "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG2 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Descricao' AND CONTEUDO_TAG1 = 'Empresa';";
// conexao.Sql = "SELECT CONTEUDO_TEXTO, CONTEUDO_TAG1, CONTEUDO_TAG2 FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Logo'; ";





// TEMPLATE TEMPORARIO
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'get_content_nationality') {


    $stmt = $conn->prepare("SELECT CONTEUDO_TEXTO FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Nacionalidade'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result === false) {
        throw new Exception("Nenhum resultado encontrado");
    }

    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

