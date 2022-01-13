<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$viewobj = new Executive_View();
$detailsArray = $viewobj->getBookingViewDetails($_GET['booking_no']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/executive_booking_details_view.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Booking Details View</title>
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

    <!-- Details are shown here -->
    <form action="includes/executive_cancel_booking.inc.php" method="post">
        <div class="container mt-3">
            <h1 id="heading">Booking <?= $detailsArray['booking_no'] ?></h1>

            <div class="container">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 wrapper">

                        <div class="row">
                            <div class="col-sm-5"><p>Pickup District</p></div>
                            <div class="col-sm-2"><p>:</p></div>
                            <div class="col-sm-5"> <p><?= $detailsArray['pickup_district'] ?></p></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5"><p>Destination District</p></div>
                            <div class="col-sm-2"><p>:</p></div>
                            <div class="col-sm-5"><p><?= $detailsArray['destination_district'] ?></p></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5"><p>Start Date</p></div>
                            <div class="col-sm-2"><p>:</p></div>
                            <div class="col-sm-5"><p><?= $detailsArray['start_date'] ?></p></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5"><p>End Date</p></div>
                            <div class="col-sm-2"><p>:</p></div>
                            <div class="col-sm-5"><p><?= $detailsArray['end_date'] ?></p></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5"><p>State</p></div>
                            <div class="col-sm-2"><p>:</p></div>
                            <div class="col-sm-5"><?= $detailsArray['status'] ?></div>
                        </div>

                        <?php

                        if($detailsArray['state'] ==1){

                            echo '<div class="row">';
                            echo '<div class="col-sm-5"><p>Bus No</p></div>';
                            echo '<div class="col-sm-2"><p>:</p></div>';
                            echo '<div class="col-sm-5">'.$detailsArray['bus_no'].'</div>';
                            echo '</div>';

                        }

                        ?>
                        <div class="btn-group btn-group-lg">
                        <?php if($detailsArray['state'] <= 1):?>
                            <input class="btn btn-primary ctrlbutton" type="submit" value="Cancel Booking" name="cancel">
                        <?php endif; ?>
                        <input class="btn btn-primary ctrlbutton" type="submit" value="Exit" name="exit">
                        </div>
                        <input type="hidden" id="booking_no" name="booking_no" value="<?= $_GET['booking_no']?>">





                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </div>
    </form>

</body>
</html>