<?php

namespace app\controllers;

require_once(__DIR__ . '/../database/connect.php');
require_once(__DIR__ . '/../classes/Item.php');
require_once(__DIR__ . '/../database/ItemModel.php');


use app\database\ItemModel;
use PDOException;

if (isset($_POST['id']) && $_POST['id'] > 0) {
    try {
        $itemModel = new ItemModel;
        $itemId = $_POST['id'];
        $itemDetails = $itemModel->getById($itemId);

        error_log('Item details retrieved: ' . print_r($itemDetails, true));

        header('Content-Type: application/json');
        echo json_encode($itemDetails);
    } catch (PDOException $e) {
        error_log('Erro na consulta' . $e);
        http_response_code(500);
        echo json_encode(array('error' => 'Internal Server Error'));
    }
}
