<?php

    require_once "../sms/sms.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";


class Sms_Adapter{

        private $sms_tracker;
        private $deliveryReport;

        public function __construct($sms_tracker)
        {
            $this->sms_tracker = $sms_tracker;
            $this->deliveryReport = '';
        }

        public function sendSms($recipient_no,$from,$message){
            $this->deliveryReport = $this->sendSms($recipient_no,$from,$message);
            return $this->deliveryReport;
        }

    }


?>
