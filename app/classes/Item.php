<?php
namespace app\classes;
class Item
{
    private $id;
    private $itemName;
    private $location;
    private $clientName;
    private $model;
    private $serialNumber;
    private $status;
    private $movementHistory = [];
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
     * @return array
     */
    public function getMovementHistory()
    {
        return $this->movementHistory;
    }

    // This method will be changed in the future to follow business rules.
    // public function addMovementToHistory($movement, $date)
    // {
    //     $movementHistoryEntry = new MovementHistory();
    //     $movementHistoryEntry->setEquipmentId($this->getId());
    //     $movementHistoryEntry->setMovement($movement);
    //     $movementHistoryEntry->setDate($date);

    //     $this->movementHistory[] = $movementHistoryEntry;
    // }

    // This method will be changed in the future to follow business rules. 
    public function getLastMovement()
    {
        $lastMovementIndex = count($this->movementHistory) - 1;
        return ($lastMovementIndex >= 0) ? $this->movementHistory[$lastMovementIndex] : null;
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
