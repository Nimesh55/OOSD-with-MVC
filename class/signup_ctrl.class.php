<?php
// Controller in MVC
class Signup_Controller extends Signup{
    private $firstname ;
    private $lastname ;
    private $uid;
    private $address;
    private $email;
    private $telephone ;
    private $password ;
    private $passwordrepeat ;
    private $company_name;
    private $company_Id;

    public function __construct($firstname, $lastname, $uid, $address, $email, $telephone, $password, $passwordrepeat, $company_name, $company_Id)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->uid = $uid;
        $this->address = $address;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
        $this->passwordrepeat = $passwordrepeat;
        $this->company_name = $company_name;
        $this->company_Id = $company_Id;
    }

    public function signupUser(){
        // check for all the errors using the helper functions
        if ($this->emptyField() == false) {
            // error msg here
            header("location: ../passenger_signup.php?error=emptyfield"); // Fix: Redirect depending on the user type.vv.
            exit();
        }
        
        if ($this->password_match() == false) {
            // error msg here
            header("location: ../passenger_signup.php?error=passwordmismatch");
            exit();
        }
        
        if ($this->user_exist()) {
            // error msg here
            header("location: ../passenger_signup.php?error=user_exist");
            exit();
        }
        
        if (!$this->isValidEmail()) {
            // error msg here
            header("location: ../passenger_signup.php?error=emailWrong");
            exit();
        }

        if ($this->isUserValidInput() == false) {
            // error msg here
            header("location: ../passenger_signup.php?error=invalidusername");
            exit();
        }

        if ($this->isTelephoneValidInput() == false) {
            // error msg here
            header("location: ../passenger_signup.php?error=invalidtelephone");
            exit();
        }

        $this->addToUser( $this->uid , $this->password, $this->firstname, $this->lastname, $this->address, $this->telephone, $this->email);
        header("location: ../login.php?error=none");
    }

    // Error handling methods
    private function emptyField(){
        // for executive handle company_id and company_name seperately by getting the user type       
        if (empty($this->firstname)||empty($this->lastname)||empty($this->uid)||empty($this->address)||empty($this->email)||empty($this->telephone)||empty($this->password)||empty($this->passwordrepeat)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function password_match(){
        if($this->password !== $this->passwordrepeat){
            return false;
        }
        else{
            return true;
        }
    }
    // user already exist
    private function user_exist(){
        if( $this->checkUser( $this->uid)){
            return true;
        }
        else{
            return false;
        }
    }

    private function isValidEmail(){
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function isUserValidInput(){
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            return false;
        }
        return true;
    }

    private function isTelephoneValidInput(){
        if (!is_numeric($this->telephone)) {
            return false;
        }
        return true;
    }
}