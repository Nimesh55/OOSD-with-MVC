<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}
$execObj = new Executive_View();
$passengers = $execObj->getPassengerAll($_SESSION['service_no']);

$pendingPassengers = array();
$appprovedPassengers = array();

foreach ($passengers as $passenger) {
    if ($passenger->getState() == 1) {
        array_push($pendingPassengers, $passenger);
    } elseif ($passenger->getState() == 2) {
        array_push($appprovedPassengers, $passenger);
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
    <link rel="stylesheet" href="css/executive_passenger_details.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/buttons.js"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <title>Executive Passenger Details</title>
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
                            <li><a href="executive_booking_details.php">Booking Details</a></li>
                            <li class="active"><a href="executive_passenger_details.php">Passenger Details</a></li>
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
    <div class="container mt-3">
        <div class="heading">
            <h1>Passenger Details</h1>
        </div>
        <div class="wrapper">
            <div class="addpassenger">
                <a href="#" class="btn btn-info" onclick="clickView('<? echo $_SESSION['service_no']?>','passenger_signup.php?src=1')">+Create Passenger Acoount</a>
            </div>
            <div class="row">

                <form action="executive_passenger_details.php" method="GET">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="input-group col-sm-4">
                            <input name="search" type="text" class="form-control" placeholder="Search with staff ID" id="txtSearch" />
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </form>
            </div>
            <br>

            <ul class="nav nav-tabs">
                <li class="active"><a href="#link1" data-toggle="tab">Pending</a></li>
                <li><a href="#link2" data-toggle="tab">Approved</a></li>
            </ul>

            <div class="tab-content">
                <div id="link1" class="tab-pane fade in active">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Passenger Name</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($pendingPassengers as $passenger) {
                                echo '<tr>';
                                echo '<td>' . $passenger->getStaffId() . '</td>';
                                echo '<td>' . $passenger->getFirstName() . ' ' . $passenger->getLastName() . '</td>';
                                echo '<td><a class="btn btn-sm btn-primary" href="#" onclick="clickView(' . $passenger->getPassengerNo() . ',\'executive_passenger_details_view_page.php\')" style="float: center"' . '>View</a></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <tr><?php if (empty($pendingPassengers) && isset($_GET['search']))
                            echo "No matches found"; ?></tr>
                </div>

                <div id="link2" class="tab-pane fade">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Passenger Name</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($appprovedPassengers as $passenger) {
                                echo '<tr>';
                                echo '<td>' . $passenger->getStaffId() . '</td>';
                                echo '<td>' . $passenger->getFirstName() . ' ' . $passenger->getLastName() . '</td>';
                                echo '<td><a class="btn btn-sm btn-primary" href="#" onclick="clickView(' . $passenger->getPassengerNo() . ',\'executive_passenger_details_view_page.php\')" style="float: center"' . '>View</a></td>';
                                echo '</tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                    <tr><?php if (empty($appprovedPassengers) && isset($_GET['search']))
                            echo "No matches found"; ?></tr>
                </div>

            </div>
        </div>


</body>

</html>