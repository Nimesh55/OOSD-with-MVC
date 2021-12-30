<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}
if (!isset($_POST['variablePass1'])) {
    header("Location: executive_passenger_details.php");
    return;
}
$passenger_no = $_POST['variablePass1'];
$passenger = Passenger_Tracker::getInstance()->createPassenger($passenger_no);
$row = array('state' => $passenger->getState(), 'first_name' => $passenger_no, 'last_name' => $passenger->getLastName(), 'address' => $passenger->getAddress(), 'staff_id' => $passenger->getStaffId(), 'user_id' => $passenger->getUserId(), 'telephone' => $passenger->getTelephone(), 'email' => $passenger->getEmail());
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

    <!-- Details are shown here -->
    <form method="post">
        <div class="container mt-3">

            <div style="margin-top:100px;">
                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Name</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $row['first_name'] . ' ' . $row['last_name'] ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Address</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $row['address'] ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Staff ID</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $row['staff_id'] ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>NIC</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $row['user_id'] ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Telephone No.</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $row['telephone'] ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Email</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?= $row['email'] ?> </p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <?php
                if ($row['state'] == 1) {
                    echo '<input class="btn btn-default" type="submit" value="Accept" name="accept" style="color:blue;position:relative;
                                left:65%;margin-top:10px; width:10%">';
                    echo '<input class="btn btn-default" type="submit" value="Decline" name="decline" style="color:blue;position:relative;
                                left:65%;margin-top:10px; width:10%">';
                } elseif ($row['state'] == 2) {
                    echo '<input class="btn btn-default" type="submit" value="Remove" name="decline" style="color:blue;position:relative;
                        left:65%;margin-top:10px; width:10%">';
                }
                ?>

                <input class="btn btn-default" type="submit" value="Exit" name="exit" style="color:blue;position:relative;
                            left:65%;margin-top:10px; width:10%">

            </div>
        </div>
    </form>

</body>

</html>