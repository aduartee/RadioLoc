<?php

namespace app\classes;

use app\Helpers\DataHelper;

class Customer
{
    private $id;
    private $customerName;
    private $totalEquipment;
    private $address;
    private $lastMovement;
    private $status;
    private $phone;

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
        if ($this->lastMovement != null) {
            $helper = new DataHelper;
            return $helper->formatToBrazil($this->lastMovement);
        }

        return null;
    }

    public function setLastMovement($lastMovement)
    {
        $this->lastMovement = $lastMovement;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}
