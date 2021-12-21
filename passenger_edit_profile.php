<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['account_no'])){
    header("Location: login.php");
    return;
}

  $passengerview = new PassengerView($_SESSION['account_no']);
  $row = $passengerview->getDetails();
  $row['user_id']=$_SESSION['user_Id'];
  $username = $row['first_name']." ".$row['last_name'];

	// echo "<pre>";
	// print_r($row);
	// echo "</pre>";



 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Passenger Profile Edit</title>

	<link rel="stylesheet" href="css/passenger_profile_edit.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">



</head>
<body>

  <div class="container heading">
    <h1>Edit Profile</h1>
  </div>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 cyan"></div>
			<div class="col-lg-6 pink wrapper">

				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="fname" class="col-sm-3 control-label">First Name:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="fname" value=<?php echo $row['first_name'];?>>
						</div>
					</div>
					<div class="form-group">
						<label for="lname" class="col-sm-3 control-label">Last Name:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="lname" value=<?php echo $row['last_name']; ?>>
						</div>
					</div>

          <div class="form-group">
						<label for="address" class="col-sm-3 control-label">Address:</label>
						<div class="col-sm-9">
              <textarea class="form-control" name="address" rows="5" id="address" value=<?php echo $row['address']; ?>></textarea>
            </div>
					</div>


          <div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email:</label>
						<div class="col-sm-9"><input type="text" class="form-control" id="email" value=<?php echo $row['email']; ?>></div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-3 control-label">Telephone:</label>
					<div class="col-sm-9"><input type="telephone" class="form-control" id="telephone" value=<?php echo $row['telephone']; ?>></div>
					</div>
          <br>
          <div class="btn-group btn-group-lg">
      			<button type="button" class="btn btn-primary">Change Password</button>
      			<button type="button" class="btn btn-primary">Save</button>
      			<button type="button" class="btn btn-primary">Cancel</button>
		    </div>

				</form>

			</div>
			<div class="col-lg-3 orange"></div>
		</div>
	</div>

</body>
</html>
