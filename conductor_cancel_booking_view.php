<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['account_no'])) {
    header("Location: login.php");
    return;
}

$conductorview = new Conductor_View($_SESSION['user_Id']);
if ($conductorview->getConductorState()==1) {
    header("Location: includes/logout.inc.php");
}

$username = $_SESSION["username"];

$bookingNo = $_GET['booking_no'];

$bookingDetails = $conductorview->showBookingInfo($bookingNo);

$state_query = 0;
if ($_GET["error"] != 'none') {
    $error = $_GET["error"];
    $state_query = 1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/conductor_cancel_booking_view.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <title>Conductor || Booking Details</title>
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
                            <li class=""><a href="conductor_cancel_booking.php">Back</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $username ?> <span class="caret"></span></a>
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

    <div class="container">
        <div class="heading">
            <h1>Booking No. <?php echo $bookingNo ?> Details</h1>
        </div>
    </div>


    <div class="container mt-3" id="contanier-data">
        <div>
            <div class="row" id="error">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-8 p-4">
                    <?php if ($state_query == 1) {
                        echo "<div class=\"alert alert-success\"><strong>" . $error . "</strong></div>";
                    } ?>
                </div>
                <div class="col-sm-2 p-3"></div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Booking No</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white">
                    <p><?= $bookingDetails['booking_no'] ?> </p>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Service Name</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white">
                    <p><?= $bookingDetails['service_name']  ?></p>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Start Date and Time</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white">
                    <p><?= $bookingDetails['start_date'] . " From " . $bookingDetails['start_time']   ?> </p>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>End Date and Time</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white">
                    <p><?= $bookingDetails['end_date'] . " From " . $bookingDetails['end_time'] ?> </p>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Pickup District</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white">
                    <p><?= $bookingDetails['pickup_district'] ?> </p>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Pickup Location</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white link">
                    <p><a href="<?= $bookingDetails['pickup_location'] ?>" target="_blank">View pickup</a> </p>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Destination District</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white">
                    <p><?= $bookingDetails['destination_district'] ?> </p>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>
            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Destination Location</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white link">
                    <p><a href="<?= $bookingDetails['destination_location'] ?>" target="_blank">View destination</a> </p>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-2"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Passenger Count</p>
                </div>
                <div class="col-sm-2 p-2">:</div>
                <div class="col-sm-4 p-4 bg-dark text-white">
                    <p><?= $bookingDetails['passenger_count'] ?> </p>
                </div>
                <div class="col-sm-2 p-3"></div>
            </div>

            <br>
            <br>

            <?php if ($bookingDetails['flag'] == 0) : ?>
                <div class="ctrlbtn">
                    <a class="btn btn-primary" href="includes/condcutor_cancel_booking_totally.inc.php?booking_no=<?php echo $bookingNo ?>">Cancel Booking</a>
                </div>

            <?php endif; ?>



        </div>

    </div>

</body>