<?php
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
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


    <div class="container mt-3">

        <div style="margin-top:100px;">
            <!-- Create new account -->
            <a class="btn btn-sm btn-default" href="executive_create_passenger.php">Create passenger account</a>

            <!-- List view with  view button -->
            
            <div class="col-sm-8">
                <ul class="list-group action-list-group">
                    <?php
                        $row = 0;
                        $serv_no = "unavailable"; //fix these after passenger tracker
                        $passengers = ["y","x"];
                        foreach($passengers as $passenger){
                            echo '<li class="list-group-item">';
                            echo '<p '.'style="display: inline-block"'.' >'."firstnamehere".' '."lastnamehere".'</p>';
                            echo '<a class="btn btn-sm btn-default" href="executive_passenger_details_view_page.php?passenger_no='."passenger number".'" '.'style="float: right"'.'>View</a>';
                            echo '</li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>