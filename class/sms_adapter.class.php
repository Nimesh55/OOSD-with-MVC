<?php

require_once $_SERVER['DOCUMENT_ROOT'] ."/OOSD-with-MVC/api/sms/sms.api.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/class/sms.interface.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";


class Sms_adapter implements Sms
{
    private $smsApiObj;
    public function __construct()
    {
        $this->smsApiObj = SmsApi::getInstance();
    }

    public function setConfig($apiKey, $deviceId){
        $this->smsApiObj->set_config($apiKey, $deviceId);
    }

    public function send_Sms($reciever, $message_body){
        $this->smsApiObj->sendSms($reciever, $message_body);
    }
}
