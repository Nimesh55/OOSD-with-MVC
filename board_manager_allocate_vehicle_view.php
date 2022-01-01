<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['user_Id'])){
    header("Location: login.php");
    return;
}

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->getBookingViewDetails($_GET['booking_no']);

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
    <title>Board Manager Allocate Vehicle</title>
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
                        <li><a href="board_manager_allocate_vehicle.php">Back</a></li>

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


<!-- List view and redirected Page button -->
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Service</th>
        <th scope="col">Reason</th>
        <th scope="col">Pickup Location</th>
        <th scope="col">Destination Location</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Start Time</th>
        <th scope="col">End Time</th>
<!--        <th scope="col">Start Time</th>-->
<!--        <th scope="col">End Time</th>-->
        <th scope="col">No of Passengers</th>
        <?php
        if($details['booking_state']==1){
            echo '<th scope="col">Vehicle No</th>';
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= $details['service_name'] ?></td>
        <td><?= $details['reason'] ?></td>
        <td><?= $details['pickup_location'] ?></td>
        <td><?= $details['destination_location'] ?></td>
        <td><?= $details['start_date'] ?></td>
        <td><?= $details['end_date'] ?></td>
        <td><?= $details['start_time'] ?></td>
        <td><?= $details['end_time'] ?></td>
        <td><?= $details['passenger_count'] ?></td>
        <?php
            if($details['booking_state']==1){
                echo "<td>{$details['booked_vehicle']}</td>";
            }
        ?>
    </tr>
    </tbody>
</table>

<?php
    if($details['booking_state']==0){
        echo "<a class=\"btn btn-sm btn-default\" href=\"includes/allocate_vehicle.inc.php?action=1&booking_no={$_GET['booking_no']}\">Accept</a>";
        echo "<a class=\"btn btn-sm btn-default\" href=\"includes/allocate_vehicle.inc.php?action=0&booking_no={$_GET['booking_no']}\">Decline</a>";
    }elseif ($details['booking_state']==1 && $details['flag']==1){
        echo "<a class=\"btn btn-sm btn-default\" href=\"includes/allocate_vehicle.inc.php?action=1&booking_no={$_GET['booking_no']}\">Reallocate Conductor</a>";
    }
?>
<!--<a class="btn btn-sm btn-default" href="includes/allocate_vehicle.inc.php?action=1&booking_no=--><?//= $_GET['booking_no']?><!--">Accept</a>-->
<!--<a class="btn btn-sm btn-default" href="includes/allocate_vehicle.inc.php?action=0&booking_no=--><?//= $_GET['booking_no']?><!--">Decline</a>-->

</body>

</html>