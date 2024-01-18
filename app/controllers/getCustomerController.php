<?php

namespace app\controllers;

require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use PDOException;

try {
    $itemModel = new ItemModel;
    $itemData = $itemModel->getCustomerName();

    header('Content-Type: application/json');
    echo json_encode($itemData);
} catch (PDOException $e) {
    error_log('Erro na consulta' . $e);
    http_response_code(500);
    echo json_encode(array('error' => 'Internal Server Error'));
}
