<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}
$execObj = new Executive_View();
$details = $execObj->getRequestBookingDetails();

?>

<!DOCTYPE html>
<html>
<head>
<title>Executive Booking Request</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>-->
<!--<link href="css/signup.css" rel="stylesheet" type="text/css" media="all" />-->
<!--<link href="css/request_booking.css" rel="stylesheet" type="text/css" media="all" />-->
<!--<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">-->
</head>
<body>
	<div class="main-w3layouts wrapper">
		<h1>Booking Request Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form method="post" action="includes/request_booking.inc.php">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="reason" >Reason: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="reason" name="reason">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_date" >Start Date:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="end_date">End Date:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_time" >Start Time:</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" id="start_time" name="start_time">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="end_time">End Time:</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" id="end_time" name="end_time">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_dist">Pickup District:</label>
                        <?php
                            echo '<div class="col-sm-10">';
                            echo '<select name="start_dist" id="start_dist" class="form-control">';
//                            $stmt = $pdo->query("SELECT * FROM district ");
//
//                            $districts = ["x","y"];
                            $districts = $details['districts'];
                            echo "<option>Select Pickup</option>";
                            foreach ($districts as $district) {
                                echo "<option value='" . $district['district_no'] . "' >" . $district['name'] . "</option>";
                            }

                            echo '</select>';
                            echo '</div>';
                        ?>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pickup_loc" >Pickup location: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pickup_loc" name="pickup_loc">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="end_dist">Destination District:</label>
                        <?php
                            echo '<div class="col-sm-10">';
                            echo '<select name="end_dist" id="district" class="form-control">';


//                            $districts = ["x","y"];
                            $districts = $details['districts'];
                            echo "<option>Select Destination</option>";
                            foreach ($districts as $district) {
                                echo "<option value='" . $district['district_no'] . "' >" . $district['name'] . "</option>";
                            }

                            echo '</select>';
                            echo '</div>';
                        ?>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="destination_loc" >Destination location: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="destination_loc" name="destination_loc">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="passenger_count" >Passenger count: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="passenger_count" name="passenger_count">
                        </div>
                    </div>

                    <input type="submit" name= "request" value="Request" id="request">
                    <input type="submit" name= "request" value="Cancel" id="cancel_request">
                    <!--                    <a class="btn btn-default" href="includes/request_booking.inc.php?action=request">Request</a>-->
                    <!--                    <a class="btn btn-default" href="executive_booking_details.php">Cancel</a>-->

<!--                    --><?php
//                        echo '<label name="error" id="error" style="color:#ff0000; float:none;">' ."{$_SESSION['error']}".'</label>';
//                    ?>
				</form>
			</div>
		</div>
	</div>
</body>
</html>