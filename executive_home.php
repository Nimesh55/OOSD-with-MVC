<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['user_Id'])){
    header("Location: login.php");
    return;
}

$executive_view = new Executive_View();
$details = $executive_view->getHomeDetails();
$_SESSION['service_no'] = $details["service_number"];
$_SESSION['exec_name'] = $details['name'];
$_SESSION['service_name'] = $details['service_name'];

$state_str = $executive_view->getEssentialServiceDetails($_SESSION['service_no']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/_home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Executive Home</title>
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
                        <li class="active"><a href="executive_home.php">Home</a></li>
                        <?php 
                        if ($state_str == "Pending" || $state_str=="Non-Essential" || $state_str=="Removed") {
                            echo '<li class="disabled"><a>Pass Details</a></li>';
                            echo '<li class="disabled"><a>Booking Details</a></li>';
                            echo '<li class="disabled"><a> Passenger Details</a></li>';
                        }
                        else{
                            echo '<li><a href="executive_pass_details.php">Pass Details</a></li>';
                            echo '<li><a href="executive_booking_details.php">Booking Details</a></li>';
                            echo '<li><a href="executive_passenger_details.php"> Passenger Details</a></li>';
                        }
                        ?>
                        <li><a href="executive_essential_service_details.php">Essential Service Details</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= $details['name'] ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="edit_profile.php">Edit profile</a></li>
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
    <h1> <?= $details['name'] ?> </h1>
    <div style="margin-top:100px;">
        <div class="row">
            <div class="col-sm-3 p-3"></div>
            <div class="col-sm-3 p-3 bg-dark text-white">
                <p>Company Name</p>
            </div>
            <div class="col-sm-3 p-3 bg-primary text-white">
                <p>: <?= $details['service_name'] ?> </p>
            </div>
            <div class="col-sm-3 p-3"></div>
        </div>

        <div class="row">
            <div class="col-sm-3 p-3"></div>
            <div class="col-sm-3 p-3 bg-dark text-white">
                <p>Number of Passengers</p>
            </div>
            <div class="col-sm-3 p-3 bg-primary text-white">
                <p>: <?= $details['passenger_count'] ?> </p>
            </div>
            <div class="col-sm-3 p-3"></div>
        </div>

        <div class="row">
            <div class="col-sm-3 p-3"></div>
            <div class="col-sm-3 p-3 bg-dark text-white">
                <p>Number of requested Passes</p>
            </div>
            <div class="col-sm-3 p-3 bg-primary text-white">
                <p>: <?= $details['requested_passes_count'] ?> </p>
            </div>
            <div class="col-sm-3 p-3"></div>
        </div>

        <div class="row">
            <div class="col-sm-3 p-3"></div>
            <div class="col-sm-3 p-3 bg-dark text-white">
                <p>Number of approved Passes</p>
            </div>
            <div class="col-sm-3 p-3 bg-primary text-white">
                <p>: <?= $details['approved_passes_count'] ?> </p>
            </div>
            <div class="col-sm-3 p-3"></div>
        </div>
    </div>
    <br>
    <br>

</div>
</body>

</html>