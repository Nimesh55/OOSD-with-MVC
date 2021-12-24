<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Executive_Controller extends Executive_Model
{
    private $executive;

    public function setUpDetails()
    {
        $details = $this->getRecord($_SESSION['user_Id']);
        $this->executive = new Executive();
        $this->executive->setValues($details['user_id'], $details['executive_no'], $details['first_name'],
            $details['last_name'], $details['address'], $details['telephone'],
            $details['service_no'], $details['email'], $details['state']);
        return $this->executive;
    }



}

?>
