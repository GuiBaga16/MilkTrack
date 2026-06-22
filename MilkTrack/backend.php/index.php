<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Responde ao preflight do CORS sem body
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

// Documentação interativa (Swagger UI)
if ($uri === '/docs') {
    header('Content-Type: text/html; charset=utf-8');
    readfile(__DIR__ . '/docs/swagger.html');
    exit;
}

require_once __DIR__ . '/controllers/Leites.controller.php';

$controller = new LeitesController();

// Rotas com ID: /leite/42
if (preg_match('#^/leite/(\d+)$#', $uri, $match)) {
    $id = (int) $match[1];

    switch ($method) {
        case 'GET':
            echo json_encode($controller->buscarPorId($id), JSON_UNESCAPED_UNICODE);
            break;
        case 'PUT':
            $dados = json_decode(file_get_contents('php://input'), true);
            echo json_encode($controller->atualizar($id, $dados), JSON_UNESCAPED_UNICODE);
            break;
        case 'DELETE':
            echo json_encode($controller->deletar($id), JSON_UNESCAPED_UNICODE);
            break;
        default:
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// Rotas sem ID: /leite
if ($uri === '/leite') {
    switch ($method) {
        case 'GET':
            echo json_encode($controller->listar(), JSON_UNESCAPED_UNICODE);
            break;
        case 'POST':
            $dados = json_decode(file_get_contents('php://input'), true);
            echo json_encode($controller->salvar($dados), JSON_UNESCAPED_UNICODE);
            break;
        default:
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

http_response_code(404);
echo json_encode(['erro' => 'Rota não encontrada'], JSON_UNESCAPED_UNICODE);
