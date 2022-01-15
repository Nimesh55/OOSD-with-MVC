<?php
if (isset($_GET['src'])) {
	$src = $_GET['src'];
} else {
	$src = 0;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Passenger SignUp Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="css/signup.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
	<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">

		<div class="row">
			<div class="col-sm-12">
				<h1>Passenger SignUp Form</h1>
			</div>
		</div>

		<!-- <div class="row"> -->

		<div class="row">
			<div class="col-sm-12">
				<?php
				if (isset($_GET["error"])) {
					$error = $_GET["error"];
					echo "<p class=\"error\">$error</p>";
				}
				?>
			</div>
		</div>

		<form action="includes/signup.inc.php?account_type=0&src=<?php echo $src  ?>" method="post">
			<div class="row">
				<div class="col-sm-6">
					<input class="text form-control" type="text" name="Firstname" placeholder="First name">
				</div>
				<div class="col-sm-6">
					<input class="text form-control" type="text" name="Lastname" placeholder="Last name">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<input class="text form-control" type="text" name="ID" placeholder="NIC">
				</div>
				<div class="col-sm-6">
					<input class="text form-control" type="text" name="Telephone" placeholder="Telephone number">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<input class="text form-control" type="text" name="Address" placeholder="Address">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<input class="text email form-control" type="text" name="email" placeholder="Email">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<input class="text form-control" type="password" name="password" placeholder="Password">
				</div>
				<div class="col-sm-6">
					<input class="text w3lpass form-control" type="password" name="passwordrepeat" placeholder="Confirm Password">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<input class="btn btn-primary btn-block" type="submit" name="submit" value="SIGNUP">
				</div>
				<div class="col-sm-4"></div>
			</div>

		</form>

		<div class="row end">

			<div class="col-sm-12">
				<?php
				// Depending on where this form is loaded the relavant parts are loaded accordingly
				if (isset($_GET['src']) && $_GET['src'] == 1) {
					echo "<p><a href=\"executive_passenger_details.php\"> back to passenger list</a></p>";
				} else {
					echo "<p>Do you have an Account? <a href=\"login.php\"> Login Now!</a></p>";
				}
				?>
			</div>
		</div>



		<!-- </div> -->
	</div>
</body>

</html>