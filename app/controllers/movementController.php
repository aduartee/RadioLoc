<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use PDOException;

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $equipmentId = $_POST['idItem'];
        $dateMovement = $_POST['dateMovement'];
        $newLocation = $_POST['newLocation'];
        $itemModel = new ItemModel;

        if ($itemModel->addNewMovement($equipmentId, $newLocation, $dateMovement)) {
            $response['status'] = 'success';
            $response['message'] = 'Movimentação adicionada com sucesso!';
        } else {
            $reponse['status'] = 'error';
            $response['message'] = 'Erro ao adicionar nova movimentação';
        }
    }
} catch (PDOException $e) {
    $reponse['status'] = 'error';
    $response['message'] = 'Erro interno no servidor.';
}

header('Content-Type: application/json');
echo json_encode($response);
