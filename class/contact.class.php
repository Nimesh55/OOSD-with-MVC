<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Contact{
    private $email;
    private $telephone;


    public function setEmail($email): void
    {
        $this->email = $email;
    }


    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getTelephone()
    {
        return $this->telephone;
    }



}
