<?php

namespace app\database;

use app\classes\Item;
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
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $itemData = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!($itemData)) {
                    return null;
                }

                $item->setItemName($itemData['itemName']);
                $item->setLocation($itemData['location']);
                $item->setCustomerName($itemData['customerName']);
                $item->setCustomerID($itemData['customerID']);
                $item->setModel($itemData['model']);
                $item->setSerialNumber($itemData['serialNumber']);
                $item->setStatus($itemData['status']);
                $item->setAdditionalNotes($itemData['additionalNotes']);
                $item->setLastMovement($itemData['lastMovement']);
                return $item;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            $e->getMessage();
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
}
