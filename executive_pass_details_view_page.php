<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}
if (!isset($_POST['pass_no']) and !isset($_SESSION['pass_no'])) {
    header("Location: executive_home.php");
    return;
}

if(isset($_SESSION['link']))
    unset($_SESSION['link']);

if(!isset($_POST['pass_no'])){
    $_POST['pass_no'] = $_SESSION['pass_no'];
    unset($_SESSION['pass_no']);
}

$pass_no = $_POST['pass_no'];
$execObj = new Executive_View();
$pass = $execObj->getPassDetailsViewDetails($pass_no); // ## Get Pass Object 
$passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($pass['passenger_no']);
$pass_file = File_Controller::getInstance()->getFileDetails($pass['file_no']);
$details = array("name" => $passenger->getFirstName().' '.$passenger->getLastName(), 'route' => $pass['route'], 'time_slot' => $pass['time_slot'], 'reason' => $pass['reason'], 'status' => $pass['status']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/executive_passenger_details_view_page.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/buttons.js"></script>
    <title>Executive Pass Details</title>
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
                            <li class="active"><a href="executive_pass_details.php">Pass Details</a></li>
                            <li><a href="executive_booking_details.php">Booking Details</a></li>
                            <li><a href="executive_passenger_details.php">Passenger Details</a></li>
                            <li><a href="executive_essential_service_details.php">Essential Service Details</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= $_SESSION['exec_name'] ?> <span class="caret"></span></a>
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

    <form action="executive_pass_details_view_page.php" method="GET">

        <!-- Details of A single pass -->

        <div class="container">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 wrapper">

                    <div class="row">
                        <div class="col-sm-5"><p>Requested by</p></div>
                        <div class="col-sm-2"><p>:</p></div>
                        <div class="col-sm-5"><p><?php echo $details['name']; ?>
                        </p></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5"><p>Route</p></div>
                        <div class="col-sm-2"><p>:</p></div>
                        <div class="col-sm-5"><p><?= $details['route'] ?></p></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5"><p>Time Slote</p></div>
                        <div class="col-sm-2"><p>:</p></div>
                        <div class="col-sm-5"><p><?= $details['time_slot'] ?></p></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5"><p>Reason</p></div>
                        <div class="col-sm-2"><p>:</p></div>
                        <div class="col-sm-5"><p><?= $details['reason'] ?></p></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5"><p>Status</p></div>
                        <div class="col-sm-2"><p>:</p></div>
                        <div class="col-sm-5"><p><?= $details['status'] ?></p></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5"><p>Attachments</p></div>
                        <div class="col-sm-2"><p>:</p></div>
                        <div class="col-sm-5">
                            <?php
                            if($pass_file==null):
                                ?>
                                <p>No files added </p>
                            <?php
                            else:
                                ?>
                                <a class="btn btn-primary" href="includes/download.inc.php?name=<?php echo $pass_file['name'];?>&fname=<?php echo $pass_file['fname'] ?>">Download</a>
                            <?php
                            endif;
                            $_SESSION['link']="../executive_pass_details_view_page.php";
                            $_SESSION['pass_no'] = $_POST['pass_no'];
                            ?>
                        </div>
                    </div>
                    <br>
                    <br>
                    <?php if(strcmp($details['status'],"Pending")==0): ?>
                        <div class="btn-group btn-group-lg">
                            <a href="#" class="btn btn-primary ctrlbutton" onclick="clickView('1-<?php echo $pass_no ?>','includes/executive_pass_view.inc.php')"> Accept </a>
                            <a href="#" class="btn btn-primary ctrlbutton" onclick="clickView('4-<?php echo $pass_no ?>','includes/executive_pass_view.inc.php')"> Decline </a>
                        </div>
                    <?php endif;?>

                </div>
                <div class="col-sm-3"></div>
            </div>
            <br>
            <br>



        </div>

    </form>

</body>

</html>