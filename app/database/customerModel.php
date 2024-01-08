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
                    c.id, c.customerName, c.equipamentNumber, c.address
                   ORDER BY c.id DESC";
            $stmt = $connect->query($query);

            $customerData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $customers = [];

            foreach ($customerData as $data) {
                $customer = new Customer;
                $customer->setId($data['customer_id']);
                $customer->setCustomerName($data['customerName']);
                $customer->setTotalEquipment($data['total_items']);
                $customer->setAddress($data['address']);
                $customer->setLastMovement($data['lastMovement']);
                $customers[] = $customer;
            }
            return $customers;
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
        }
    }

    public function getCustomerById($id)
    {
        try {
            if (isset($id) && $id > 0) {

                $connect = connect();
                $customer = new Customer;
                $query = "SELECT * FROM customer WHERE id = :id";
                $stmt = $connect->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $customerData = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!($customerData)) {
                    return null;
                }
                $customer->setCustomerName($customerData['customerName']);
                $customer->setAddress($customerData['address']);
                return $customer;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
        }
    }

    public function createCustomer($customerName, $address)
    {
        try {
            $connect = connect();
            if (!$connect) {
                error_log('Erro: Falha na conexão com o banco de dados.');
                exit();
            }

            $stmt = $connect->prepare("INSERT INTO customer(customerName, address) VALUES(:customerName, :address)");
            $stmt->bindParam(':customerName', $customerName);
            $stmt->bindParam(':address', $address);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
            return false;
        }
    }

    public function editCustomer($id, $customerName, $address)
    {
        try {
            $connect = connect();
            if (!($connect)) {
                error_log('Erro: Falha na conexão com o banco de dados.');
                exit();
            }

            $stmt = $connect->prepare("UPDATE customer 
                                       SET customerName = :customerName, 
                                       address = :address
                                       WHERE id = :id");
            $stmt->bindParam(':customerName', $customerName);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
            return false ;
        }
    }
}
