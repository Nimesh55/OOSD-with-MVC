<?php
// Controller in MVC
class Signup_Controller extends Signup_Model {
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
    private $seats;

    public function __construct($firstname, $lastname, $uid, $address, $email, $telephone, $password, $password_repeat, $company_name, $company_Id, $vehicle_no, $district, $account_type, $seats)
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
        $this->seats = $seats;
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
            header("location: ../".$this->page_name."_signup.php?error=emptyfield&src=".$src);
            exit();
        }

        if ($this->password_match() == false) {
            header("location: ../".$this->page_name."_signup.php?error=passwordmismatch&src=".$src);
            exit();
        }

        if (!$this->isValidNIC($this->uid)) {
            header("location: ../".$this->page_name."_signup.php?error=InvalidUserId&src=".$src);
            exit();
        }

        if ($this->user_exist()) {
            header("location: ../".$this->page_name."_signup.php?error=user_exist&src=".$src);
            exit();
        }

        if ($this->email!=NULL && !$this->isValidEmail()) {
            header("location: ../".$this->page_name."_signup.php?error=emailWrong&src=".$src);
            exit();
        }

        if ($this->email!=NULL && $this->emailAlreadyExist()) {
            header("location: ../".$this->page_name."_signup.php?error=emailExist&src=".$src);
            exit();
        }

        if ($this->isUserValidInput() == false) {
            header("location: ../".$this->page_name."_signup.php?error=invalidusername&src=".$src);
            exit();
        }

       if ($this->isTelephoneValidInput() == false) {
           header("location: ../".$this->page_name."_signup.php?error=invalidTelephone&src=".$src);
           exit();
       }

        if(!$this->isValidPassword($this->password)){

            header("location: ../".$this->page_name."_signup.php?error=enterstrongpassword&src=".$src);
            exit();
        }

        if ($this->account_type==1) {
            if (!is_numeric($this->seats)) {
                header("location: ../".$this->page_name."_signup.php?error=enterValidSeatNumber&src=".$src);
                exit();
            }
        }

        $this->addToUser( $this->uid , $this->password, $this->firstname, $this->lastname, $this->address, $this->telephone, $this->email, $this->company_name, $this->company_Id, $this->vehicle_no, $this->district, $this->account_type, $this->seats);
        if($this->account_type==1){
            header("location: ../board_manager_create_conductor.php?error=none&src=".$src);
        }
        else if($this->account_type==0 && $this->company_name>0){
            header("location: ../executive_passenger_details.php");
        }
        else{
            header("location: ../login.php?error=none");
        }
    }

    // Error handling methods
    private function emptyField(){
        $result = true;
        if (($this->account_type==0)&&(empty($this->firstname)||empty($this->lastname)||empty($this->uid)||empty($this->address)||empty($this->telephone)||empty($this->password)||empty($this->password_repeat))) {
            $result = false;
        }elseif (($this->account_type==1)&&(empty($this->firstname)||empty($this->lastname)||empty($this->uid)||empty($this->address)||empty($this->vehicle_no)||empty($this->district)||empty($this->telephone))) {
            $result = false;
        }elseif (($this->account_type==2)&&(empty($this->firstname)||empty($this->lastname)||empty($this->uid)||empty($this->address)||empty($this->company_name)||empty($this->company_Id)||empty($this->email)||empty($this->telephone)||empty($this->password)||empty($this->password_repeat))) {
            $result = false;
        }
        elseif(($this->account_type==0) && !empty($this->company_name) && empty($this->company_Id)){
            $result = false;
        }
        return $result;
    }

    private function emailAlreadyExist(){
        if ($this->isEmailExist($this->email)>0) {
            return true;
        }
        return false;
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
        if (strlen($this->telephone) == 10 or strlen($this->telephone) == 12) {
            if (strlen($this->telephone) == 10) {
                if (!is_numeric($this->telephone)) {
                    return false;
                }
                return true;
            }
            else{
                $firstChar = substr($this->telephone, 0, 1);
                $numeric = substr($this->telephone, 1);
                if (strcmp($firstChar,"+") == 0 && is_numeric($numeric)) {
                    return true;
                }
            }
        }
        return false;
    }

    private function isValidPassword($password){
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password);

            echo $number;
            echo $uppercase;
            echo $lowercase;
            echo $specialChars;
            

        if(strlen($password) >= 8 && $number && $uppercase && $lowercase && $specialChars) {
            return true;
        } else {
            return false;
        }
    }

   //Validate NIC

   private function isValidNIC($nic)
   {
       $result = true;
       if ($nic != "") {
           if (strlen($nic) < 8 || strlen($nic)>16 ) {
               $result = false;
           }

           $nic_9 = substr($nic, 0, 9);

           if (!is_numeric($nic_9)) {
               $result = false;
           }
       }
    return $result;

   }
}
