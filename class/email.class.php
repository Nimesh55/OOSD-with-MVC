<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/api/email/email_sender.class.php";

    class Email{
        private $to;
        private $subject;
        private $body;
        private $header;



        public function getTo(){return $this->to;}
        public function getSubject(){return $this->subject;}
        public function getBody(){return $this->body;}
        public function getHeader(){return $this->header;}

        public function __construct($to,$subject,$body)
        {
            $this->to = $to;
            $this->subject = $subject;
            $this->body = $body;
        }

        //This method use to send email


    }
