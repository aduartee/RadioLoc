<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\CustomerModel;
use PDOException;

$response = ['status' => 'error', 'message' => 'Erro ao processar a solicitação.'];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerModel = new CustomerModel;
        $id = $_POST['id'];
        if ($customerModel->removeCustomer($id)) {
            $response['status'] = 'success';
            $response['message'] = 'Cliente removido com sucesso!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Erro ao remover cliente.';
        }
    }
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Erro interno no servidor.';
}

header('Content-Type: application/json');
echo json_encode($response);
