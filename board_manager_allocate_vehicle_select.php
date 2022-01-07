<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['user_Id'])){
    header("Location: login.php");
    return;
}

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->getSelectVehicleDetails($_GET['booking_no'],$_GET['pickup']);

$available_vehicles = $details['vehicle_list'];
$vehicle_cnt = count($available_vehicles);

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
    <title>Select the Vehicle</title>
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
                        <li><a href="board_manager_allocate_vehicle_view.php?booking_no=<?= $_GET['booking_no']?>">Back</a></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= $details['name']  ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
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


<!-- List view with buttons -->
<h1>Available Vehicle List</h1>
<div class="list-group">
    <?php
        $index =0;
        while ($index<$vehicle_cnt):
    ?>
    <a class="list-group-item list-group-item-action active" href="includes/allocate_vehicle.inc.php?action=2&booking_no=<?= $_GET['booking_no']?>&conductor_no=<?= $available_vehicles[$index]->getconductor_no() ?>"><?= $available_vehicles[$index]->getvehicle_no() ?></a>
<!--    <a href="#" class="list-group-item list-group-item-action">Vehicle 2</a>-->
<!--    <a href="#" class="list-group-item list-group-item-action">Vehicle 3</a>-->
<!--    <a href="#" class="list-group-item list-group-item-action">Vehicle 4</a>-->
    <?php
            $index++;
        endwhile;
    ?>
</div>

<!-- Selecting the Vehicle should be implemented later -->
<!--<a class="btn btn-sm btn-default" href="includes/allocate_vehicle.inc.php?action=2">Select</a>-->
</body>

</html>