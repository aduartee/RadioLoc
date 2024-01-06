<?php

namespace app\classes;

class Customer
{
    private $id;
    private $customerName;
    private $totalEquipment;
    private $address;
    private $lastMovement;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return int
     */
    public function getTotalEquipment()
    {
        return $this->totalEquipment;
    }

    public function setTotalEquipment($totalEquipment)
    {
        $this->totalEquipment = $totalEquipment;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getLastMovement()
    {
        return $this->lastMovement;
    }

    public function setLastMovement($lastMovement)
    {
        $this->lastMovement = $lastMovement;
    }
}
