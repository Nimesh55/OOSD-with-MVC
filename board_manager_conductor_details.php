<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->getHomeDetails();

$state_query = 0;
if ($_GET["show"] == "success") {
    
    $state_query = 1;
    $data = $board_manager_view->getConductorDetails($_GET["conductor_id"]);
    $error="none";

}else{
    $error = $_GET["show"];
}


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

    <link rel="stylesheet" href="css/board_manager_conductor_details.css">
    <title>Conductor Details</title>
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
                            <li><a href="board_manager_home.php">Home</a></li>
                            <li><a href="board_manager_pending_passes.php">Pending Passes</a></li>
                            <li><a href="board_manager_pass_details.php">Pass Details</a></li>
                            <li class="active"><a href="board_manager_conductor_details.php?show=none">Conductor Details</a></li>
                            <li><a href="board_manager_create_conductor.php">Create Conductor Account</a></li>
                            <li><a href="board_manager_allocate_vehicle.php">Allocate Vehicle</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= $details['name']  ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="change_password.php">Change Password</a></li>
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
            <div class="col-lg-12">
                <p><?php
                if($error!='none')
                    echo $error; ?>
                </p>
            </div>
        </div>

        <form action="includes/board_mananger_conductor_details.inc.php" method="POST">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input name='conductor_id' type="text" class="form-control" placeholder="Search with Conductor ID" id="txtSearch" />
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
                                    echo  $data['fname'] . " " . $data['lname'];
                                }

                                ?></p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>

            <div class="row">
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>District</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">
                    <p>:</p>
                </div>
                <div class="col-sm-6 p-3 bg-primary text-white">

                    <p> &emsp; <?php


                                if ($state_query == 0) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {

                                    echo $data["district"];;
                                }

                                ?></p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>

            <div class="row">
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Vehicle No</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">
                    <p>:</p>
                </div>
                <div class="col-sm-6 p-3 bg-primary text-white">

                    <p> &emsp; <?php

                                if ($state_query == 0) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo $data["vehicle_no"];
                                }

                                ?></p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>

            <div class="row">
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Telephone</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">:</div>
                <div class="col-sm-6 p-3 bg-primary text-white">

                    <p> &emsp; <?php

                                if ($state_query == 0) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo $data["telephone_no"];
                                }

                                ?></p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>

            <div class="row">
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Status</p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white">:</div>
                <div class="col-sm-6 p-3 bg-primary text-white">

                    <p> &emsp; <?php

                                if ($state_query == 0) {
                                    echo "No Value";
                                } elseif ($state_query == 1) {
                                    echo $data["status"];
                                }

                                ?></p>
                </div>
                <div class="col-sm-1 p-3 bg-dark text-white"></div>
            </div>
        </div>
    </div>

</body>

</html>