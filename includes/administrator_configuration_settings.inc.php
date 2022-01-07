<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

    $error = '';
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

    if (isset($_POST['save'])){


        $addministrator_controller = new Administrator_controller();

            $error = $addministrator_controller->editAdministratorConfigSettings(
                $_POST['email'],
                $_POST['password'],
                $_POST['port'],
                $_POST['smsapikey'],
                $_POST['device_id']
            );




    }
    if (isset($_POST['back'])){
        header("Location: ../administrator_home.php");
        return;
    }




?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<form id="returndata" action="../administrator_configuration_settings.php" method="post">
    <input type="hidden" name="email" value="<?php echo $_POST['email'] ?>">
    <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
    <input type="hidden" name="port" value="<?php echo $_POST['port']; ?>">
    <input type="hidden" name="sms_ApiKey" value="<?php echo $_POST['smsapikey']; ?>">
    <input type="hidden" name="sms_DeviceId" value="<?php echo $_POST['device_id']; ?>">
    <input type="hidden" name="error" value="<?php echo $error; ?>">

    <input type="hidden" name="sub" value="finish">

</form>
<script type="text/javascript">
    document.getElementById('returndata').submit();
</script>
</body>
</html>
