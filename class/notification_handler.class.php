<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
class notification_handler{
    private static $admin_controller;
    private static $smsAdapter;
    private static $emailAdapter;

    public static function set_config(){
        self::$admin_controller = new Administrator_controller();
        $details = self::$admin_controller->getAdministratorConfigSettings();
        self::$smsAdapter = new Sms_adapter();
        self::$emailAdapter = Email_Client_Adapter::getInstance($details);
        self::$smsAdapter->setConfig($details['sms_ApiKey'], $details['sms_DeviceId']);
    }

    /*
    * Call this method from other classes to pass a message to SMS and Email system
    * @param: $reciverArray- index 0 = telephone number index 1 = email address
    * @param: $messageBody- The notification text that is needed to be sent
    */
    public static function sendNotification($reciverArray, $messageBody, $emailSubject){
        //## disable Email when not available.
        $telephone = $reciverArray[0];
        $email = $reciverArray[1];
        self::set_config();
        //self::$smsAdapter->send_Sms($telephone, $messageBody);
        $emailObj = new Email($email,$emailSubject, $messageBody);
        self::$emailAdapter->sendEmail($emailObj);

    }
}