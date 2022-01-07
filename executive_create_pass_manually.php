<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['user_Id'])){
    header("Location: login.php");
    return;
}

$executive_view = new Executive_View();
$passengers_list_without_passes = $executive_view->getPassengersWithoutPassesArray($_SESSION['service_no']);

$button='submit';
$row['user_id']=$_SESSION['user_Id'];

$reason = "";
$start_date = "";
$end_date = "";
$bus_route ="";

if(isset($_GET['error'])) {
    $passenger_no = $_GET['passenger_no'];
    $reason = $_GET['reason'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $bus_route = $_GET['bus_route'];
    if(strcmp($_GET['error'], "success")== 0){
        $button = 'remove';
    }
}

//print_r($_GET);
//exit();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Profile Edit</title>

    <link rel="stylesheet" href="css/passenger_profile_edit.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">



</head>
<body>

<div class="container heading">
    <h1>Create Pass</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 cyan"></div>
        <div class="col-lg-6 pink wrapper">

            <form class="form-horizontal" role="form" action="includes/executive_create_pass.inc.php" method="post" enctype="multipart/form-data">

                <?php
                if (isset($_GET['error']) && strcmp($_GET['error'],"success")!=0) {
                    echo "<div class=\"alert alert-danger\"><strong>".$_GET['error']."</strong></div>";
                }
                if(isset($_GET['error']) && strcmp($_GET['error'],"success")==0){
                    echo "<div class=\"alert alert-success\"><strong>"."Successfully Created!!!"."</strong></div>";
                }
                ?>

                <div class="form-group">
                    <label for="passenger_no" class="col-sm-3 control-label">Staff ID:</label>
                    <div class="col-sm-9">
                        <select name="passenger_no" id="passenger_no" class="form-control">

                            <?php
                                foreach ($passengers_list_without_passes as $passenger){
                                    if(isset($passenger_no) and $passenger_no==$passenger->getPassengerNo()){
                                        echo "<option value=\"{$passenger->getPassengerNo()}\" selected>{$passenger->getUserId()}</option>";
                                    }else{
                                        echo "<option value=\"{$passenger->getPassengerNo()}\">{$passenger->getUserId()}</option>";
                                    }
                                }
                            ?>

                        </select>

                    </div>
                </div>


                <div class="form-group">
                    <label for="reason" class="col-sm-3 control-label">Reason:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="reason" rows="5" id="reason" placeholder="Enter reason here"><?= $reason ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bus_route" class="col-sm-3 control-label">Bus Route:</label>
                    <div class="col-sm-9">
                        <input name="bus_route" type="text" class="form-control" id="bus_route" placeholder="Enter bus route here" value="<?= $bus_route ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="date" class="col-sm-3 control-label">Date:</label>

                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                                <span class="input-group-addon">
                                    <span aria-hidden="true">From: </span>
                                </span>
                            <input type="date" class="form-control" aria-label="from date" placeholder="from" name="from_date" value="<?= $start_date ?>">

                            <span class="input-group-addon">
                                    <span aria-hidden="true">To: </span>
                                </span>
                            <input type="date" class="form-control" aria-label="to date" placeholder="to" name="to_date" value="<?= $end_date ?>">
                        </div>
                    </div>
                </div>
                <br>

                <?php

                if(strcmp($button,'submit')==0){
                    echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"submit\" value=\"Submit\">";
                    echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"exit\" value=\"Exit\">";
                }else{
                    echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"exit\" value=\"Exit\">";
                }
                ?>

            </form>
        </div>
        <div class="col-lg-3 orange"></div>
    </div>


</div>

</body>
</html>