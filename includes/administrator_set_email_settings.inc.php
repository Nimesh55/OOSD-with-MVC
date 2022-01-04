<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    $error = '';

    if (isset($_POST['save'])){
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        $addministrator_controller = new Administrator_controller();
        if(strcmp($_POST['edit'],'yes')==0) {
            $error = $addministrator_controller->addAdministratorNewEmailSettings(
                $_POST['email'],
                $_POST['password'],
                $_POST['port']
            );
        }else{
            $error = $addministrator_controller->editAdministratorEmailSettings(
                $_POST['email'],
                $_POST['password'],
                $_POST['port']);
        }

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
<form id="returndata" action="../administrator_set_email_settings.php" method="post">
    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
    <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
    <input type="hidden" name="port" value="<?php echo $_POST['port']; ?>">
    <input type="hidden" name="error" value="<?php echo $error; ?>">

<!--    <input type="hidden" name="sub" value="finish">-->

</form>
<script type="text/javascript">
    document.getElementById('returndata').submit();
</script>
</body>
</html>

