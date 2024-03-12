<?php

namespace app\controllers;

// require_once '../../vendor/autoload.php';

use app\database\ItemModel;
use PDOException;

class equipmentsController extends Controller
{
    public function equipamentOptions()
    {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            switch ($action) {
                case 'customerMovement':
                    $this->customerMovement($_POST['id']);
                    break;
                default:
                    error_log('Test error case');
                    break;
            }
        }
    }

    public function customerMovement($id)
    {
        try {
            if (isset($id) && $id > 0) {
                $itemModel = new ItemModel;
                $itemId = $id;
                $itemDetails = $itemModel->getById($itemId);
                error_log(var_dump($itemDetails));

                header('Content-Type: application/json');
                echo json_encode($itemDetails);
                return;
            }
        } catch (PDOException $e) {
            error_log('Erro na consulta' . $e);
            http_response_code(500);
            echo json_encode(array('error' => 'Internal Server Error'));
        }
    }
}
