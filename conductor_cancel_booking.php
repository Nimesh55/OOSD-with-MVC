<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['account_no'])) {
    header("Location: login.php");
    return;
}

$conductorview = new Conductor_View($_SESSION['user_Id']);
$username = $_SESSION["username"];

$bookingRecords = $conductorview->showBookings($_SESSION['account_no']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/conductor_cancel_booking.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Conductor Home</title>
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
                            <li><a href="conductor_update_leave.php?error=none">Update Leave</a></li>
                            <li class="active"><a href="conductor_cancel_booking.php">Booking View</a></li>
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
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Booking Number</th>
                    <th scope="col">Click Here to View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    while ($i <= count($bookingRecords)) {
                        echo "<tr>";
                        $bookingNo = $bookingRecords[$i-1]->getBookingNo();
                        echo "<th scope=\"row\">$i</th>";
                        echo "<td>"."Booking No. " . $bookingNo . "&nbsp;&nbsp;&nbsp;"."</td>";
                        echo "<td><a class=\"btn btn-sm btn-default\" id=\"\" href=\"conductor_cancel_booking_view.php?booking_no={$bookingNo}&error=none\">View</a></td>";
                        echo "</tr>";

                        $i++;
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>