<?php
  /**
   *
   */
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger_Controller extends Passenger_Model
  {
    private $record;
    function __construct($passenger_no)
    {
      $stmt = $this->connect()->query("SELECT * FROM users JOIN passenger ON Passenger.passenger_no = Users.account_no WHERE Users.user_id = $passenger_no");
      $this->record = $stmt->fetch();
    }
  public function validatedetails($details)
  {
    //validate
    // echo "<pre>";
    // print_r($details);
    // echo "</pre>";
    // echo strlen($details['telephone']);

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

    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";
    if(empty($errors)){
      $this->changeDetails($details);
      return true;
    }else{
      return false;
    }


  }


}

 ?>
