<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
abstract class User
{
    private $user_id;
    private $account_no;
    private $first_name;
    private $last_name;
    private $address;
    private $telephone;
    private $email;


    public function getUserId(){return $this->user_id;}

    public function setUserId($user_id){$this->user_id = $user_id;}

    public function getAccountNo(){return $this->account_no;}

    public function setAccountNo($account_no){$this->account_no = $account_no;}

    public function getFirstName(){return $this->first_name;}

    public function setFirstName($first_name){$this->first_name = $first_name;}

    public function getLastName(){return $this->last_name;}

    public function setLastName($last_name){$this->last_name = $last_name;}

    public function getAddress(){return $this->address;}

    public function setAddress($address){$this->address = $address;}

    public function getTelephone(){return $this->telephone;}

    public function setTelephone($telephone){$this->telephone = $telephone;}

    public function getEmail(){return $this->email;}

    public function setEmail($email){$this->email = $email;}


}