<?php

  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger_Controller extends Passenger_Model
  {
      function __construct(){}
        public function validatedetails($details)
      {
      //validate details and give feedback
      if (empty($details['fname']) && empty($details['lname'])) {
          $_SESSION["error"] = 'Please enter first name and last name!!!';
      }elseif(empty($details['address'])) {
          $_SESSION["error"] = 'Please enter address!!!';
      }elseif(filter_var($details['email'], FILTER_VALIDATE_EMAIL) === false) {
          $_SESSION["error"] = 'Please insert valid email!!!';
      }elseif (!is_numeric($details['telephone']) or strlen($details['telephone'])!=10) {
          $_SESSION["error"] = "Enter correct telephone number!!!";
      }

      if(!isset($_SESSION["error"])){
        $this->changeDetails($details);
      }
  }
  public function createUsername($passenger){
    return $passenger->getFirstName()." ".$passenger->getLastName();
  }




}

 ?>
