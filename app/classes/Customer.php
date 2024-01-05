<?php

namespace app\classes;

class Customer
{
    private $id;
    private $clientName;
    private $equipamentNumber;
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
    public function getclientName()
    {
        return $this->clientName;
    }

    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     * @return int
     */
    public function getEquipamentNumber()
    {
        return $this->equipamentNumber;
    }

    public function setEquipamentNumber($equipamentNumber)
    {
        $this->equipamentNumber = $equipamentNumber;
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
