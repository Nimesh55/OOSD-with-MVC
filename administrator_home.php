<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['account_no'])){
    header("Location: login.php");
    return;
}


$view = new Administrator_View();
$viewArray = $view->getDetails();
$numofpendingCompanies = $viewArray["pending"];
$numofServicesApproved = $viewArray["approved"];
$numofIssuedPasses = $viewArray["issued"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/passenger_home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Administrator Home</title>
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
                            <li class="active"><a href="administrator_home.php">Home</a></li>
                            <li><a href="administrator_pending_essential_services.php">Pending Essential Services</a></li>
                            <li><a href="administrator_approved_essential_services.php">Approved Essential Services</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo 'Administrator'; ?> <span class="caret"></span></a>
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
<!--        <h1> --><?//= $_SESSION['user_Id'] ?><!-- </h1>-->
        <h1 id="heading"> <?= 'Administrator'; ?> </h1>


        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 wrapper">

                <div class="row">
                    <div class="col-sm-6 p-3 field">
                        <p>Number of Pending Companies</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-5 p-3">
                        <p><?php echo $numofpendingCompanies ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 p-3 field">
                        <p>Number of Aprrroved Companies</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-5 p-3">
                        <p><?php echo $numofServicesApproved ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 p-3 field">
                        <p>Number of Issued Passes</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-5 p-3">
                        <p><?php echo $numofIssuedPasses ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>

        </div>

    </div>
</body>

</html>