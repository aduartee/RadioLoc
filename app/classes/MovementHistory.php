<?php
class MovementHistory
{
    private $id;
    private $equipmentId;
    private $movement;
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

    public function getMovement()
    {
        return $this->movement;
    }

    public function setMovement($movement)
    {
        $this->movement = $movement;
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
