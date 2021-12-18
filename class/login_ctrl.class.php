<?php
// Controller in MVC
class Login_Controller extends Login{
    private $uid;
    private $password ;


    public function __construct($uid, $password)
    {
        $this->uid = $uid;
        $this->password = $password;
    }

    public function loginUser(){
        // check for all the errors using the helper functions
        if ($this->emptyField() == false) {
            // error msg here
            header("location: ../test.php?error=emptyfield");
            exit();
        }

        $this->getUser($this->uid , $this->password);
    }

    // Error handling methods
    private function emptyField(){
        // for executive handle company_id and company_name seperately by getting the user type       
        if (empty($this->uid)||empty($this->password)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

}