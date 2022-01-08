<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$viewobj = new Executive_View();
$detailsArray = $viewobj->getBookingDetailsDetails();
$bookings = $detailsArray['service_bookings'];

$pendingBookingsArray = array();
$acceptedBookingsArray = array();
$pastBookingsArray = array();

foreach ($bookings as $booking) { // Seperated the Bookings in to 3 array for 3 tabs to display easily
    if ($booking->getState() == 0) {
        array_push($pendingBookingsArray, $booking);
    } elseif ($booking->getState() == 1) {
        array_push($acceptedBookingsArray, $booking);
    } else {
        array_push($pastBookingsArray, $booking);
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/executive_pass_details.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Executive Booking Details</title>
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
                            <li><a href="executive_home.php">Home</a></li>
                            <li><a href="executive_pass_details.php">Pass Details</a></li>
                            <li class="active"><a href="executive_booking_details.php">Booking Details</a></li>
                            <li><a href="executive_passenger_details.php">Passenger Details</a></li>
                            <li><a href="executive_essential_service_details.php">Essential Service Details</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['exec_name'] ?> <span class="caret"></span></a>
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


<!--    set booking cancel done status show here-->


    <div class="container">
        <div class="wrapper">
        <div class="row addpass">
        <a href="executive_request_booking.php" class="btn btn-info addnewpass" name="request" style=""> Request Booking </a>
        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#link1" data-toggle="tab">Pending</a></li>
            <li><a href="#link2" data-toggle="tab">Approved</a></li>
            <li><a href="#link3" data-toggle="tab">Booking History</a></li>
        </ul>

        <div class="tab-content">
            <div id="link1" class="tab-pane fade in active">
                <form action="executive_booking_details_view.php" method="POST">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Booking Number</th>
                            <th scope="col">View Details</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach($pendingBookingsArray as $booking){
                            $booking_no = $booking->getBookingNo();
                            echo '<tr>';
                            echo '<th scope="row">Booking '.$booking_no.'</th>';
                            echo '<td><a href="executive_booking_details_view.php?booking_no='.$booking_no.'" class="btn btn-info"> View </a></td>';
                            echo '</tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </form>
            </div>

            <div id="link2" class="tab-pane fade">
                <form action="executive_booking_details_view.php" method="POST">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Booking Number</th>
                            <th scope="col">View Details</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach($acceptedBookingsArray as $booking){
                            $booking_no = $booking->getBookingNo();
                            echo '<tr>';
                            echo '<th scope="row">Booking '.$booking_no.'</th>';
                            echo '<td><a href="executive_booking_details_view.php?booking_no='.$booking_no.'" class="btn btn-info"> View </a></td>';
                            echo '</tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </form>
            </div>

            <div id="link3" class="tab-pane fade">
                <form action="executive_booking_details_view.php" method="POST">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Booking Number</th>
                            <th scope="col">View Details</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach($pastBookingsArray as $booking){
                            $booking_no = $booking->getBookingNo();
                            echo '<tr>';
                            echo '<th scope="row">Booking '.$booking_no.'</th>';
                            echo '<td><a href="executive_booking_details_view.php?booking_no='.$booking_no.'" class="btn btn-info"> View </a></td>';
                            echo '</tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        </div>
    </div>

</body>

</html>

<?php
unset($_SESSION['success']);
?>