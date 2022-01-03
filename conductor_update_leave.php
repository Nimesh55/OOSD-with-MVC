<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['account_no'])) {
    header("Location: login.php");
    return;
}

$conductorview = new Conductor_View($_SESSION['user_Id']);
$row = $conductorview->getDetails();
$username = $_SESSION["username"];

$state_query = 0;
if ($_GET["error"] != "none") {
    $state_query = 1;
    $error = $_GET["error"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/conductor_update_leave.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Conductor || Update Leave</title>
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
                            <li><a href="conductor_verify_passenger.php?show=false">Verify Passenger</a></li>
                            <li class="active"><a href="conductor_update_leave.php?error=none">Update Leave</a></li>
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
            <?php if ($state_query == 1) {
                echo "<p id=\"error\">{$error}</p>";
            } ?>
        </div>

        <br>;

        <form action="includes/conductor_update_leave.inc.php" method="POST">
            <div class="row">
                <div class="col-lg-3">
                    <label class="control-label col-sm-2" for="leave_date">Leave Date:</label>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="leave_date" name="leave_date">
                        </div>
                    </div>

                </div>
                <div class="col-lg-3"></div>

                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>


</body>