<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use app\classes\MovementHistory;
use PDOException;

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['itemId'])) {
        $itemModel = new ItemModel;
        $itemId = $_POST['itemId'];
        $movementHistory = $itemModel->getMovementHistory($itemId);

        if ($movementHistory) {
            $reponse['status'] = 'success';
            $response['message'] = '';
            $response['data'] = $movementHistory;
        } else {
            $reponse['status'] = 'error';
            $response['message'] = 'Nenhuma Movimentação Registrada 🙁';
        }
    }
} catch (PDOException $e) {
    $reponse['status'] = 'error';
    $response['message'] = 'Erro interno no servidor.';
}

header('Content-Type: application/json');
echo json_encode($response);
