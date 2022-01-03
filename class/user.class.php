<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class User
{
    private $user_id;
    private $account_no;
    private $first_name;
    private $last_name;
    private $address;
    private $telephone;
    private $email;


    public function getUserIdFromUser(){return $this->user_id;}

    public function setUserIdInUser($user_id){$this->user_id = $user_id;}

    public function getAccountNoFromUser(){return $this->account_no;}

    public function setAccountNoInUser($account_no){$this->account_no = $account_no;}

    public function getFirstNameFromUser(){return $this->first_name;}

    public function setFirstNameInUser($first_name){$this->first_name = $first_name;}

    public function getLastNameFromUser(){return $this->last_name;}

    public function setLastNameInUser($last_name){$this->last_name = $last_name;}

    public function getAddressFromUser(){return $this->address;}

    public function setAddressInUser($address){$this->address = $address;}

    public function getTelephoneFromUser(){return $this->telephone;}

    public function setTelephoneInUser($telephone){$this->telephone = $telephone;}

    public function getEmailFromUser(){return $this->email;}

    public function setEmailInUser($email){$this->email = $email;}


}