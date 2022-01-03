<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
class notification_handler{
    private static $smsAdapter;
    private static $emailAdapter;

    public static function set_config(){
        self::$smsAdapter = new Sms_adapter();
        //## $this->emailAdapter = new Email
        self::$smsAdapter->setConfig('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY0MTA1NDcyMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjkyMjIyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.Mip0jiKnQrI3_9xcrF1cQmZuZugTv_jgyMh33om8S8Y','126786'); //## retrieve this from database later.
    }

    /*
    * Call this method from other classes to pass a message to SMS and Email system
    * @param: $reciverArray- index 0 = telephone number index 1 = email address
    * @param: $messageBody- The notification text that is needed to be sent
    */
    public static function sendNotification($reciverArray, $messageBody){
        $telephone = $reciverArray[0];
        //## $email = $reciverArray[1];
        self::set_config();
        self::$smsAdapter->send_Sms($telephone, $messageBody);
        //## Add email send message call here...

    }
}