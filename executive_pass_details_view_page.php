<?php
require 'pdo.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    return;
}

if (isset($_GET['pass_no'])) {
    $pass_no = $_GET['pass_no'];
}

$data_pass = $pdo->query("SELECT * FROM pass WHERE pass_no='{$pass_no}' ");
$details_pass = $data_pass->fetch(PDO::FETCH_ASSOC);

$passenger_no = $details_pass["passenger_no"];
$route = $details_pass["bus_route"];
$reason = $details_pass["reason"];
$start = $details_pass["start_date"];
$end = $details_pass["end_date"];
$status = $details_pass["state"];

$data_passenger = $pdo->query("SELECT * FROM passenger WHERE passenger_no ='{$passenger_no}' ");
$details_passenger = $data_passenger->fetch(PDO::FETCH_ASSOC);

$requested_by = $details_passenger["first_name"] . " " . $details_passenger["last_name"];
?>

<?php

if (isset($_GET['pass_no']) && isset($_GET['action']) && $_GET['action']=='accept') {
    $pass_no = $_GET['pass_no'];
    $sql = "UPDATE pass SET state = :state WHERE pass_no = :pass_no";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':state' => 1,
        ':pass_no' => $pass_no
    ));

    header("Location: executive_pass_details.php");
} 

if (isset($_GET['pass_no']) && isset($_GET['action']) && $_GET['action']=='decline') {
    $pass_no = $_GET['pass_no'];
    $sql = "UPDATE pass SET state = :state WHERE pass_no = :pass_no";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':state' => 3,
        ':pass_no' => $pass_no
    ));

    header("Location: executive_pass_details.php");
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
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'] ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="executive_edit_profile.php">Edit profile</a></li>
                                    <li><a href="logout.php">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="executive_pass_details_view_page.php" method="GET">
        <input type="hidden" name="pass_no" value="<?php echo $pass_no ?>">
        <!-- Details of A single pass -->
        <div class="container mt-3">

            <div style="margin-top:100px;">
                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Requested by</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?php echo $requested_by ?></p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Route</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?php echo $route ?></p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Time Slot</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?php echo $start . " to " . $end ?></p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Reason</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?php echo $reason ?></p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Status</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?php
                                if ($status == 0) {
                                    echo "Pending";
                                } elseif ($status == 1) {
                                    echo "Accepted-1";
                                } elseif ($status == 2) {
                                    echo "Accepted-2";
                                } elseif ($status == 3) {
                                    echo "Declined";
                                }
                                ?>
                        </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <br>
                <br>

                <!-- accept and decline buttons -->
                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3">
                        <a href="executive_pass_details_view_page.php?pass_no=<?php echo $pass_no; ?>&action=accept" class="btn btn-info"> Accept </a>
                    </div>
                    <div class="col-sm-3 p-3">
                        <a href="executive_pass_details_view_page.php?pass_no=<?php echo $pass_no; ?>&action=decline" class="btn btn-info"> Decline </a>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>


            </div>
        </div>

    </form>

</body>

</html>