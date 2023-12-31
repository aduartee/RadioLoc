<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use PDOException;

$response = ['status' => 'error', 'message' => 'Erro ao processar a solicitação.'];
$id = $_POST['id'];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($id)) {
        $itemModel = new ItemModel;

        if ($itemModel->removeItem($id)) {
            $response['status'] = 'success';
            $response['message'] = 'Item removido com sucesso!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Erro ao remover item.';
        }
    }
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Erro interno no servidor.';
}

header('Content-Type: application/json');
echo json_encode($response);
