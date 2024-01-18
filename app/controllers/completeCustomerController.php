<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\CustomerModel;
use PDOException;

if (isset($_POST['id']) && $_POST['id'] > 0) {
    try {
        $customerModel = new CustomerModel;
        $customerId = $_POST['id'];
        $customerDetails = $customerModel->getCustomerById($customerId);
        error_log($_POST['id']);
        header('Content-Type: application/json');
        echo json_encode($customerDetails);

    } catch (PDOException $e) {
        error_log('Erro na consulta' . $e);
        http_response_code(500);
        echo json_encode(array('error' => 'Internal Server Error'));
    }
}
