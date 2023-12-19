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
            $query = "SELECT * FROM equipment";
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
}
