<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Email_Sender{

    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Email_Sender();
        }
        return self::$instance;
    }

        public function send(Email $email){
            $result = mail(
                        $email->getTo()
                        ,$email->getSubject()
                        ,$email->getBody()
                        ,$email->getHeader());

            return $result;

        }






    }






