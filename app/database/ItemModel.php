<?php

namespace app\database;

use PDO;
use PDOException;
use app\classes\Item;
use app\classes\MovementHistory;

class ItemModel
{
    private $connect;

    public function __construct()
    {
        try {
            $this->connect = connect();
            if (!$this->connect) {
                error_log('Erro de conexão');
                exit();
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function getAllItems()
    {
        try {
            $query = " SELECT equipment.*, 
                                customer.customerName
                                FROM equipment
                                LEFT JOIN customer
                                ON equipment.customerID = customer.id 
                                WHERE equipment.status = 1 
                                ORDER BY equipment.id DESC";
            $stmt = $this->connect->query($query);

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
                $item = new Item;
                $query = " SELECT equipment.*, customer.customerName 
                           FROM equipment
                           LEFT JOIN customer
                           ON equipment.customerID = customer.id 
                           WHERE equipment.id = :id";
                $stmt = $this->connect->prepare($query);
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
                $stmt = $this->connect->prepare(" SELECT
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
            $stmt = $this->connect->prepare(" INSERT INTO equipment (itemName, location, customerID, model, serialNumber, status, lastMovement, additionalNotes) 
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
            $stmt = $this->connect->prepare(" UPDATE equipment 
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
            $stmt = $this->connect->prepare("UPDATE equipment SET status = 2 WHERE id = :id");
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
            $stmt = $this->connect->prepare("UPDATE movementhistory SET status = 2 WHERE id = :movementId");
            $stmt->bindParam(":movementId", $movementId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function getCustomerNameById($equipamentId)
    {
        try {
            $query = " SELECT
                        e.customerID, c.CustomerName
                      from 
                        equipment AS e
                      LEFT JOIN
                        customer AS c
                      ON e.customerID = c.id
                      WHERE 
                        e.status = 1 
                      AND
                        e.id = :equipamentId
                      LIMIT 1";

            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(':equipamentId', $equipamentId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function getCustomerName()
    {
        try {
            $query = " SELECT 
                        id, customerName 
                       FROM 
                        customer 
                       WHERE 
                        status = 1 
                       ORDER BY id DESC";

            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $customers;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function addNewMovement($equipmentId, $newLocation, $dateMovement, $typeMovement)
    {
        try {
            $query = " INSERT INTO
                         movementhistory
                         (equipmentId,
                         newLocation,
                         date,
                         movementType)
                       VALUES 
                         (:equipmentId,
                          :newLocation,
                          :date,
                          :movementType
                          )";

            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(':equipmentId', $equipmentId);
            $stmt->bindParam(':newLocation', $newLocation);
            $stmt->bindParam(':date', $dateMovement);
            $stmt->bindParam(':movementType', $typeMovement);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function addTransferMovement($equipmentId, $fromCustomerID, $toCustomerID, $dateMovement, $typeMovement)
    {
        try {
            $this->connect->beginTransaction();

            $queryMovement = " INSERT INTO 
                                movementhistory
                                (equipmentId,
                                date,
                                fromCustomer,
                                toCustomer,
                                movementType)
                               VALUES
                                (:equipmentId,
                                :dateMovement,
                                :fromCustomerID,
                                :toCustomerID,
                                :movementType 
                                )";
            $stmtMovement = $this->connect->prepare($queryMovement);
            $stmtMovement->bindParam(':equipmentId', $equipmentId);
            $stmtMovement->bindParam(':dateMovement', $dateMovement, PDO::PARAM_STR);
            error_log($dateMovement);   
            $stmtMovement->bindParam(':fromCustomerID', $fromCustomerID);
            $stmtMovement->bindParam(':toCustomerID', $toCustomerID);
            $stmtMovement->bindParam(':movementType', $typeMovement);

            $queryTransfer = "UPDATE equipment SET customerID = :toCustomerID WHERE id = :equipmentId";
            $stmtTransfer = $this->connect->prepare($queryTransfer);
            $stmtTransfer->bindParam(':toCustomerID', $toCustomerID);
            $stmtTransfer->bindParam(':equipmentId', $equipmentId);

            if ($stmtTransfer->execute() && $stmtMovement->execute()) {
                $this->connect->commit();
                return true;
            }
        } catch (PDOException $e) {
            $this->connect->rollBack();
            $e->getMessage();
            return false;
        }
    }


    public function addMaintenanceMovement($equipmentId, $equipamentSituation, $dateMovement, $typeMovement)
    {
        try {
            $query = " INSERT INTO 
                        movementhistory
                        (equipmentId,
                        date,
                        equipamentSituation,
                        movementType)
                    VALUES
                        (:equipmentId,
                        :dateMovement,
                        :equipamentSituation,
                        :movementType 
                        )";

            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(':equipmentId', $equipmentId);
            $stmt->bindParam(':dateMovement', $dateMovement);
            $stmt->bindParam(':equipamentSituation', $equipamentSituation);
            $stmt->bindParam(':movementType', $typeMovement);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function addLostMovement($equipmentId, $lossOrMisplacement, $dateMovement, $typeMovement)
    {
        try {
            $query = "INSERT INTO 
                    movementhistory
                    (equipmentId,
                    date,
                    equipamentSituation,
                    movementType)
                  VALUES
                    (:equipmentId,
                    :dateMovement,
                    :lossOrMisplacement,
                    :movementType)";

            $stmt = $this->connect->prepare($query);
            $stmt->bindParam(':equipmentId', $equipmentId);
            $stmt->bindParam(':dateMovement', $dateMovement);
            $stmt->bindParam(':lossOrMisplacement', $lossOrMisplacement);
            $stmt->bindParam(':movementType', $typeMovement);
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
            $historyMovements = [];
            $stmt = $this->connect->prepare(" SELECT 
                                                m.*,  
                                                fromCustomer.customerName AS fromCustomerName,
                                                toCustomer.customerName AS toCustomerName
                                              FROM 
                                                movementhistory AS m
                                              LEFT JOIN
                                                customer AS fromCustomer
                                              ON 
                                                m.fromCustomer = fromCustomer.id
                                              LEFT JOIN
                                                customer AS toCustomer
                                              ON 
                                                m.toCustomer = toCustomer.id
                                              WHERE 
                                                m.equipmentId = :itemId AND 
                                                m.status = 1
                                              ORDER BY 
                                                m.id ASC;
                                            ");
            $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
            $stmt->execute();
            $historyData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log($itemId);

            foreach ($historyData as $dataMovement) {
                $movementArray = $this->createMovementArray($dataMovement);
                $historyMovements[] = $movementArray;
            }

            return $historyMovements;
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
            return false;
        }
    }

    private function createMovementArray($dataMovement)
    {
        $movementArray = [
            'id' => $dataMovement['id'],
            'equipmentId' => $dataMovement['equipmentId'],
            'movementType' => $dataMovement['movementType']
        ];

        switch ($dataMovement['movementType']) {
            case 'location':
                $movementArray['newLocation'] = $dataMovement['newLocation'];
                $movementArray['date'] = $dataMovement['date'];
                break;

            case 'transfer':
                $movementArray['fromCustomerName'] = $dataMovement['fromCustomerName'];
                $movementArray['toCustomerName'] = $dataMovement['toCustomerName'];
                break;

            case 'maintenance':
            case 'lost':
                $movementArray['date'] = $dataMovement['date'];
                $movementArray['equipamentSituation'] = $dataMovement['equipamentSituation'];
                break;
        }

        return $movementArray;
    }
}
