<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use PDOException;

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['movementId'])) {
        $itemModel = new ItemModel;
        $movementId = $_POST['movementId'];
        $itemRemove = $itemModel->removeMovementItem($movementId);

        if ($itemRemove) {
            $response['status'] = 'success';
            $response['message'] = 'Sucesso ao remover a movimentação';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Erro ao remover a movimentação';
        }
    }
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Erro interno no servidor.';
}

header('Content-Type: application/json');
echo json_encode($response);
