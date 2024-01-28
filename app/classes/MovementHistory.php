<?php
namespace app\classes;

class MovementHistory
{
    private $id;
    private $equipmentId;
    private $newLocation;
    private $date;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEquipmentId()
    {
        return $this->equipmentId;
    }

    public function setEquipmentId($equipmentId)
    {
        $this->equipmentId = $equipmentId;
    }

    public function getNewLocation()
    {
        return $this->newLocation;
    }

    public function setNewLocation($newLocation)
    {
        $this->newLocation = $newLocation;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
}
