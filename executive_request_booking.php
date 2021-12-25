<?php

    require_once "pdo.php";
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        return;
    }

    if(isset($_POST['request'])){
        if(isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['start_dist']) && isset($_POST['end_dist'])){

            if (!$_POST['start_date'] || !$_POST['end_date'] || !is_numeric($_POST['start_dist']) || !is_numeric($_POST['end_dist'])){
                echo 'Not working';
                echo $_POST['end_date'];
                echo $_POST['start_date'];
                $_SESSION['error'] = "Fill all fields and try again";
                header("Location: executive_request_booking.php");
                return;

            }

            $sql = "INSERT INTO Booking(service_no, start_date, end_date, pickup_district, destination_district
                    ) VALUES ( :serv_no, :str_date, :end_date, :pick_dist, :dest_dist)";
            $stmt = $pdo->prepare($sql);
            $stmt -> execute(array(
                ':serv_no' => $_SESSION['service_no'],
                ':str_date' => $_POST['start_date'],
                ':end_date' => $_POST['end_date'],
                ':pick_dist' => $_POST['start_dist'],
                ':dest_dist' => $_POST['end_dist']
            ));
            $_SESSION['error'] = "";
            header("Location: executive_booking_details.php");
            return;      
        }else{
            $_SESSION['error'] = "Fill all fields and try again";
            header("Location: executive_request_booking.php");
            return; 
        }
    }

    if(isset($_POST['cancel'])){
        $_SESSION['error'] = "";
        header("Location: executive_booking_details.php");
        return;
    }

?>

<!DOCTYPE html>
<html>
<head>
<title>Executive Booking Request</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/signup.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/request_booking.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
</head>
<body>
	<div class="main-w3layouts wrapper">
		<h1>Booking Request Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form method="post">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_date" >Start Date:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="from" name="start_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="end_date">End Date:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="to" name="end_date" style="width: 230px; float:right;">
                        </div>
                    </div>                   
                    

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_dist">Pickup District:</label>
                        <?php
                            echo '<div class="col-sm-10">';
                            echo '<select name="start_dist" id="district" class="form-control">';
                            $stmt = $pdo->query("SELECT * FROM district ");

                            $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            echo "<option>Select Pickup</option>";
                            foreach ($districts as $district) {
                                echo "<option value='" . $district['district_no'] . "' >" . $district['name'] . "</option>";
                            }

                            echo '</select>';
                            echo '</div>';
                        ?>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="end_dist">Destination District:</label>
                        <?php
                            echo '<div class="col-sm-10">';
                            echo '<select name="end_dist" id="district" class="form-control">';
                            $stmt = $pdo->query("SELECT * FROM district ");

                            $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            echo "<option>Select Destination</option>";
                            foreach ($districts as $district) {
                                echo "<option value='" . $district['district_no'] . "' >" . $district['name'] . "</option>";
                            }

                            echo '</select>';
                            echo '</div>';
                        ?>

                    </div>
                    
					<input type="submit" name= "request" value="Request" id="request">
                    <input type="submit" name= "cancel" value="Cancel" id="cancel_request">
                    <?php
                        echo '<label name="error" id="error" style="color:red; float:none;">'."{$_SESSION['error']}".'</label>';
                    ?>
				</form>
			</div>
		</div>
	</div>
</body>
</html>