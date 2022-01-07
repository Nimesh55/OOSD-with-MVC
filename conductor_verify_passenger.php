<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$conductorview = new Conductor_View($_SESSION['user_Id']);


$state_query = 0;
if ($_GET["show"] == "false") {
} elseif ($_GET["show"] == "success") {
    $state_query = 1;
    $passDetails = $conductorview->verifyPassenger($_GET['passenger_id']);
    $error = "none";
} else {
    $state_query = 2;
    $error = $_GET["show"];
}

$username = $_SESSION["username"];

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

    <link rel="stylesheet" href="css/condcutor_verify_passenger.css">
    <title>Conductor Verify Passenger</title>
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
                            <li><a href="conductor_home.php">Home</a></li>
                            <li class="active"><a href="conductor_verify_passenger.php?show=false">Verify Passenger</a></li>
                            <li><a href="conductor_update_leave.php?error=none">Update Leave</a></li>
                            <li><a href="conductor_cancel_booking.php">Booking View</a></li>
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


    <div class="container mt-3" id="contanier-data">

        
        <div class="row">
            <div class="col-sm-1 p-3 bg-dark text-white"></div>
            <div class="col-sm-10 p-3 bg-dark text-white">

                <?php
                if ($state_query == 2) {
                    echo "<div class=\"alert alert-danger\"><strong>".$error."</strong></div>";
                }elseif($state_query == 1){
                    echo "<div class=\"alert alert-success\"><strong>"."Passenger pass Found!!"."</strong></div>";
                }
                ?>
            </div>
            <div class="col-sm-1 p-3 bg-dark text-white"></div>
            
        </div>

        <form action="includes/conductor_verify_passenger.inc.php" method="POST">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input name='passenger_id' type="text" class="form-control" placeholder="Search with Passenger ID" id="txtSearch" />
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </form>

        <br>

        <div>

            <div class="row">
                <div class="col-sm-2 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Name</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">
                    <p>:</p>
                </div>
                <div class="col-sm-6 p-3 bg-dark text-white">


                    <p> &emsp; <?php

                                if ($state_query == 0 || $state_query == 2) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo  $passDetails['passenger_name'];
                                }

                                ?></p>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-2 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Company</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">
                    <p>:</p>
                </div>
                <div class="col-sm-6 p-3 bg-dark text-white">

                    <p> &emsp; <?php


                                if ($state_query == 0 || $state_query == 2) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {

                                    echo $passDetails['company_name'];
                                }

                                ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Route(s)</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">
                    <p>:</p>
                </div>
                <div class="col-sm-6 p-3 bg-dark text-white">

                    <p> &emsp; <?php

                                if ($state_query == 0 || $state_query == 2) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo $passDetails['route'];
                                }

                                ?></p>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-2 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Time Period</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">:</div>
                <div class="col-sm-6 p-3 bg-dark text-white">

                    <p> &emsp; <?php

                                if ($state_query == 0 || $state_query == 2) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo $passDetails['time_period'];
                                }

                                ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Status</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">:</div>
                <div class="col-sm-6 p-3 bg-dark text-white">

                    <p> &emsp; <?php

                                if ($state_query == 0 || $state_query == 2) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    $state = $passDetails['state'];
                                    if($state=="Active")
                                        echo "<span class=\"label label-success\">$state</span>";
                                    else
                                        echo "<span class=\"label label-danger\">$state</span>";
                                }

                                ?></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>