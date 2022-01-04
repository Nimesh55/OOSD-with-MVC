<?php

    class Email_Sender_Adapter{
        private $admin_controller;
        private $email_sender;
        private static $instance;

        private function __construct()
        {
            $this->admin_controller = new Administrator_controller();
            $details = $this->admin_controller->getAdministratorEmailSettings();
            $this->email_sender= Email_Sender::getInstance($details['email'],$details['password'],$details['port']);
        }

        public function sendEmail(Email $email){
//            $email_sender = new Email_Sender("safetansit@gmail.com","geniousnimesh");
            return $this->email_sender->sendEmail($email);
        }
        public static function getInstance()
        {
            if (self::$instance == null) {
                self::$instance = new Email_Sender_Adapter();
            }
            return self::$instance;
        }
    }
