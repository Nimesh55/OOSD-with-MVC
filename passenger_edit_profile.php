<?php


  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  session_start();

  if(!isset($_SESSION['account_no'])){
      header("Location: login.php");
      return;
  }
  $error_str='';
  $passengerview = new Passenger_View($_SESSION['user_Id']);
  $row = $passengerview->getDetails();
  $row['user_id']=$_SESSION['user_Id'];

  if (isset($_POST['error_str']) && strcmp($_POST['error_str'],"Success")!=0) {
    $row['first_name']=$_POST['fname'];
    $row['last_name']=$_POST['lname'];
    $row['address']=$_POST['address'];
    $row['telephone']=$_POST['telephone'];
    $row['email']=$_POST['email'];
    $error_str=$_POST['error_str'];

  }
  $username = $row['first_name']." ".$row['last_name'];

	$state_str='';
	if ($row['state']==0) {
	    $state_str='Non-Essential';
	}
	elseif ($row['state']==1) {
	    $state_str = 'Pending';
	}
	elseif ($row['state']==2) {
	    $state_str = 'Essential';
	}

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

        <?php
        if (isset($_POST['error_str']) && strcmp($_POST['error_str'],"Success")!=0) {

          echo "<div class=\"alert alert-danger\"><strong>".$error_str."</strong></div>";
        }
        if(isset($_POST['error_str']) && strcmp($_POST['error_str'],"Success")==0){
          echo "<div class=\"alert alert-success\"><strong>"."Successfully Updated!!!"."</strong></div>";
        }
        ?>

				<form class="form-horizontal" role="form" action="includes/passenger_edit_profile.inc.php" method="post">
					<div class="form-group">
						<label for="fname" class="col-sm-3 control-label">First Name:</label>
						<div class="col-sm-9">
							<input name="fname" type="text" class="form-control" id="fname" value="<?php echo $row['first_name'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="lname" class="col-sm-3 control-label">Last Name:</label>
						<div class="col-sm-9">
							<input name="lname" type="text" class="form-control" id="lname" value="<?php echo $row['last_name']; ?>">
						</div>
					</div>

          <div class="form-group">
						<label for="address" class="col-sm-3 control-label">Address:</label>
						<div class="col-sm-9">
              <textarea class="form-control" name="address" rows="5" id="address"><?php echo $row['address']; ?></textarea>
            </div>
					</div>


          <div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email:</label>
						<div  class="col-sm-9"><input name="email" type="text" class="form-control" id="email" value="<?php echo $row['email']; ?>"></div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-3 control-label">Telephone:</label>
					<div class="col-sm-9"><input name="telephone" type="telephone" class="form-control" id="telephone" value="<?php echo $row['telephone']; ?>"></div>
					</div>
          <br>
          <div class="btn-group btn-group-lg">
      			<input type="submit" class="btn btn-primary ctrlbutton" name="cpwd" value="Change Password">
      			<input type="submit" class="btn btn-primary ctrlbutton" name="save" value="Save">
      			<input type="submit" class="btn btn-primary ctrlbutton" name="back" value="Back">
		    	</div>

				</form>

			</div>
			<div class="col-lg-3 orange"></div>
		</div>
	</div>

</body>
</html>
