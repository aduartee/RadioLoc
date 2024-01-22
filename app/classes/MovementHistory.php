<?php
namespace app\classes;

class MovementHistory
{
    private $id;
    private $equipmentId;
    private $newMovement;
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

    public function getNewMovement()
    {
        return $this->newMovement;
    }

    public function setNewMovement($newMovement)
    {
        $this->newMovement = $newMovement;
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
