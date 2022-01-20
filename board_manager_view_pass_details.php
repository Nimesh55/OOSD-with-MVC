<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_POST['variablePass1'])) {
    header("Location: board_manager_pending_passes.php");
    return;
}

$pass_no = $_POST['variablePass1'];

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->viewPassDetails($pass_no);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/board_manager_pass_details_view.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">



    <title>Pass Details</title>
</head>

<body>
<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="navbar-header">
                    <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span
                                class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <strong class="navbar-brand">Safe Transit</strong>
                </div>

                <div class="navbar-collapse collapse" id="mobile_menu">
                    <ul class="nav navbar-nav">
                        <?php
                        if ($details['state'] == 1) {
                            echo '<li class="active"><a href="board_manager_pending_passes.php">Back</a></li>';
                        } else {
                            echo '<li class="active"><a href="board_manager_pass_details.php">Back</a></li>';
                        }
                        ?>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                        class="glyphicon glyphicon-user"></span> <?= $details['name'] ?> <span
                                        class="caret"></span></a>
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

<div class="container">
    <div class="heading">
        <h1> <?= $details['passenger_name'] . " :: Pass Details" ?> </h1>
    </div>
</div>

<div class="container ">


    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 wrapper">

            <div class="row">
                <div class="col-sm-5 p-3 field">
                    <p>Email Address</p>
                </div>
                <div class="col-sm-2 p-3">:</div>
                <div class="col-sm-5 p-3">
                    <p><?= $details['passenger_email'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 p-3 field">
                    <p>Passenger Name</p>
                </div>
                <div class="col-sm-2 p-3">:</div>
                <div class="col-sm-5 p-3">
                    <p><?= $details['passenger_name'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 p-3 field">
                    <p>Company</p>
                </div>
                <div class="col-sm-2 p-3">:</div>
                <div class="col-sm-5 p-3">
                    <p><?= $details['service_name'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 p-3 field">
                    <p>Date and Time</p>
                </div>
                <div class="col-sm-2 p-3">:</div>
                <div class="col-sm-5 p-3">
                    <p><?= $details['time_slot'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5 p-3 field">
                    <p>Reason</p>
                </div>
                <div class="col-sm-2 p-3">:</div>
                <div class="col-sm-5 p-3">
                    <p><?= $details['reason'] ?> </p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-8 p-3 field"></div>
                <div class="col-sm-4 p-3 field">
                    <?php
                    echo "<form class=\"form-horizontal\" action=\"board_manager_view_pass_details.php?pass_no={$pass_no}\"  method=\"POST\">";

                    if ($details['state'] == 1) {
                        echo "<a class=\"btn btn-primary\" href=\"includes/view_pass.inc.php?action=accept&pass_no={$pass_no}\">Accept</a>";
                        echo "<a class=\"btn btn-primary\" href=\"includes/view_pass.inc.php?action=decline&pass_no={$pass_no}\">Decline</a>";
                    } else {
                        echo "<a class=\"btn btn-primary\" href=\"includes/view_pass.inc.php?action=remove&pass_no={$pass_no}\">Remove</a>";
                    }
                    echo "</form>";

                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>


    </div>
</div>


</body>

</html>