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
            $query = "SELECT * FROM equipment ORDER BY id DESC";
            $stmt = $connect->query($query);

            $itemsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $items = [];

            foreach ($itemsData as $data) {
                $item = new Item();
                $item->setId($data['id']);
                $item->setItemName($data['itemName']);
                $item->setLocation($data['location']);
                $item->setClientName($data['clientName']);
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
                $query = "SELECT * FROM equipment WHERE id = :id";
                $stmt = $connect->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $itemData = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!($itemData)) {
                    return null;
                }

                $item->setItemName($itemData['itemName']);
                $item->setLocation($itemData['location']);
                $item->setClientName($itemData['clientName']);
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
}
