<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
abstract class Transport_Board_User{
    private $uid;

    public function getUid()
    {
        return $this->uid;
    }

    public function setUid($uid): void
    {
        $this->uid = $uid;
    }


}