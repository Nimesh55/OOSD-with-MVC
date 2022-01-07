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
$leaves = $conductorview->getGrantedLeave($_SESSION['account_no']);

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

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-5 wrapper">
                <h3>Granted Leaves</h3>
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Leave No</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        foreach($leaves as $leave){
                            echo "<tr>";
                            echo "<td>{$leave['leave_no']}</td>";
                            echo "<td>{$leave['date']}</td>";
                            echo "</tr>";
                        }

                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5 wrapper">
                <h3>Request New Leave</h3>
                <br>
                <div class="row">
                    <?php if ($state_query == 1) {
                        if($error == "Leave Granted!!")
                            echo "<p class=\"alert alert-success\" id='error'>$error</p>";
                        else
                        echo "<p class=\"alert alert-danger\" id='error'>$error</p>";
                    } ?>
                </div>
                <br>
                <form class="form-horizontal" action="includes/conductor_update_leave.inc.php" method="POST" role="form">
                    <div class="form-group">
                        <label for="leave_date" class="col-sm-3 control-label">Leave Date:</label>
                        <div class="col-sm-6">
                            <input name="leave_date" type="date" class="form-control" id="leave_date" value="">


                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>



</body>