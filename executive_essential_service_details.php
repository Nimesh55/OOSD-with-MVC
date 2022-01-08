<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();


if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}
$exec_view = new Executive_View();
$details = $exec_view->getHomeDetails();
$exec_control = new Executive_Controller();
$contactdetails = $exec_control->getExecutiveNumberFromService_no($details['service_number']);
$service_file = File_Controller::getInstance()->getFileDetails($exec_view->getServiceFileNo());

$state_str = $exec_view->getEssentialServiceDetails($_SESSION['service_no']);

//echo "<pre>";
//print_r($contactdetails);
//echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

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
    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="includes/executive_essential_service_details.inc.php">
    <div class="container">
        <h1> <?= $_SESSION['service_name']; ?> </h1>

        <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 wrapper">

                    <div class="row">
                        <div class="col-sm-5 p-3 field">
                            <p>Service Name</p>
                        </div>
                        <div class="col-sm-2 semicolen p-3">:</div>
                        <div class="col-sm-5 p-3 data">
                            <p><?= $details['service_name']?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 p-3 field">
                            <p>Essential Service Status</p>
                        </div>
                        <div class="col-sm-2 semicolen p-3">:</div>
                        <div class="col-sm-5 p-3 data">
                            <p><?= $state_str?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 p-3 field">
                            <p>Address</p>
                        </div>
                        <div class="col-sm-2 semicolen p-3">:</div>
                        <div class="col-sm-5 p-3 data">
                            <p><?= $contactdetails->getAddress();?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 p-3 field">
                            <p>Telephone NO</p>
                        </div>
                        <div class="col-sm-2 semicolen p-3">:</div>
                        <div class="col-sm-5 p-3 data">
                            <p><?= $contactdetails->getTelephone();?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 p-3 field">
                            <p>Attachments</p>
                        </div>
                        <div class="col-sm-2 semicolen p-3">:</div>
                        <div class="col-sm-5 p-3 data">
                            <?php if ($state_str == "Non-Essential") : ?>
                                <input type="file" id="file" name="file"/>
                            <?php elseif (($state_str == "Essential" || $state_str == "Pending") and $service_file==null) : ?>
                                <input name="view" type="text" class="form-control" id="view" readonly value="No file added">
                            <?php elseif(($state_str == "Essential" || $state_str == "Pending") and $service_file!=null) : ?>
                                <input name="view" type="text" class="form-control" id="view" readonly value="<?= $service_file['name'] ?>">
                                <button class="alert-success"><a href="includes/download.inc.php?name=<?php echo $service_file['name'];?>&fname=<?php echo $service_file['fname'] ?>">Download</a></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="ctrlbutton">
                        <?php if ($state_str == "Non-Essential") : ?>

                            <form action="includes/executive_essential_service_details.inc.php" method="POST">
                                <input type="hidden" name="variablePass1" value="1-<?php echo $_SESSION['service_no'] ?>">
                                <button class="btn btn-info btn-lg" type="submit" name="submit" value="Request" onclick="clickView('1-<?php echo $_SESSION['service_no'] ?>','includes/executive_essential_service_details.inc.php')" >Request</button>
                            </form>

                        <?php endif; ?>

                        <?php if ($state_str == "Essential" || $state_str == "Pending") : ?>
                            <a href="#" class="btn btn-info btn-lg" onclick="clickView('0-<?php echo $_SESSION['service_no'] ?>','executive_remove_essetial_service_verification.php')"> Remove </a>
                        <?php endif; ?>
                    </div>


                </div>
                <div class="col-lg-3"></div>

            </div>
        </div>

    </div>
    </form>


</body>

</html>