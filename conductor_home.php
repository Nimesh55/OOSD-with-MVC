<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['account_no'])) {
    header("Location: login.php");
    return;
}

$conductorview = new Conductor_View($_SESSION['user_Id']);
if ($conductorview->getConductorState()==1) {
    header("Location: includes/logout.inc.php");
}
$row = $conductorview->getDetails();


$row['user_id'] = $_SESSION['user_Id'];
$username = $row['first_name'] . " " . $row['last_name'];

$_SESSION["username"] = $username;

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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
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
                            <li class="active"><a href="conductor_home.php">Home</a></li>
                            <li><a href="conductor_verify_passenger.php?show=false">Verify Passenger</a></li>
                            <li><a href="conductor_update_leave.php?error=none">Update Leave</a></li>
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

    </div>

    <div class="container">
        
        <div class="heading">
            <h1> <?= $username; ?> </h1>
        </div>
        
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 wrapper">

                <div class="row">
                    <div class="col-sm-4 p-3 field">
                        <p>First Name</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-7 p-3">
                        <p><?= $row['first_name'] ?> </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 p-3 field">
                        <p>Last Name</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-7 p-3">
                        <p><?= $row['last_name'] ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 p-3 field">
                        <p>Address</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-7 p-3">
                        <p><?= $row['address'] ?> </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 p-3 field">
                        <p>NIC</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-7 p-3">
                        <p><?= $row['user_id'] ?> </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 p-3 field">
                        <p>Telephone NO</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-7 p-3">
                        <p><?= $row['telephone'] ?>  </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 p-3 field">
                        <p>Email</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-7 p-3">
                        <p><?= $row['email'] ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 p-3 field">
                        <p>District</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-7 p-3">
                        <p><?= $row['district_name'] ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 p-3 field">
                        <p>Bus No</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-7 p-3">
                        <p><?= $row['vehicle_no'] ?></p>
                    </div>
                </div>



            </div>
            <div class="col-lg-3"></div>

        </div>

    </div>
</body>

</html>