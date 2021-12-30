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
    private $password_repeat ;
    private $company_name;
    private $company_Id;
    private $account_type;
    private $page_name;
    private $vehicle_no;
    private $district;

    public function __construct($firstname, $lastname, $uid, $address, $email, $telephone, $password, $password_repeat, $company_name, $company_Id, $vehicle_no, $district, $account_type)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->uid = $uid;
        $this->address = $address;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
        $this->password_repeat = $password_repeat;
        $this->company_name = $company_name;
        $this->company_Id = $company_Id;
        $this->account_type = $account_type;
        $this->vehicle_no = $vehicle_no;
        $this->district = $district;
        if($account_type==0){
          $this->page_name="passenger";
        }elseif ($account_type==1) {
          $this->page_name="conductor";
        }else{
          $this->page_name="executive";
        }
    }

    public function signupUser(){
        // check for all the errors using the helper functions
        if (isset($_GET['src'])) {
            if ($_GET['src']==1) {
                $src = 1;
            }
            else{
                $src = 0;
            }
        }
        if ($this->emptyField() == false) {
            // error msg here
            header("location: ../".$this->page_name."_signup.php?error=emptyfield&src=".$src);
            exit();
        }

        if ($this->password_match() == false) {
            // error msg here
            header("location: ../".$this->page_name."_signup.php?error=passwordmismatch&src=".$src);
            exit();
        }

        if ($this->user_exist()) {
            // error msg here
            header("location: ../".$this->page_name."_signup.php?error=user_exist&src=".$src);
            exit();
        }

        if (!$this->isValidEmail()) {
            // error msg here
            header("location: ../".$this->page_name."_signup.php?error=emailWrong&src=".$src);
            exit();
        }

        if ($this->isUserValidInput() == false) {
            // error msg here
            header("location: ../".$this->page_name."_signup.php?error=invalidusername&src=".$src);
            exit();
        }

        if ($this->isTelephoneValidInput() == false) {
            // error msg here
            header("location: ../".$this->page_name."_signup.php?error=invalidtelephone&src=".$src);
            exit();
        }

        $this->addToUser( $this->uid , $this->password, $this->firstname, $this->lastname, $this->address, $this->telephone, $this->email, $this->company_name, $this->company_Id, $this->vehicle_no, $this->district, $this->account_type);
        if($this->account_type==1){
            header("location: ../board_manager_create_conductor.php?error=none&src=".$src);
        }else{
            header("location: ../login.php?error=none");
        }
    }

    // Error handling methods
    private function emptyField(){
        $result = true;
        if (($this->account_type==0)&&(empty($this->firstname)||empty($this->lastname)||empty($this->uid)||empty($this->address)||empty($this->email)||empty($this->telephone)||empty($this->password)||empty($this->password_repeat))) {
            $result = false;
        }elseif (($this->account_type==1)&&(empty($this->firstname)||empty($this->lastname)||empty($this->uid)||empty($this->address)||empty($this->vehicle_no)||empty($this->district)||empty($this->email)||empty($this->telephone))) {
            $result = false;
        }elseif (($this->account_type==2)&&(empty($this->firstname)||empty($this->lastname)||empty($this->uid)||empty($this->address)||empty($this->company_name)||empty($this->company_Id)||empty($this->email)||empty($this->telephone)||empty($this->password)||empty($this->password_repeat))) {
            $result = false;
        }
        return $result;
    }

    private function password_match(){
        if($this->password !== $this->password_repeat){
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
