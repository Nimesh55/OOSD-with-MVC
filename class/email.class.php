<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";


    class Email{
        private $to;
        private $subject;
        private $body;
        private $header;

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
        public function getHeader(): string
        {
            return $this->header;
        }

        public function __construct($from,$to,$subject,$body)
        {
            $this->to = $to;
            $this->subject = $subject;
            $this->body = $body;
            $this->header = "From: {$from}\r\nContent-Type: text/html;";
        }
        public function sendEmail(){
            $email_sender = Email_Sender::getInstance();
            return $email_sender->send($this);
        }

    }
