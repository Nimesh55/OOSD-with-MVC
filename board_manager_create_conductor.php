<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

//if(!isset($_SESSION['user_Id'])){
//    header("Location: login.php");
//    return;
//}

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->getCreateConductorDetails();

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
    <title>Board Manager Create Conductor</title>
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
                        <li><a href="board_manager_conductor_details.php">Conductor Details</a></li>
                        <li class="active"><a href="board_manager_create_conductor.php">Create Conductor Account</a></li>
                        <li><a href="board_manager_allocate_vehicle.php">Allocate Vehicle</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_Id'] ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="change_password.php">Change Password</a></li>
                                <li><a href="logout.php">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">

    <form method="POST" class="form-horizontal" action="includes/signup.inc.php?account_type=1" style="width: 700px;">

        <div class="form-group">
            <label class="control-label col-sm-2" for="first_name">First Name:</label>
            <div class="col-sm-10">
                <input name="Firstname" type="text" class="form-control" id="first_name" placeholder="Enter First Name" ">
            </div>
        </div>

        <div class=" form-group">
            <label class="control-label col-sm-2" for="last_name">Last Name:</label>
            <div class="col-sm-10">
                <input name="Lastname" type="text" class="form-control" id="last_name" placeholder="Enter Last Name">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="address">Address:</label>
            <div class="col-sm-10">
                <input name="Address" type="text" class="form-control" id="address" placeholder="Enter Addres">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="telephone">Telephone:</label>
            <div class="col-sm-10">
                <input name="Telephone" type="text" class="form-control" id="telephone" placeholder="Enter Telephone">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="vehical_no">Vehicle No:</label>
            <div class="col-sm-10">
                <input name="vehicle_no" type="text" class="form-control" id="vehical_no" placeholder="Enter Vehicle No">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="conductor_id">NIC:</label>
            <div class="col-sm-10">
                <input name="ID" type="text" class="form-control" id="conductor_id" placeholder="Enter NIC number">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="bus_id">District:</label>
            <?php
            echo '<div class="col-sm-10">';
            echo '<select name="district" id="district" class="form-control">';

            $districts = $details['districtArray'];

            foreach ($districts as $district) {
                echo "<option value='" . $district['district_no'] . "' >" . $district['name'] . "</option>";
            }

            echo '</select>';
            echo '</div>';
            ?>

        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input name="email" type="text" class="form-control" placeholder="Enter email" id="email">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button name='submit' type="submit" class="btn btn-default" style="margin-right:15px;" ;">Creat Account</button>

            </div>
        </div>
    </form>

</div>
</body>

</html>