<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/email_client.interface.php";
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/api/email/email_api.class.php";
class Email_Client_Adapter implements Email_Client_interface {
        private $email_api;
        private static $instance;

        private function __construct($details)
        {
            //print_r($details);
            $this->email_api= Email_Api::getInstance($details['email_emailAddress'],$details['email_password'],$details['email_port']);
        }

        public function sendEmail(Email $email){
            return $this->email_api->sendEmail($email);
        }
        public static function getInstance($details)
        {
            if (self::$instance == null) {
                self::$instance = new Email_Client_Adapter($details);
            }
            return self::$instance;
        }
    }
