<?php

namespace app\database;

use app\classes\Customer;
use PDOException;
use PDO;

class CustomerModel
{
    public function getAllCustomers()
    {
        try {
            $connect = connect();
            $query = " SELECT 
                    c.id AS customer_id,
                    c.customerName,
                    c.equipamentNumber,
                    c.address,
                    MAX(e.lastMovement) AS lastMovement,
                    COUNT(e.id) AS total_items
                   FROM 
                    customer AS c
                   LEFT JOIN 
                    equipment AS e ON c.itemID = e.id
                   GROUP BY 
                    c.id, c.customerName, c.equipamentNumber, c.address";
            $stmt = $connect->query($query);

            $customerData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $customers = [];

            foreach ($customerData as $data) {
                $customer = new Customer;
                $customer->setCustomerName($data['customerName']);
                $customer->setTotalEquipment($data['total_items']);
                $customer->setAddress($data['address']);
                $customer->setLastMovement($data['lastMovement']);
                $customers[] = $customer;
            }
            return $customers;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
