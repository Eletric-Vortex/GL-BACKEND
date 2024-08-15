    <?php

    require("utils/database.php");

    // Endpoint para selecionar uma sala pelo código
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'get_sala') {
        $codigo = $_GET['codigo'];

        $stmt = $conn->prepare("SELECT * FROM TB_SALA WHERE SALA_CODIGO = :codigo");
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    // Endpoint para validar informações do usuário (email e CPF)
    //TODO: Deveria retornar se existe ou não, alterar este comportamento posteriormente.
    //TODO: Fazer retornar se o email, cpf ou login existe para o cliente.
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'validate_info') {
        $email = $_GET['email'];
        $cpf = $_GET['cpf'];

        $stmt = $conn->prepare("SELECT USER_ESTUDANTE_CPF FROM TB_USER_ESTUDANTE WHERE USER_ESTUDANTE_EMAIL = :email OR USER_ESTUDANTE_CPF = :cpf");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    // Endpoint para validar o login do player
    // TODO: Fazer os dois enpoints (O de cima e esse) virar apenas um, pois os dois verificam informações do mesmo contexto e isso economiza codigo e processamento das partes.
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'validate_player') {
        $login = $_GET['login'];

        $stmt = $conn->prepare("SELECT USER_ESTUDANTE_CPF FROM TB_USER_ESTUDANTE WHERE USER_ESTUDANTE_LOGIN = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    // Endpoint para inserir um novo player
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['endpoint']) && $_POST['endpoint'] === 'insert_player') {
        $player = json_decode(file_get_contents('php://input'), true);

        $stmt = $conn->prepare("INSERT INTO TB_USER_ESTUDANTE (USER_ESTUDANTE_CPF, USER_ESTUDANTE_NOME, USER_ESTUDANTE_LOGIN, USER_ESTUDANTE_SENHA, USER_ESTUDANTE_EMAIL, USER_ESTUDANTE_NIVEL, USER_ESTUDANTE_PTOTAIS, USER_ESTUDANTE_PSEMESTRE, USER_ESTUDANTE_PATUAIS, USER_ESTUDANTE_PELE, USER_ESTUDANTE_ROUPA, USER_ESTUDANTE_CABELO, USER_ESTUDANTE_ACESSORIO) VALUES (:cpf, :nome, :login, MD5(:senha), :email, :nivel, :ptotais, :psemestre, :patuais, :pele, :roupa, :cabelo, :acessorio)");
        $stmt->bindParam(':cpf', $player['cpf']);
        $stmt->bindParam(':nome', $player['nome']);
        $stmt->bindParam(':login', $player['login']);
        $stmt->bindParam(':senha', $player['senha']);
        $stmt->bindParam(':email', $player['email']);
        $stmt->bindParam(':nivel', $player['nivel']);
        $stmt->bindParam(':ptotais', $player['ptotais']);
        $stmt->bindParam(':psemestre', $player['psemestre']);
        $stmt->bindParam(':patuais', $player['patuais']);
        $stmt->bindParam(':pele', $player['pele']);
        $stmt->bindParam(':roupa', $player['roupa']);
        $stmt->bindParam(':cabelo', $player['cabelo']);
        $stmt->bindParam(':acessorio', $player['acessorio']);
        $stmt->execute();

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
        exit();
    }

    // Endpoint para selecionar todas as atividades
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['endpoint']) && $_GET['endpoint'] === 'get_atividades') {
        $stmt = $conn->prepare("SELECT ATIVIDADE_ID FROM TB_ATIVIDADES");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    // Endpoint para inserir nível de atividade
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['endpoint']) && $_POST['endpoint'] === 'insert_nivel_atividade') {
        $data = json_decode(file_get_contents('php://input'), true);

        $cpf = $data['cpf'];
        $cod_atividades = $data['cod_atividades'];

        foreach ($cod_atividades as $cod_atividade) {
            $stmt = $conn->prepare("INSERT INTO TB_NIVEL_ATIVIDADE (COD_ESTUDANTE, COD_ATIVIDADE, NIVEL_ATIVIDADE) VALUES (:cpf, :cod_atividade, 1)");
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':cod_atividade', $cod_atividade);
            $stmt->execute();
        }

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
        exit();
    }
