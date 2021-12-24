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

    public function validatedetails($details)
    {
        //validate details and give feedback
        $errors=array();
        if (empty($details['fname']) && empty($details['lname'])) {
            $errors[]='Please enter first name and last name!!!';
        }elseif(empty($details['address'])){
            $errors[]='Please enter address!!!';
        }elseif(filter_var($details['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[]='Please insert valid email!!!';
        }elseif (!is_numeric($details['telephone']) or strlen($details['telephone'])!=10) {
            $errors[]="Enter correct telephone number!!!";
        }
        if(empty($errors)){
            $this->changeDetails($details);
            return $errors;
        }else{
            return $errors;
        }
    }

}

?>
