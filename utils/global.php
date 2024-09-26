
<?php 


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