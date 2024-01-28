<?php

namespace app\classes;

use app\Helpers\DataHelper;

class Item
{
    private $id;
    private $itemName;
    private $location;
    private $customerName;
    private $customerID;
    private $model;
    private $serialNumber;
    private $status;
    private $lastMovement;
    private $additionalNotes;

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
    public function getItemName()
    {
        return $this->itemName;
    }

    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }
    public function setLocation($location)
    {
        $this->location = $location;
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
     * @return string
     */
    public function getCustomerID()
    {
        return $this->customerID;
    }
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getLastMovement()
    {
        if ($this->lastMovement != null) {
            $helperDate = new DataHelper;
            return $helperDate->formatToBrazil($this->lastMovement);
        }
        return null;
    }
    public function setLastMovement($lastMovement)
    {
        $this->lastMovement = $lastMovement;
    }

    /**
     * @return string
     */
    public function getAdditionalNotes()
    {
        return $this->additionalNotes;
    }
    public function setAdditionalNotes($additionalNotes)
    {
        $this->additionalNotes = $additionalNotes;
    }
}
