<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use PDOException;
use PDO;

$response = ['status' => 'error', 'message' => 'Erro ao processar a solicitação.'];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $itemName = $_POST['itemName'];
        $location = $_POST['location'];
        $clientName = $_POST['clientName'];
        $model = $_POST['model'];
        $serialNumber = $_POST['serialNumber'];
        $status = $_POST['status'];
        $lastMovement = $_POST['lastMovement'];
        $additionalNotes = $_POST['additionalNotes'];
        $connect = connect();

        if (!($connect)) {
            error_log('Erro: Falha na conexão com o banco de dados.');
            return;
        }

        $stmt = $connect->prepare(" INSERT INTO equipment (itemName, location, clientName, model, serialNumber, status, lastMovement, additionalNotes) 
                                            VALUES(:itemName, :location, :clientName, :model, :serialNumber, :status, :lastMovement, :additionalNotes)");
        $stmt->bindParam(':itemName', $itemName);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':clientName', $clientName);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':serialNumber', $serialNumber);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':lastMovement', $lastMovement);
        $stmt->bindParam(':additionalNotes', $additionalNotes);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Alterações salvas com sucesso!';
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
?>