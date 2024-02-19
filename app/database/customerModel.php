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
                        c.status,
                        c.equipamentNumber,
                        c.address,
                        c.phone,
                        CASE
                            WHEN MAX(e.lastMovement) IS NULL THEN 'Não Possui'
                            ELSE MAX(e.lastMovement)
                        END AS lastMovement,
                        CASE
                            WHEN COUNT(e.customerID) = 0 THEN 'Nenhum Equipamento Cadastrado'
                            ELSE COUNT(e.customerID)
                        END AS totalItems
                       FROM
                        customer AS c
                        LEFT JOIN equipment AS e ON c.id = e.customerID
                        AND e.status = 1
                       WHERE
                        c.status = 1
                       GROUP BY
                        c.id,
                        c.customerName,
                        c.equipamentNumber,
                        c.address,
                        c.phone
                       ORDER BY
                        c.id DESC";
            $stmt = $connect->query($query);

            $customerData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $customers = [];

            foreach ($customerData as $data) {
                $customer = new Customer;
                $customer->setId($data['customer_id']);
                $customer->setCustomerName($data['customerName']);
                $customer->setTotalEquipment($data['totalItems']);
                $customer->setAddress($data['address']);
                $customer->setPhone($data['phone']);
                $customer->setStatus($data['status']);
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
                $customer->setStatus($customerData['status']);
                $customer->setPhone($customerData['phone']);
                $customerArray = [
                    "customerName" => $customer->getCustomerName(),
                    "address" => $customer->getAddress(),
                    "status" => $customer->getStatus(),
                    "phone" => $customer->getPhone()
                ];
                return $customerArray;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
        }
    }


    public function createCustomer($customerName, $address, $phone, $status)
    {
        try {
            $connect = connect();
            if (!$connect) {
                error_log('Erro: Falha na conexão com o banco de dados.');
                exit();
            }

            $stmt = $connect->prepare("INSERT INTO customer(customerName, address, phone, status) VALUES(:customerName, :address, :phone, :status)");
            $stmt->bindParam(':customerName', $customerName);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
            return false;
        }
    }

    public function editCustomer($id, $customerName, $address, $phone, $status)
    {
        try {
            $connect = connect();
            if (!($connect)) {
                error_log('Erro: Falha na conexão com o banco de dados.');
                exit();
            }

            $stmt = $connect->prepare("UPDATE customer 
                                       SET customerName = :customerName, 
                                       address = :address,
                                       phone = :phone,
                                       status = :status
                                       WHERE id = :id");
            $stmt->bindParam(':customerName', $customerName);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
            return false;
        }
    }

    public function removeCustomer($id)
    {
        try {
            $connect = connect();
            if (!($connect)) {
                error_log('Erro: Falha na conexão com o banco de dados.');
                exit();
            }

            $stmt = $connect->prepare(" UPDATE customer 
                                        SET status = 2
                                        WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Erro durante a execução da declaração preparada: ' . $e->getMessage());
            return false;
        }
    }
}
