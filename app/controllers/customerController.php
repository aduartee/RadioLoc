<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\CustomerModel;
use PDOException;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $response = ['status' => 'error', 'message' => 'Erro ao processar a solicitação.'];
        $connect = connect();
        if (!$connect) {
            $response['message'] = 'Erro: Falha na conexão com o banco de dados.';
            exit();
        }

        $customerModel = new CustomerModel();
        $id = $_POST['id'];
        $customerName = $_POST['customerName'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];
        $action = $_POST['action'];

        if (isset($action)) {
            if ($action === 'create' && empty($id)) {
                if ($customerModel->createCustomer($customerName, $address, $phone, $status)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Cliente criado com sucesso!';
                }
            } elseif ($action === 'edit' && $id > 0 && $id != null) {
                if ($customerModel->editCustomer($id, $customerName, $address, $phone, $status)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Cliente alterado com sucesso!';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Erro ao realizar a ação';
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
