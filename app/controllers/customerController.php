<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\CustomerModel;
use PDOException;

$response = ['status' => 'error', 'message' => 'Erro ao processar a solicitação.'];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $connect = connect();
        if (!$connect) {
            error_log('Erro: Falha na conexão com o banco de dados.');
            exit();
        }

        $id = $_POST['id'];
        $customerName = $_POST['customerName'];
        $address = $_POST['address'];
        $action = $_POST['action'];
        $customerModel = new CustomerModel();

        if (isset($action)) {
            if ($action === 'create' && !isset($id)) {
                if ($customerModel->createCustomer($customerName, $address)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Cliente criado com sucesso!';
                }
            } elseif ($action === 'edit' && isset($id)) {
                if ($customerModel->editCustomer($id, $customerName, $address)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Cliente alterado com sucesso!';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Erro ao realizar ação';
                error_log(print_r($_POST, true)); 

            }
        }
    }
} catch (PDOException $e) {
    error_log('Erro durante a execução: ' . $e->getMessage());
    $response['status'] = 'error';
    $response['message'] = 'Erro interno no servidor.';
}

header('Content-Type: application/json');
echo json_encode($response);
