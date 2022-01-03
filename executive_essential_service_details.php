<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();


if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$exec_view = new Executive_View();

$state_str = $exec_view->getEssentialServiceDetails($_SESSION['service_no']);

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
    <script src="js/buttons.js"></script>
    <title>Executive Essential Service Details</title>
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
                            <?php
                            if ($state_str == "Pending" || $state_str == "Non-Essential" || $state_str == "Removed") {
                                echo '<li class="disabled"><a>Pass Details</a></li>';
                                echo '<li class="disabled"><a>Booking Details</a></li>';
                                echo '<li class="disabled"><a>Passenger Details</a></li>';
                            } else {
                                echo '<li><a href="executive_pass_details.php">Pass Details</a></li>';
                                echo '<li><a href="executive_booking_details.php">Booking Details</a></li>';
                                echo '<li><a href="executive_passenger_details.php"> Passenger Details</a></li>';
                            }
                            ?>
                            <li class="active"><a href="executive_essential_service_details.php">Essential Service Details</a></li>
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

    <div class="container mt-3" style="float:left;">
        <h1> <?= $_SESSION['service_name']; ?> </h1>
        <div style=" margin-top:100px;">
            <div class="row">
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Essential Service Status</p>
                </div>
                <div class="col-sm-3 p-3 bg-primary text-white">
                    <p>: <?php echo $state_str; ?></p>
                </div>
                <div class="col-sm-3 p-3"></div>
            </div>


            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <?php if ($state_str == "Non-Essential") : ?>
                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3">
                        <a href="#" class="btn btn-info" onclick="clickView('1-<?php echo $_SESSION['service_no'] ?>','includes/executive_essential_service_details.inc.php')"> Request </a>
                    </div>

                    <div class="col-sm-3 p-3"></div>
                </div>
            <?php endif; ?>
            <?php if ($state_str == "Essential" || $state_str == "Pending") : ?>
                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3">
                        <a href="#" class="btn btn-info" onclick="clickView('0-<?php echo $_SESSION['service_no'] ?>','includes/executive_essential_service_details.inc.php')"> Remove </a>
                    </div>

                    <div class="col-sm-3 p-3"></div>
                </div>
            <?php endif; ?>



        </div>


</body>

</html>