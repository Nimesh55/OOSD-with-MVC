<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    session_start();

    if(!isset($_SESSION['account_no'])){
        header("Location: login.php");
        return;
    }
    $state=0;
    $button='submit';
    $passengerview = new Passenger_View($_SESSION['user_Id']);
    $row = $passengerview->getDetails();
    $row['user_id']=$_SESSION['user_Id'];

    $username = $row['first_name']." ".$row['last_name'];

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

    if($row['state'] == '0'){
        $state = 0;
    }elseif($row['state'] == '1'){
        $state = 1;
    }else{
        $state = 2;
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

    <div class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <strong class="navbar-brand">Safe Transit</strong>
                    </div>

                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav">
                            <li><a href="passenger_home.php">Home</a></li>
                            <li><a href="passenger_register_in_company.php">Register in a company</a></li>
                            <?php
                            if($state>1){
                                echo'<li class="active"><a href="test.php">Request pass</a></li>';
                            }else{
                                echo '<li class="disabled"><a>Request pass</a></li>';
                            }
                            ?>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $username ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="edit_profile.php">Edit profile</a></li>
                                    <li><a href="includes/logout.inc.php">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container heading">
        <h1>Request Pass</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 cyan"></div>
            <div class="col-lg-6 pink wrapper">



                <form class="form-horizontal" role="form" action="includes/passenger_request_pass.inc.php" method="post">

                    <?php
                    if (isset($_GET['error']) && strcmp($_GET['error'],"success")!=0) {

                        echo "<div class=\"alert alert-danger\"><strong>".$_GET['error']."</strong></div>";
                    }
                    if(isset($_GET['error']) && strcmp($_GET['error'],"success")==0){
                        echo "<div class=\"alert alert-success\"><strong>"."Successfully Requested!!!"."</strong></div>";
                    }
                    ?>

                    <div class="form-group">
                        <label for="reason" class="col-sm-3 control-label">Reason:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="reason" rows="5" id="reason"><?php echo $reason;?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bus_route" class="col-sm-3 control-label">Bus Route:</label>
                        <div class="col-sm-9">
                            <input name="bus_route" type="text" class="form-control" id="bus_route" value="<?php echo $bus_route?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Date:</label>

                        <div class="col-sm-9">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">
                                    <span aria-hidden="true">From: </span>
                                </span>
                                <input type="date" class="form-control" aria-label="from date" placeholder="from" name="from_date" value="<?php echo $start_date?>">

                                <span class="input-group-addon">
                                    <span aria-hidden="true">To: </span>
                                </span>
                                <input type="date" class="form-control" aria-label="to date" placeholder="to" name="to_date" value="<?php echo $end_date;?>">
                            </div>
                        </div>
                    </div>
                    <br>

                    <?php

                        if(strcmp($button,'submit')==0){

                            echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"submit\" value=\"Submit\">";
                        }else{
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"remove\" value=\"Remove\">";
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
