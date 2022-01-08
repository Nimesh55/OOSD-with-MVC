<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['account_no'])){
    header("Location: login.php");
    return;
}
echo "<pre>";
print_r($_POST);
echo "</pre>";


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
            <form class="form-horizontal" role="form" action="includes/executive_essential_service_details.inc.php" method="post">
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-8">
                        <input name="password" type="password" class="form-control" id="password" value="">
                        <input name="variablePass1" value="<?php echo $_POST['variablePass1']; ?>" hidden>
                    </div>
                    <div class="col-sm-1"></div>
                </div>

                <div class="btn-group btn-group-lg">
<!--                    <input type="submit" class="btn btn-primary ctrlbutton" name="cpwd" value="Change Password">-->
                    <input type="submit" class="btn btn-primary ctrlbutton" name="enter" value="Enter">
                    <input type="submit" class="btn btn-primary ctrlbutton" name="back" value="Back">
                </div>

            </form>

        </div>
        <div class="col-lg-3 orange"></div>
    </div>
</div>

</body>
</html>
