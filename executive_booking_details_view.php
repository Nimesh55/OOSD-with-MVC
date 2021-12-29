<?php

require_once "pdo.php";
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    return;
}

$stmt = $pdo->query("SELECT * FROM Booking  WHERE booking_no = {$_GET['booking_no']}");
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt1 = $pdo->query("SELECT name FROM District WHERE district_no = {$booking['pickup_district']} ");
$stmt2 = $pdo->query("SELECT name FROM District WHERE district_no = {$booking['destination_district']} ");

$booing_name = "Booking ".$booking['booking_no'];
$pick = $stmt1->fetchColumn();
$dest = $stmt2->fetchColumn();
$st_date = $booking['start_date'];
$en_date = $booking['end_date'];
$stat = $booking['state'] ==0? 'Pending':'Approved';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'] ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="executive_edit_profile.php">Edit profile</a></li>
                                    <li><a href="logout.php">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details are shown here -->
    <form action="executive_booking_details.php" method="post">
        <div class="container mt-3">
            <h1><?= $booing_name ?></h1>

            <div style="margin-top:100px;">
                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Pickup District</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $pick ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Destination District</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $dest ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Start date</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $st_date ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>End date</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $en_date ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>State</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $stat ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <?php

                    if($booking['state'] ==1){
                        echo '<div class="row">';
                        echo '<div class="col-sm-3 p-3"></div>';
                        echo '<div class="col-sm-3 p-3 bg-dark text-white">';
                        echo '<p>Bus no</p>';
                        echo '</div>';
                        echo '<div class="col-sm-3 p-3 bg-primary text-white">';

                        $stmt3 = $pdo->query("SELECT vehicle_no FROM Conductor WHERE conductor_no = {$booking['booked_conductor_no']} ");
                        $bus_no = $stmt3->fetchColumn();
                        echo '<p>: '.$bus_no.' </p>';

                        echo '</div>';
                        echo '<div class="col-sm-3 p-3"></div>';
                        echo '</div>';

                    }

                ?>

                <input class="btn btn-default" type="submit" value="Exit" name="exit" style="color:blue;position:relative;
                            left:65%;margin-top:10px; width:10%">

            </div>
        </div>
    </form>

</body>
</html>