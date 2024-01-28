<?php

namespace app\database;

use app\classes\Item;
use app\classes\MovementHistory;
use PDOException;
use PDO;

class ItemModel
{
    public function getAllItems()
    {
        try {
            $connect = connect();
            $query = " SELECT equipment.*, 
                                customer.customerName
                                FROM equipment
                                LEFT JOIN customer
                                ON equipment.customerID = customer.id 
                                WHERE equipment.status = 1 
                                ORDER BY equipment.id DESC";
            $stmt = $connect->query($query);

            $itemsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $items = [];

            foreach ($itemsData as $data) {
                $item = new Item();
                $item->setId($data['id']);
                $item->setItemName($data['itemName']);
                $item->setLocation($data['location']);
                $item->setCustomerName($data['customerName']);
                $item->setCustomerID($data['customerID']);
                $item->setLastMovement($data['lastMovement']);
                $item->setModel($data['model']);
                $item->setSerialNumber($data['serialNumber']);
                $item->setStatus($data['status']);
                $item->setAdditionalNotes($data['additionalNotes']);
                $items[] = $item;
            }

            return $items;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function getById($id)
    {
        try {
            if (isset($id) && $id != 0) {
                $connect = connect();
                $item = new Item;
                $query = " SELECT equipment.*, customer.customerName 
                           FROM equipment
                           LEFT JOIN customer
                           ON equipment.customerID = customer.id 
                           WHERE equipment.id = :id";
                $stmt = $connect->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $itemData = $stmt->fetch(PDO::FETCH_ASSOC);

                $item->setItemName($itemData['itemName']);
                $item->setLocation($itemData['location']);
                $item->setCustomerName($itemData['customerName']);
                $item->setCustomerID($itemData['customerID']);
                $item->setModel($itemData['model']);
                $item->setSerialNumber($itemData['serialNumber']);
                $item->setStatus($itemData['status']);
                $item->setAdditionalNotes($itemData['additionalNotes']);
                $item->setLastMovement($itemData['lastMovement']);

                $itemArray = array(
                    'itemName' => $item->getItemName(),
                    'location' => $item->getLocation(),
                    'customerName' => $item->getCustomerName(),
                    'customerID' => $item->getCustomerID(),
                    'model' => $item->getModel(),
                    'serialNumber' => $item->getSerialNumber(),
                    'status' => $item->getStatus(),
                    'additionalNotes' => $item->getAdditionalNotes(),
                    'lastMovement' => $item->getLastMovement()
                );

                $customerData = $this->getCustomerName();
                $itemArray['customers'] = $customerData;

                return $itemArray;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
        }
    }

    public function getItemByCustomer($id)
    {
        try {
            if (isset($id) && $id > 0) {
                $connect = connect();
                $stmt = $connect->prepare(" SELECT
                                            *
                                           FROM
                                            equipment AS e
                                           WHERE
                                            e.customerID = $id
                                            AND e.status = 1
                                            AND status = 1
                                           GROUP BY
                                            e.id
                                           ORDER BY
                                            MAX(e.lastMovement);");
                $stmt->execute();
                $itemData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $items = [];

                foreach ($itemData as $data) {
                    $item = new Item;
                    $item->setId($data['id']);
                    $item->setItemName($data['itemName']);
                    $item->setLocation($data['location']);
                    $item->setCustomerID($data['customerID']);
                    $item->setModel($data['model']);
                    $item->setSerialNumber($data['serialNumber']);
                    $item->setStatus($data['status']);
                    $item->setAdditionalNotes($data['additionalNotes']);
                    $item->setLastMovement($data['lastMovement']);
                    $items[] = $item;
                }
                return $items;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
        }
    }

    public function createItem($itemName, $location, $customerID, $model, $serialNumber, $status, $lastMovement, $additionalNotes)
    {
        try {
            $connect = connect();
            $stmt = $connect->prepare(" INSERT INTO equipment (itemName, location, customerID, model, serialNumber, status, lastMovement, additionalNotes) 
            VALUES(:itemName, :location, :customerID, :model, :serialNumber, :status, :lastMovement, :additionalNotes)");
            $stmt->bindParam(':itemName', $itemName);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':serialNumber', $serialNumber);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':lastMovement', $lastMovement);
            $stmt->bindParam(':additionalNotes', $additionalNotes);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function editItem($itemName, $location, $customerID,  $model, $serialNumber, $status, $lastMovement, $additionalNotes, $id)
    {
        try {
            $connect = connect();
            $stmt = $connect->prepare(" UPDATE equipment 
                                        SET itemName = :itemName, 
                                        location = :location,
                                        customerID = :customerID, 
                                        model = :model,
                                        serialNumber = :serialNumber, 
                                        status = :status,
                                        lastMovement = :lastMovement,
                                        additionalNotes = :additionalNotes 
                                        WHERE id = :id");
            $stmt->bindParam(':itemName', $itemName);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':serialNumber', $serialNumber);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':lastMovement', $lastMovement);
            $stmt->bindParam(':additionalNotes', $additionalNotes);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function removeItem($id)
    {
        try {
            $connect = connect();
            $stmt = $connect->prepare("UPDATE equipment SET status = 2 WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function removeMovementItem($movementId)
    {
        try {
            $connect = connect();
            $stmt = $connect->prepare("UPDATE movementhistory SET status = 2 WHERE id = :movementId");
            $stmt->bindParam(":movementId", $movementId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function getCustomerName()
    {
        try {
            $connect = connect();
            $query = "SELECT id, customerName FROM customer WHERE status = 1 ORDER BY id DESC";

            $stmt = $connect->prepare($query);
            $stmt->execute();
            $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $customers;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function addNewMovement($equipmentId, $newLocation, $dateMovement)
    {
        try {
            $connect = connect();
            if (!$connect) {
                error_log('Erro de conexão');
                exit();
            }
            $query = " INSERT INTO
                         movementhistory
                         (equipmentId,
                         newLocation,
                         date)
                       VALUES 
                         (:equipmentId,
                          :newLocation,
                          :date)";

            $stmt = $connect->prepare($query);
            $stmt->bindParam(':equipmentId', $equipmentId);
            $stmt->bindParam(':newLocation', $newLocation);
            $stmt->bindParam(':date', $dateMovement);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function getMovementHistory($itemId)
    {
        try {
            $connect = connect();
            if (!$connect) {
                error_log('Erro de conexão');
                exit();
            }
            $historyMovements = [];
            $stmt = $connect->prepare("SELECT * FROM movementhistory WHERE equipmentId = :itemId AND status = 1 ORDER BY id ASC");
            $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
            $stmt->execute();
            $historyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($historyData as $dataMovement) {
                $movementHistory = new MovementHistory;
                $movementHistory->setId($dataMovement['id']);
                $movementHistory->setEquipmentId($dataMovement['equipmentId']);
                $movementHistory->setNewLocation($dataMovement['newLocation']);
                $movementHistory->setDate($dataMovement['date']);

                $movementArray = array(
                    'id' => $movementHistory->getId(),
                    'equipmentId' => $movementHistory->getEquipmentId(),
                    'newLocation' => $movementHistory->getNewLocation(),
                    'date' => $movementHistory->getDate()
                );

                $historyMovements[] = $movementArray;
            }

            return $historyMovements;
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
            return false;
        }
    }
}
