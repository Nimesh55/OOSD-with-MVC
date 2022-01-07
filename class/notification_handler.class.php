<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
class Notification_handler
{
    private static $admin_controller;
    private static $smsAdapter;
    private static $emailAdapter;

    private static function set_config()
    {
        Timer::setTimeZone();
        self::$admin_controller = new Administrator_controller();
        $details = self::$admin_controller->getAdministratorConfigSettings();
        self::$smsAdapter = new Sms_adapter();
        self::$emailAdapter = Email_Client_Adapter::getInstance($details);
        self::$smsAdapter->setConfig($details['sms_ApiKey'], $details['sms_DeviceId']);
    }

    /*
    * Call this method passes a message to SMS and Email system
    * @param: $reciverArray- index 0 = telephone number, index 1 = email address
    * @param: $messageBody- The notification text that is needed to be sent
    */
    private static function sendNotification($reciverArray, $messageBody, $emailSubject)
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

    // Notification types 
    private static function notification_builder($param)
    {
        $msgType = $param[0];
        print_r($param);
        // exit();
        switch ($msgType) {
            case $msgType = 0:
                $msg = "Your Pass is \"Pending\" Approval.\nPass Id: " . $param[1] . "  \nRequested details \nRoutes: " . $param[2] . "\nValid from: " . $param[3] . "\nTo: " . $param[4];
                $emailSubject = "Pass Pending";
            case $msgType = 1:
                $msg = "Your Pass is \"Approved\".\nPassenger User ID: " . $param[1] . "\nPass Id: " . $param[2] . "  \nRoutes: " . $param[3] . "\nValid from: " . $param[4] . "\nTo: " . $param[5];
                $emailSubject = "Pass Approved";
            case $msgType = 2:
                $msg = "Your Pass is \"Declined\".\n Pass Id: " . $param[1];
                $emailSubject = "Pass Declined";
            case $msgType = 3:
                $msg = "Your Pass has been \"Declined\" by your Service: " . $param[1] . "\nPass Id: " . $param[2] . " \n Contact your Relevant Service for more details.";
                $emailSubject = "Pass Declined by Service";
            case $msgType = 4:
                $msg = "Your Pass has been \"Expired\" Pass Id: " . $param[1];
                $emailSubject = "Pass Expired!";
            case $msgType = 5:
                $msg = "Your Pass is \"Pending\" Approval.\nPass Id: " . $param[1] . "  \nRequested details \nRoutes: " . $param[2] . "\nValid from: " . $param[3] . "\nTo: " . $param[4];
                $emailSubject = "Pass Pending";
            case $msgType = 6:
                $msg = "Your Pass is \"Pending\" Approval.\nPass Id: " . $param[1] . "  \nRequested details \nRoutes: " . $param[2] . "\nValid from: " . $param[3] . "\nTo: " . $param[4];
                $emailSubject = "Pass Pending";
            case $msgType = 7:
                $msg = "Your Pass is \"Pending\" Approval.\nPass Id: " . $param[1] . "  \nRequested details \nRoutes: " . $param[2] . "\nValid from: " . $param[3] . "\nTo: " . $param[4];
                $emailSubject = "Pass Pending";
            case $msgType = 8:
                $msg = "Your Pass is \"Pending\" Approval.\nPass Id: " . $param[1] . "  \nRequested details \nRoutes: " . $param[2] . "\nValid from: " . $param[3] . "\nTo: " . $param[4];
                $emailSubject = "Pass Pending";
            case $msgType = 9:
                $msg = "Your Pass is \"Pending\" Approval.\nPass Id: " . $param[1] . "  \nRequested details \nRoutes: " . $param[2] . "\nValid from: " . $param[3] . "\nTo: " . $param[4];
                $emailSubject = "Pass Pending";
        }
        return [$msg, $emailSubject];
    }

    private static function notification_ServiceConfirmation($email, $telephone, $param)
    {
        $msg = "Your service is Approved. \n Your Service Details are, \n Service Name:____ \n Service Id: \n";
        $rmsg = "Your Service is Removed by the Safe Transit Administration. \n Your Service Details are, \n Service Name:____ \n Service Id: \n";
    }

    private static function notification_Allocation($email, $telephone, $param)
    {
        $msg = "A vehicle is allocated to your Service:______ \n Booking Id:____ \n Vechicle No:_______ \n Number of seats:_____ \n PickUp Point: _____\n Destination:_______\n ";
    }

    private static function notification_ConductorAccountRemoved($email, $telephone, $param)
    {
        $msg = "Your Conductor Account Has been Removed. Your Account Details\n Conductor Id: \n Vehicle Number: ";
    }

    private static function notification_PassengerAccount($email, $telephone, $param)
    {
        $msg = "Your Passenger Account has been Approved and you have been Verified as a service member of :\n Your details are,\n User Id: \n Fullname: \n Staff Id: \n ";
    }

    private static function notification_ConductorCancleBooking($email, $telephone, $param)
    {
        $msg = "Your booking Has been Cancled. \n Booking Details,\n Booking Id: \n Vehicle Number: \n ";
    }

    public static function setupNotification($email, $telephone, $param)
    {
        $contactArray = [$email, $telephone]; //Contact Details to send Notification
        $messageBody = self::notification_builder($param); // Subject and Body
        //self::sendNotification([$telephone, $email], $messageBody[0], $messageBody[1]); //uncomment to send notifications.
    }
}
