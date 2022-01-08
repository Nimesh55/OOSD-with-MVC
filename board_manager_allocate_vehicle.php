<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$board_manager_view = new Board_Manager_View();

if (isset($_GET['district_no'])) {
    $details = $board_manager_view->getBookingsDetails($_GET['district_no']);
} else {
    $details = $board_manager_view->getBookingsDetails(null);
}

$districts = $details['districts'];
$bookings = $details['bookingsArray'];

$pending_bookings = array();
$approved_bookings = array();
$declined_bookings = array();
$cancelled_bookings = array();

foreach ($bookings as $booking) {
    if ($booking->getState() == 0) {
        array_push($pending_bookings, $booking);
    } elseif ($booking->getState() == 1) {
        if ($booking->getflag() == 0) {
            array_push($approved_bookings, $booking);
        } else {
            array_push($cancelled_bookings, $booking);
        }
    } else {
        array_push($declined_bookings, $booking);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/board_manager_allocate_vehicle.css">
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
                            <li><a href="board_manager_home.php">Home</a></li>
                            <li><a href="board_manager_pending_passes.php">Pending Passes</a></li>
                            <li><a href="board_manager_pass_details.php">Pass Details</a></li>
                            <li><a href="board_manager_conductor_details.php?show=none">Conductor Details</a></li>
                            <li><a href="board_manager_create_conductor.php">Create Conductor Account</a></li>
                            <li class="active"><a href="board_manager_allocate_vehicle.php">Allocate Vehicle</a></li>
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
    </div>

    <div class="container">
        <form action="board_manager_allocate_vehicle.php" method="GET">
            <div class="row">
                <!--        <div class="col-xs-6 col-md-4">-->
                <div class="input-group">


                    <select name="district_no" id="district" class="form-control">


                        <option value="0">All</option>
                        <?php


                        foreach ($districts as $district) {

                            if (isset($_GET['district_no']) and $_GET['district_no'] == $district['district_no']) {
                                echo "<option value=\"{$district['district_no']}\" selected>{$district['name']}</option>";
                            } else {
                                echo "<option value=\"{$district['district_no']}\">{$district['name']}</option>";
                            }
                        }
                        ?>
                    </select>

                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#pending" data-toggle="tab">Pending</a></li>
            <li><a href="#approved" data-toggle="tab">Approved</a></li>
            <li><a href="#expired" data-toggle="tab">Expired/Declined</a></li>
            <li><a href="#declined" data-toggle="tab">Cancelled Bookings</a></li>
        </ul>


        <div class="tab-content">
            <div id="pending" class="tab-pane fade in active">

                <div class="List of info">
                    <ul class="list-group action-list-group">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Booking No.</th>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Passenger Count</th>
                                    <th scope="col">View Details</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = 0;
                                foreach ($pending_bookings as $booking) :
                                    $service = EssentialServiceTracker::getInstance()->getServiceName($booking->getServiceNo());
                                    $passenger_cnt = $booking->getPassengerCount();
                                    $row++;
                                ?>
                                    <tr>

                                        <th scope="row"><?= $row ?></th>
                                        <td><?= $service ?></td>
                                        <td><?= $passenger_cnt ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="board_manager_allocate_vehicle_view.php?booking_no=<?= $booking->getBookingNo() ?>">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </ul>
                </div>

            </div>

            <div id="approved" class="tab-pane fade">

                <div class="List of info">
                    <ul class="list-group action-list-group">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Booking Number</th>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Passenger Count</th>
                                    <th scope="col">View Details</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = 0;
                                foreach ($approved_bookings as $booking) :
                                    $service = EssentialServiceTracker::getInstance()->getServiceName($booking->getServiceNo());
                                    $passenger_cnt = $booking->getPassengerCount();
                                    $row++;
                                ?>
                                    <tr>

                                        <th scope="row"><?= $row ?></th>
                                        <td><?= $service ?></td>
                                        <td><?= $passenger_cnt ?></td>
                                        <td>
                                            <a class="btn btn-info" href="board_manager_allocate_vehicle_view.php?booking_no=<?= $booking->getBookingNo() ?>">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </ul>
                </div>

            </div>

            <div id="expired" class="tab-pane fade">

                <div class="List of info">
                    <ul class="list-group action-list-group">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Booking Number</th>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Passenger Count</th>
                                    <th scope="col">View Details</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = 0;
                                foreach ($declined_bookings as $booking) :
                                    $service = EssentialServiceTracker::getInstance()->getServiceName($booking->getServiceNo());
                                    $passenger_cnt = $booking->getPassengerCount();
                                    $row++;
                                ?>
                                    <tr>

                                        <th scope="row"><?= $row ?></th>
                                        <td><?= $service ?></td>
                                        <td><?= $passenger_cnt ?></td>
                                        <td>
                                            <a class="btn btn-info" href="board_manager_allocate_vehicle_view.php?booking_no=<?= $booking->getBookingNo() ?>">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </ul>
                </div>

            </div>

            <div id="declined" class="tab-pane fade">

                <div class="List of info">
                    <ul class="list-group action-list-group">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Booking Number</th>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Passenger Count</th>
                                    <th scope="col">View Details</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = 0;
                                foreach ($cancelled_bookings as $booking) :
                                    $service = EssentialServiceTracker::getInstance()->getServiceName($booking->getServiceNo());
                                    $passenger_cnt = $booking->getPassengerCount();
                                    $row++;
                                ?>
                                    <tr>

                                        <th scope="row"><?= $row ?></th>
                                        <td><?= $service ?></td>
                                        <td><?= $passenger_cnt ?></td>
                                        <td>
                                            <a class="btn btn-info" href="board_manager_allocate_vehicle_view.php?booking_no=<?= $booking->getBookingNo() ?>">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </ul>
                </div>

            </div>
        </div>
    </div>


</body>

</html>