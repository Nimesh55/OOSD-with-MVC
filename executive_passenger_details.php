<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}
$execObj = new Executive_View();
$passengers = $execObj->getPassengerAll($_SESSION['service_no']);

$pendingPassengers = array();
$appprovedPassengers = array();

foreach ($passengers as $passenger){
    if($passenger->getState()==1){
        array_push($pendingPassengers,$passenger);
    }elseif ($passenger->getState()==2){
        array_push($appprovedPassengers,$passenger);
    }
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
    <script src="js/buttons.js"></script>
    <title>Executive Passenger Details</title>
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
                            <li><a href="executive_pass_details.php">Pass Details</a></li>
                            <li><a href="executive_booking_details.php">Booking Details</a></li>
                            <li class="active"><a href="executive_passenger_details.php">Passenger Details</a></li>
                            <li><a href="executive_essential_service_details.php">Essential Service Details</a></li>
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

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <form action="executive_passenger_details.php" method="GET">
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="input-group">
                    <input name="search" type="text" class="form-control" placeholder="Search with staff ID" id="txtSearch" />
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    if(empty($passengers))
        echo "No matches found";
    ?>

    <div class="container mt-3">

        <div style="margin-top:100px;">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#link1" data-toggle="tab">Pending</a></li>
            <li><a href="#link2" data-toggle="tab">Approved</a></li>
        </ul>

        <div class="tab-content">
            <div id="link1" class="tab-pane fade in active">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Staff ID</th>
                        <th scope="col">Passenger Name</th>
                        <th scope="col">View Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($pendingPassengers as $passenger){
                        echo '<tr>';
                        echo '<th scope="row">'.$passenger->getStaffId().'</th>';
                        echo '<td>'.$passenger->getFirstName() .' '.$passenger->getLastName().'</td>';
                        echo '<td><a class="btn btn-sm btn-default" href="#" onclick="clickView('.$passenger->getPassengerNo().',\'executive_passenger_details_view_page.php\')" style="float: center"'.'>View</a></td>';
                        echo '</tr>';
                    }
                    ?>

                    </tbody>
                </table>
            </div>

            <div id="link2" class="tab-pane fade">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Staff ID</th>
                        <th scope="col">Passenger Name</th>
                        <th scope="col">View Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($appprovedPassengers as $passenger){
                        echo '<tr>';
                        echo '<th scope="row">'.$passenger->getStaffId().'</th>';
                        echo '<td>'.$passenger->getFirstName() .' '.$passenger->getLastName().'</td>';
                        echo '<td><a class="btn btn-sm btn-default" href="#" onclick="clickView('.$passenger->getPassengerNo().',\'executive_passenger_details_view_page.php\')" style="float: center"'.'>View</a></td>';
                        echo '</tr>';
                    }
                    ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>


</body>
</html>