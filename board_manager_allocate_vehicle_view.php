<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->getBookingViewDetails($_GET['booking_no']);
$bookingNo = $_GET['booking_no'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/board_manager_allocate_vehicle_view.css">
<!--    <link rel="stylesheet" href="css/executive_pass_details.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/buttons.js"></script>
    <title>Board Manager Allocate Vehicle</title>
</head>

<body>
<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="navbar-header">
                    <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span
                                class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <strong class="navbar-brand">Safe Transit</strong>
                </div>

                <div class="navbar-collapse collapse" id="mobile_menu">
                    <ul class="nav navbar-nav">
                        <li><a href="board_manager_allocate_vehicle.php">Back</a></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                        class="glyphicon glyphicon-user"></span> <?= $details['name'] ?> <span
                                        class="caret"></span></a>
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

<div class="container mt-3">

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 wrapper">

            <div class="row">
                <div class="col-sm-5 field">
                    <p>Service</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['service_name'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>Reason</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['reason'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>Pickup District</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['pickup_district'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>Pickup Location</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5 p-3">
                    <a href="<?= $details['pickup_location'] ?>" target="_blank">View pickup</a>
                </div>
            </div>

            <!-- nxj -->
            <div class="row">
                <div class="col-sm-5 field">
                    <p>Destination District</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['destination_district'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>Destination Location</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5 p-3">
                    <a href="<?= $details['destination_location'] ?>" target="_blank">View destination</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>Start Date</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['start_date'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>End Date</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['end_date'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>Start Time</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['start_time'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>End Time</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['end_time'] ?></p>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 field">
                    <p>No of Passengers</p>
                </div>
                <div class="col-sm-2">:</div>
                <div class="col-sm-5">
                    <p><?= $details['passenger_count'] ?></p>

                </div>
            </div>
            <?php
            if ($details['booking_state'] == 1) {
                echo "<div class=\"row\">";
                echo "<div class=\"col-sm-5 field\"><p>Vehicle No</p></div>";
                echo "<div class=\"col-sm-2 \">:</div>";
                echo "<div class=\"col-sm-5 \"><p>" . $details['booked_vehicle'] . "</p></div>";
                echo "</div>";
            }
            ?>

            <div class="buttons">
                <div class="btn-group btn-group-lg">
                    <?php
                    if ($details['booking_state'] == 0) {
                        echo "<a class=\"btn btn-sm btn-primary ctrlbutton\" href=\"#\" onclick = \"clickView('1-".$bookingNo."-".$details['pickup_district_no']."','includes/allocate_vehicle.inc.php')\">Approve</a>";
                        echo "<a class=\"btn btn-sm btn-danger ctrlbutton\" href=\"#\" onclick = \"clickView('0-".$bookingNo."-x','includes/allocate_vehicle.inc.php')\">Decline</a>";
                    } elseif ($details['booking_state'] == 1 && $details['flag'] == 1) {
                        echo "<a class=\"btn btn-sm btn-primary ctrlbutton\" href=\"#\" onclick = \"clickView('1-".$bookingNo."-x','includes/allocate_vehicle.inc.php')\">Reallocate Conductor</a>";
                    }
                    ?>

                </div>
            </div>


        </div>
    </div>

</body>

</html>