<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['account_no'])){
    header("Location: login.php");
    return;
}

$error_str='';
if($_SESSION['account_type']==0){
    $passenger_view = new Passenger_View($_SESSION['user_Id']);
    $row = $passenger_view->getDetails();
}elseif ($_SESSION['account_type']==1){
    $conductor_view = new Conductor_View($_SESSION['user_Id']);
    $row = $conductor_view->getDetails();
}else{
    $executive_view = new Executive_View();
    $row = $executive_view->getDetails();
}

if (isset($_SESSION["error"]) && strcmp($_SESSION["error"],"Success")!=0) {
    $row['first_name']=$_POST['fname'];
    $row['last_name']=$_POST['lname'];
    $row['address']=$_POST['address'];
    $row['telephone']=$_POST['telephone'];
    $row['email']=$_POST['email'];

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
            if (isset($_SESSION["error"]) && strcmp($_SESSION["error"],"Success")!=0) {

                echo "<div class=\"alert alert-danger\"><strong>".$_SESSION["error"]."</strong></div>";
            }
            if(isset($_SESSION["error"]) && strcmp($_SESSION["error"],"Success")==0){
                echo "<div class=\"alert alert-success\"><strong>"."Successfully Updated!!!"."</strong></div>";
            }
            ?>

            <form class="form-horizontal" role="form" action="includes/edit_profile.inc.php" method="post">
                <div class="form-group">
                    <label for="fname" class="col-sm-3 control-label">First Name:</label>
                    <div class="col-sm-9">
                        <input name="fname" type="text" class="form-control" id="fname" value="<?= $row['first_name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-sm-3 control-label">Last Name:</label>
                    <div class="col-sm-9">
                        <input name="lname" type="text" class="form-control" id="lname" value="<?= $row['last_name']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="address" rows="5" id="address"><?= $row['address']; ?></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div  class="col-sm-9"><input name="email" type="text" class="form-control" id="email" value="<?= $row['email']; ?>"></div>
                </div>
                <div class="form-group">
                    <label for="telephone" class="col-sm-3 control-label">Telephone:</label>
                    <div class="col-sm-9"><input name="telephone" type="telephone" class="form-control" id="telephone" value="<?= $row['telephone']; ?>"></div>
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

<?php
unset($_SESSION["error"]);
?>
