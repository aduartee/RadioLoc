<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use app\Helpers\DataHelper;
use PDOException;

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['movementType'])) {

        $itemModel = new ItemModel;
        $dataHelper = new DataHelper;
        $equipmentId = $_POST['idItem'];
        $typeMovement = $_POST['movementType'];
        $dateMovement = $dataHelper::formatToSql($_POST['dateMovement']);        

        switch ($typeMovement) {
            case 'location':
                $newLocation = $_POST['newLocation'];

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
