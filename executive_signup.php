<!DOCTYPE html>
<html>

<head>
	<title>Executive SignUp Form</title>
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
	<link rel="stylesheet" href="css/executive_signup.css">
	<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
</head>

<body>
	<div class="main-w3layouts wrapper">
		<h1>Executive SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="includes/signup.inc.php?account_type=2" method="post">
					<input class="text" type="text" name="Firstname" placeholder="First name">
					<input class="text" type="text" name="Lastname" placeholder="Last name">
					<input class="text" type="text" name="ID" placeholder="Employee ID">
					<input class="text" type="text" name="Address" placeholder="Address">
					<input class="text" type="text" name="Companyname" placeholder="Company Name">
					<input class="text" type="text" name="Companyid" placeholder="Company ID">
					<input class="text email" type="email" name="email" placeholder="Email">
					<input class="text" type="text" name="Telephone" placeholder="Telephone number">
					<input class="text" type="password" name="password" placeholder="Password">
					<input class="text w3lpass" type="password" name="passwordrepeat" placeholder="Confirm Password">
					<br>
					<input class="btn btn-primary" type="submit" name="submit" value="SIGNUP">
				</form>
				<p>Don't have an Account? <a id="link" href="login.php"> Login Now!</a></p>
			</div>
		</div>
	</div>
</body>

</html>