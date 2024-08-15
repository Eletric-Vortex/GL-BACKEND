<?php

require("/opt/lampp/htdocs/GL-BACKEND/utils/database.php");



try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_conteudos_sobrenome') {
        // Ative o relatório de erros do PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a consulta SQL
        $stmt = $conn->prepare("SELECT CONTEUDO_TEXTO FROM TB_CONTEUDOS WHERE CONTEUDO_TIPO = 'Sobrenome'");

        // Executa a consulta
        $stmt->execute();

        // Obtém os resultados da consulta
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verifica se houve resultados
        if ($result === false) {
            throw new Exception("Nenhum resultado encontrado");
        }

        // Define o cabeçalho da resposta como JSON
        header('Content-Type: application/json');

        // Retorna os resultados em formato JSON
        echo json_encode($result);
        exit();
    }
} catch (\PDOException $e) {
    // Captura erros específicos do PDO
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
    exit();
} catch (\Exception $e) {
    // Captura outros erros
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Erro: ' . $e->getMessage()]);
    exit();
}
?>