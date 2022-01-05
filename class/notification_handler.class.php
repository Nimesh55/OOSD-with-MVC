<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
class notification_handler
{
    private static $admin_controller;
    private static $smsAdapter;
    private static $emailAdapter;

    public static function set_config()
    {
        Timer::setTimeZone();
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
    public static function sendNotification($reciverArray, $messageBody, $emailSubject)
    {
        self::set_config();

        if (isset($reciverArray[1])) {
            $email = $reciverArray[1];
            $emailObj = new Email($email, $emailSubject, $messageBody);
            $errorCode = self::$emailAdapter->sendEmail($emailObj);
            if ($errorCode == -1) {
                $log  = "Email sending attempt on : " . date("F j, Y, g:i a") . " ; Email Status : Error \n";
            } elseif ($errorCode == 0) {
                $log  = "Email sending attempt on : " . date("F j, Y, g:i a") . " ; Email Status : Successful \n";
            }
            file_put_contents('logs/emailLog.Log', $log, FILE_APPEND);
        }
        if (isset($reciverArray[0])) {
            $telephone = $reciverArray[0];
            $errorCode = self::$smsAdapter->send_Sms($telephone, $messageBody);
            if ($errorCode == -1) {
                $log  = "SMS sending attempt on : " . date("F j, Y, g:i a") . " ; SMS Status : Error \n";
            } elseif ($errorCode == 0) {
                $log  = "SMS sending attempt on : " . date("F j, Y, g:i a") . " ; SMS Status : Successful \n";
            }
            file_put_contents('logs/smsLog.Log', $log, FILE_APPEND);
        }
    }
}
