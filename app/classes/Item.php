<?php
class Item
{
    private $id;
    private $itemName;
    private $location;
    private $clientName;
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
    public function getClientName()
    {
        return $this->clientName;
    }
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
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
