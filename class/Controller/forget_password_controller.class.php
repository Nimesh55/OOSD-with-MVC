<?php
require_once "dbh.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Forget_Password_Controller extends Forget_Password_Model {
    public function getContactDetailsFromModel($user_id)
    {
        $forget_pwd_model = new Forget_Password_Model();
        $user_account_details  = $forget_pwd_model->getuserdetails($user_id);
        $contact = new Contact();
        if(!empty($user_account_details) && $user_account_details['account_type']<3){
            $contactdetails = $forget_pwd_model->getContactDetails($user_account_details['account_type'],$user_account_details['account_no']);
            $contact->setEmail($contactdetails['Email']);
            $contact->setTelephone($contactdetails['telephone']);
            return $contact;
        }
        if(!empty($user_account_details) && $user_account_details['account_type']>2){
            return "unchangerble";
        }
        if(empty($user_account_details)){
            return "notfound";
        }
    }
}