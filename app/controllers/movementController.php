<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use PDOException;

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['movementType'])) {

        $equipmentId = $_POST['idItem'];
        $itemModel = new ItemModel;
        $typeMovement = $_POST['movementType'];
        $dateMovement = $_POST['dateMovement'];

        switch ($typeMovement) {
            case 'location':
                $newLocation = $_POST['newLocation'];
                error_log('Entrou na location');

                if ($itemModel->addNewMovement($equipmentId, $newLocation, $dateMovement, $typeMovement)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Movimentação adicionada com sucesso!';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Erro ao adicionar nova movimentação';
                }

                break;

            case 'transfer':
                $fromCustomerID = $_POST['fromCustomerID'];
                $toCustomerID = $_POST['toCustomerID'];
                error_log('Entrou na transfer');


                if ($itemModel->addTransferMovement($equipmentId, $fromCustomerID, $toCustomerID, $dateMovement, $typeMovement)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Movimentação adicionada com sucesso!';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Erro ao adicionar nova movimentação';
                }

                break;

            case 'maintenance':
                $equipamentSituation = $_POST['equipamentSituation'];
                error_log('Entrou na maintenance');


                if ($itemModel->addMaintenanceMovement($equipmentId, $equipamentSituation, $dateMovement, $typeMovement)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Movimentação adicionada com sucesso!';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Erro ao adicionar nova movimentação';
                }

                break;

            case 'lost':
                $lossOrMisplacement = $_POST['lossOrMisplacement'];
                error_log('Entrou na lost');

                if ($itemModel->addLostMovement($equipmentId, $lossOrMisplacement, $dateMovement, $typeMovement)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Movimentação adicionada com sucesso!';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Erro ao adicionar nova movimentação';
                }

                break;
        }
    }
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Erro interno no servidor.';
}

header('Content-Type: application/json');
echo json_encode($response);
