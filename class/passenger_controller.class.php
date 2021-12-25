<?php

  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger_Controller extends Passenger_Model
  {

    function __construct(){}
      public function validatedetails($details)
    {
    //validate details and give feedback
    $errors=array();
    if (empty($details['fname']) && empty($details['lname'])) {
      $errors[]='Please enter first name or last name!!!';
    }
    if (filter_var($details['email'], FILTER_VALIDATE_EMAIL) === false) {
      $errors[]='Please insert valid email!!!';
    }
    if (!is_numeric($details['telephone']) or strlen($details['telephone'])!=10) {
        $errors[]="Enter correct telephone number!!!";
    }
    if(empty($errors)){
      $this->changeDetails($details);
      return $errors;
    }else{
      return $errors;
    }
  }
  public function createUsername($passenger){
    return $passenger->getFirstName()." ".$passenger->getLastName();
  }




}

 ?>
