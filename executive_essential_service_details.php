<?php

require_once('includes/dbh.inc.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    return;
}


$query_1 = "SELECT * FROM service WHERE service_no={$_SESSION['service_no']} AND state!=3  LIMIT 1";
$result_1 = mysqli_query($conn, $query_1);
$record_1 = mysqli_fetch_assoc($result_1);
$state = $record_1['state'];
$state_str='';
if ($state==0) {
    $state_str='Non-Essential';
}
elseif ($state==1) {
    $state_str = 'Pending';
}
elseif ($state==2) {
    $state_str = 'Essential';
}

if (isset($_POST['request'])) {
    $query = "UPDATE service SET state=1 where service_no={$_SESSION['service_no']}";
    $result = mysqli_query($conn, $query);
    header("location:executive_essential_service_details.php");
    
    return;
}
if (isset($_POST['remove'])) {
    $query = "UPDATE service SET state=0 where service_no={$_SESSION['service_no']}";
    $result = mysqli_query($conn, $query);
    header("location:executive_essential_service_details.php");
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
    <title>Executive Essential Service Details</title>
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
                            <li><a href="executive_passenger_details.php">Passenger Details</a></li>
                            <li class="active"><a href="executive_essential_service_details.php">Essential Service Details</a></li>
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

    <div class="container mt-3" style="float:left;">
        <h1> <?= $_SESSION['username'] ?> </h1>
        <div style=" margin-top:100px;">
            <div class="row">
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Essential Service Status</p>
                </div>
                <div class="col-sm-3 p-3 bg-primary text-white">
                    <p>: <?php echo $state_str; ?></p>
                </div>
                <div class="col-sm-3 p-3"></div>
            </div>


            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3">
                    <form class="form-horizontal" action="executive_essential_service_details.php" style="width: 600px;" method="POST">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <?php
                                    if($state==0){
                                        echo '<input type="submit" class="btn btn-default" style="margin-right:15px;" value="Request" name="request">';
                                    }else{
                                        echo '<input type="submit" class="btn btn-default" value="Remove" name="remove">';
                                    }

                                ?>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>


</body>

</html>
<?php mysqli_close($conn); ?>