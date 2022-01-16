<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

    echo "<pre>";
//    print_r($_SESSION);
    echo "</pre>";

    if (isset($_POST['exit'])){
        header("location:../login.php");
    }

    if(isset($_POST['submit'])) {
        $varification_num = rand(100000, 999999);

        //send verification number via sms and email
        $forget_pwd_controller = new Forget_Password_Controller();
        $contact = $forget_pwd_controller->getContactDetailsFromModel($_POST['user_id']);
//    echo "<pre>";
//    var_dump($contact);
//    echo "</pre>";
        if (is_string($contact) && (strcmp($contact, 'unchangerble') == 0 || strcmp($contact, 'notfound') == 0)) {
            header("location:../forget_password.php?error=$contact");
        } else {
            $email_address = $contact->getEmail();
            $telephone = $contact->getTelephone();

            $msg = "Safe Transit: Your verification code is {$varification_num}";

            $admin_controller = new Administrator_controller();
            $configuration = $admin_controller->getAdministratorConfigSettings();

            if (isset($_POST) and strcmp($_POST['medium'], "sms") == 0) {
                //send sms verification
                $sms_adapter = new Sms_adapter();
                $sms_adapter->setConfig($configuration['sms_ApiKey'], $configuration['sms_DeviceId']);
                $sms_adapter->send_Sms($telephone, $msg);
            } else {
                //send email verification
                $email_client_adapter = Email_Client_Adapter::getInstance($configuration);
                $email = new Email($email_address, "Verification", $msg);
                $email_client_adapter->sendEmail($email);
            }
        }
    }

    //##fetch user contacts



    //redirect to checking page
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<form id="returndata" action="../verify_user.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">
    <input type="hidden" name="verification_code" value="<?php echo $varification_num; ?>">
</form>
<script type="text/javascript">
    document.getElementById('returndata').submit();
</script>
</body>
</html>



