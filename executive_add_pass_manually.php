<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['user_Id'])){
    header("Location: login.php");
    return;
}

$executive_view = new Executive_View();


$state=0;
$button='submit';
$passengerview = new Passenger_View($_SESSION['user_Id']);

$staff_I
$reason = "";
$start_date = "";
$end_date = "";
$bus_route ="";
if(isset($_GET['reason'])) {
    $reason = $_GET['reason'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $bus_route = $_GET['bus_route'];
    if(strcmp($_GET['error'], "success")== 0){
        $button = 'remove';
    }
}
$pass_tracker = Pass_Tracker::getInstance();
$result = $pass_tracker->searchForActivePass($passengerview->getPassengerNo());
if (!empty($result)){
    $reason = $result['reason'];
    $start_date = $result['start_date'];
    $end_date = $result['end_date'];
    $bus_route = $result['bus_route'];
    $button = 'remove';
}



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



            <form class="form-horizontal" role="form" action="includes/passenger_request_pass.inc.php" method="post" enctype="multipart/form-data">

                <?php
                if (isset($_GET['error']) && strcmp($_GET['error'],"success")!=0) {

                    echo "<div class=\"alert alert-danger\"><strong>".$_GET['error']."</strong></div>";
                }
                if(isset($_GET['error']) && strcmp($_GET['error'],"success")==0){
                    echo "<div class=\"alert alert-success\"><strong>"."Successfully Created!!!"."</strong></div>";
                }
                ?>

                <div class="form-group">
                    <label for="staff_id" class="col-sm-3 control-label">Staff ID:</label>
                    <div class="col-sm-9">
                        <input name="staff_id" type="text" class="form-control" id="staff_id" placeholder="Enter staff ID here">
                    </div>
                </div>

                <div class="form-group">
                    <label for="reason" class="col-sm-3 control-label">Reason:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="reason" rows="5" id="reason" placeholder="Enter reason here"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bus_route" class="col-sm-3 control-label">Bus Route:</label>
                    <div class="col-sm-9">
                        <input name="bus_route" type="text" class="form-control" id="bus_route" placeholder="Enter bus route here">
                    </div>
                </div>

                <div class="form-group">
                    <label for="date" class="col-sm-3 control-label">Date:</label>

                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                                <span class="input-group-addon">
                                    <span aria-hidden="true">From: </span>
                                </span>
                            <input type="date" class="form-control" aria-label="from date" placeholder="from" name="from_date" value="Start date here">

                            <span class="input-group-addon">
                                    <span aria-hidden="true">To: </span>
                                </span>
                            <input type="date" class="form-control" aria-label="to date" placeholder="to" name="to_date" value="End date here">
                        </div>
                    </div>
                </div>
                <br>


                <?php

                if(strcmp($button,'submit')==0){

                    echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"submit\" value=\"Submit\">";
                }else{

                    echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"remove\" value=\"Back\">";
                }
                ?>

                <input type="text" hidden name="pass_no" value="<?php echo $result['pass_no'] ?>">


            </form>
        </div>
        <div class="col-lg-3 orange"></div>
    </div>


</div>

</body>
</html>