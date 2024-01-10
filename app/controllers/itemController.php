<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use PDOException;
use PDO;

$response = ['status' => 'error', 'message' => 'Erro ao processar a solicitação.'];
$action = $_POST['action'];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $itemName = $_POST['itemName'];
        $location = $_POST['location'];
        $customerID = $_POST['customerID'];
        $model = $_POST['model'];
        $serialNumber = $_POST['serialNumber'];
        $status = $_POST['status'];
        // Convert date to SQL FORMAT
        $lastMovement = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['lastMovement'])));
        $additionalNotes = $_POST['additionalNotes'];
        $connect = connect();
        $itemModel = new ItemModel;

        if (!($connect)) {
            error_log('Erro: Falha na conexão com o banco de dados.');
            exit();
        }

        if (isset($action) && $action == 'create') {
            if ($itemModel->createItem($itemName, $location, $customerID, $model, $serialNumber, $status, $lastMovement, $additionalNotes)) {
                $response['status'] = 'success';
                $response['message'] = 'Item criado com sucesso!';
            }
        } else if (isset($action) && $action == 'edit') {
            $id = $_POST['id'];
            if ($itemModel->editItem($itemName, $location, $customerID,  $model, $serialNumber, $status, $lastMovement, $additionalNotes, $id)) {
                $response['status'] = 'success';
                $response['message'] = 'Alterações salvas com sucesso!';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Erro ao salvar as alterações';
        }
    }
} catch (PDOException $e) {
    error_log('Error:' . $e->getMessage());
    $response['message'] = 'Erro interno no servidor.';
}

header('Content-Type: application/json');
echo json_encode($response);
