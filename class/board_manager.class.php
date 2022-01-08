<?php

class Board_Manager extends Transport_Board_User {

    private $name;

    public function __construct($uid)
    {
        $this->name = "Board Manager";
        $this->setUid($uid);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }




}