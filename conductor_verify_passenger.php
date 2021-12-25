<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$state_query = 0;

$conductorview = new Conductor_View($_SESSION['user_Id']);
$row = $conductorview->getDetails();
$row['user_id'] = $_SESSION['user_Id'];
$username = $row['first_name'] . " " . $row['last_name'];

//neeed to change
if ($_GET["show"]=='success') {
    $conductorview->setPassengerDetails($_GET["pName"]);

    $state_query = 1;
    $rowSecond  = $conductorview->getPassengerDetails();
    
}


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
                            <li class="active"><a href="conductor_verify_passenger.php">Verify Passenger</a></li>
                            <li><a href="conductor_update_leave.php">Update Leave</a></li>
                            <li><a href="conductor_cancel_booking.php">Cancel Booking</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $username ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="conductor_edit_profile.php">Edit profile</a></li>
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


        <form action="includes/conductor_verify_passenger.inc.php" method="POST">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input name='passenger_id' type="text" class="form-control" placeholder="Search with Passenger ID" id="txtSearch" />
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </form>

        <br>
        <br>

        <div>
            <div class="row">
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Name</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">
                    <p>:</p>
                </div>
                <div class="col-sm-6 p-3 bg-primary text-white">
                
                
                    <p> &emsp; <?php

                                if ($state_query == 0) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo  $rowSecond['passengerName'];
                                }

                                ?></p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>

            <div class="row">
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Company</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">
                    <p>:</p>
                </div>
                <div class="col-sm-6 p-3 bg-primary text-white">

                    <p> &emsp; <?php


                                if ($state_query == 0) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {

                                    echo 'Need to implement';
                                }

                                ?>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>

            <div class="row">
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Route(s)</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">
                    <p>:</p>
                </div>
                <div class="col-sm-6 p-3 bg-primary text-white">

                    <p> &emsp; <?php

                                if ($state_query == 0) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo 'Need to implement';
                                }

                                ?></p> 
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>

            <div class="row">
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Time Period</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">:</div>
                <div class="col-sm-6 p-3 bg-primary text-white">

                    <p> &emsp; <?php

                                if ($state_query == 0) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo 'Need to implement';
                                }

                                ?></p> 
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>
        </div>
    </div>

</body>

</html>