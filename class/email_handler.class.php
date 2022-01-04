<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/Email/email_sender.class.php";

    class Email_Handler{
        private $to;
        private $subject;
        private $body;
        private $header;
        private $admin_controller;
        private $email_sender;


        /**
         * @return mixed
         */
        public function getTo()
        {
            return $this->to;
        }

        /**
         * @return mixed
         */
        public function getSubject()
        {
            return $this->subject;
        }

        /**
         * @return mixed
         */
        public function getBody()
        {
            return $this->body;
        }

        /**
         * @return string
         */
        public function getHeader()
        {
            return $this->header;
        }

        public function __construct($from,$to,$subject,$body)
        {
            $this->to = $to;
            $this->subject = $subject;
            $this->body = $body;
            $this->header = "From: {$from}\r\nContent-Type: text/html;";
            $this->admin_controller=new Administrator_controller();
            $details=$this->admin_controller->getAdministratorEmailSettings();
            $this->email_sender = new Email_Sender($details['email'],$details['password'],$details['port']);
//            $this->email_sender = new Email_Sender("safetansit@gmail.com","geniousnimesh",587);
        }

        //This method use to send email
        public function sendEmail(){
//            $email_sender = new Email_Sender("safetansit@gmail.com","geniousnimesh",587);
            return $this->email_sender->sendEmail($this);
        }

    }
