<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['account_no'])){
    header("Location: login.php");
    return;
}
$admin_view = new Administrator_View();
$details = $admin_view->getEmailSettingsDetails();

$email = "";
$password = "";
$port = "";

$sms_api = "";
$device_id = "";

if(!empty($details)) {
    $email = $details['email_emailAddress'];
    $password = $details['email_password'];
    $port = $details['email_port'];
    $sms_api = $details['sms_ApiKey'] ;
    $device_id = $details['sms_DeviceId'];
}

if(isset($_POST['error'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $port = $_POST['port'];
    $sms_api = $_POST['sms_ApiKey'] ;
    $device_id = $_POST['sms_DeviceId'];
}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/administrator_configue.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Administrator Email Settings</title>
</head>

<body>
<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="navbar-header">
                    <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <strong class="navbar-brand">Safe Transit</strong>
                </div>

                <div class="navbar-collapse collapse" id="mobile_menu">
                    <ul class="nav navbar-nav">
<!--                        <li class="active"><a href="administrator_set_email_settings.php.php">Email API Settings</a></li>-->
<!--                        <li><a href="#">SMS API Settings</a></li>-->
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo "Administrator" ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="administrator_configuration_settings.php">Settings</a></li>
                                <li><a href="change_password.php">Change Password</a></li>
                                <li><a href="includes/logout.inc.php">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <h1> <?= $_SESSION['user_Id'] ?> </h1>

    </div>




            <div class="container">
                <div class="row">
                    <div class="col-lg-3 cyan"></div>
                    <div class="col-lg-6 pink wrapper">

                        <form class="form-horizontal" role="form" action="includes/administrator_configuration_settings.inc.php" method="post">

                            <?php
                            if (isset($_POST['error']) && !empty($_POST['error'])) {

                                echo "<div class=\"alert alert-danger\"><strong>".$_POST['error']."</strong></div>";
                            }
                            if(isset($_POST['error']) && empty($_POST['error'])){
                                echo "<div class=\"alert alert-success\"><strong>"."Successfully Updated!!!"."</strong></div>";
                            }
                            ?>

                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email:</label>
                                <div class="col-sm-9">
                                    <input name="email" type="text" class="form-control" id="email" value="<?php echo $email;?>"></div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password:</label>
                                <div class="col-sm-9">

                                    <div class="input-group">
                                        <input name="password" type="password" class="form-control pwd" id="password" value="<?php echo $password;?>">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                    </div>

                                </div>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="port" class="col-sm-3 control-label">Port:</label>
                                <div  class="col-sm-9"><input name="port" type="text" class="form-control" id="port" value="<?php echo $port; ?>"></div>
                            </div>

                            <div class="form-group">
                                <label for="smsapikey" class="col-sm-3 control-label">SMS Api Key:</label>
                                <div class="col-sm-9">

                                    <div class="input-group">
                                        <input name="smsapikey" type="password" class="form-control input1" id="smsapikey" value="<?php echo $sms_api; ?>">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default apiKey" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="device_id" class="col-sm-3 control-label">Device ID:</label>
                                <div class="col-sm-9">

                                    <div class="input-group">
                                        <input name="device_id" type="password" class="form-control input2" id="device_id" value="<?php echo $device_id; ?>">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default deviceId" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="btn-group btn-group-lg">
                                <input type="submit" class="btn btn-primary ctrlbutton" name="save" value="Set"
                                onclick="return confirm('Are you sure?');">
                                <a href="administrator_home.php" class="btn btn-primary ctrlbutton">Back</a>
                            </div>

                        </form>

                    </div>
                    <div class="col-lg-3 orange"></div>
                </div>
            </div>

<script src="js/administrator_js.js"></script>

</body>

</html>
