<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->getSelectVehicleDetails($_GET['booking_no'], $_GET['pickup']);

$available_vehicles = $details['vehicle_list'];
$vehicle_cnt = count($available_vehicles);

if ($vehicle_cnt == 0) {
    $_SESSION['error'] = "No vehicles available";
}
$bookingNo = $_GET['booking_no'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/board_manager_allocate_vehicle_select.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/buttons.js"></script>
    <title>Select the Vehicle</title>
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
                            <li><a href="board_manager_allocate_vehicle_view.php?booking_no=<?= $_GET['booking_no'] ?>">Back</a></li>

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
        <!--Show error in $_SESSION['error'] here-->
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
        }
        ?>


        <div class="list-group">
            <div class="heading">
                <h2>Select a available vehicle</h2>
            </div>
            <br>


                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Vehicle Number</th>
                            <th>Available Seats</th>
                            <th>Allocate</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 0;
                        foreach ($available_vehicles as $cur) :
                            $row++;
                        ?>
                            <tr>

                                <td><?php echo $row; ?></td>
                                <td><?php echo $cur->getVehicleNo(); ?></td>
                                <td><?php echo $cur->getSeatNo(); ?></td>
                                <td>
                                    <a href="#" class="btn btn-info" onclick="clickView('2-<?php echo $bookingNo; ?>-<?php echo $cur->getConductorNo() ;?>','includes/allocate_vehicle.inc.php')"> Allocate </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

        </div>
    </div>
</body>

</html>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);
?>