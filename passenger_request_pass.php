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
    $pass_file = $passengerview->getPassFileDetails();
    $row['user_id']=$_SESSION['user_Id'];

    $username = $row['first_name']." ".$row['last_name'];

    $pass_state=-1;
    $reason = "";
    $start_date = "";
    $end_date = "";
    $bus_route ="";


    if(isset($_POST['error'])){
        $reason = $_POST['reason'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $bus_route = $_POST['bus_route'];
        if(strcmp($_POST['error'], "success")== 0){
            $button = 'remove';
        }
    }

    $pass_tracker = Pass_Tracker::getInstance();

    $result = $pass_tracker->searchForActivePass($passengerview->getPassengerNo());


    if (!empty($result)){
        $pass_state = $result['state'];
        $reason = $result['reason'];
        $start_date = $result['start_date'];
        $end_date = $result['end_date'];
        $bus_route = $result['bus_route'];
        $button = 'remove';
    }

    if($pass_state==-1){
        $reason = "";
        $start_date = "";
        $end_date = "";
        $bus_route ="";
        $button = 'submit';

    }
    $pass_state_str = '';
    $html = '<div class="state alert alert-info">'.'No Requests'.'</div>';
    if($pass_state==-1){
        $pass_state_str = "Not Requested";
    }
    elseif($pass_state==0){
        $pass_state_str = "Pending";
        $html ='<div class="state alert alert-info">'.$pass_state_str.'</div>';

    }elseif($pass_state==1){
        $pass_state_str = "Accepted";
        $html ='<div class="state alert alert-success accepted">'.$pass_state_str.'</div>';
    }elseif($pass_state==2){
        $pass_state_str = "Confirmed";
        $html ='<div class="state alert alert-success">'.$pass_state_str.'</div>';
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
    <title>Request Pass</title>

    <link rel="stylesheet" href="css/passenger_profile_edit.css">
    <link rel="stylesheet" href="css/upload.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/upload.js"></script>


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
                                echo'<li class="active"><a href="passenger_request_pass.php">Request pass</a></li>';
                            }else{
                                header("location:passenger_home.php");
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



                <form class="form-horizontal" role="form" action="includes/passenger_request_pass.inc.php" method="post" enctype="multipart/form-data">

                    <?php
                    if (isset($_POST['error']) && strcmp($_POST['error'],"success")!=0) {

                        echo "<div class=\"alert alert-danger\"><strong>".$_POST['error']."</strong></div>";
                    }
                    if(isset($_POST['error']) && strcmp($_POST['error'],"success")==0){
                        echo "<div class=\"alert alert-success\"><strong>"."Successfully Requested!!!"."</strong></div>";
                    }
                    ?>


                    <div class="form-group">
                        <label for="bus_route" class="col-sm-3 control-label">Pass State:</label>
                        <div class="col-sm-9">
                            <?php echo $html; ?>


                        </div>
                    </div>

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

                    <div class="form-group">
                        <label for="file" class="col-sm-3 control-label">Attachments:</label>
                        <div class="col-sm-9">
                            <?php if(strcmp($button,'submit')==0): ?>

                                <div class="input-group">
                                    <input type="text" class="form-control" readonly>
                                    <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Browse File <input type="file" id="file" name="file" style="display: none;">
                                </span>
                                    </label>
                                </div>

                            <?php elseif($pass_file==null): ?>
                                <input name="view" type="text" class="form-control" id="view" readonly value="No file added">
                            <?php else: ?>
                            <div class="input-group">
                                <input name="view" type="text" class="form-control" id="view" readonly value="<?= $pass_file['name'] ?>">
                                <div class="input-group-btn">
                                <a class="btn btn-primary" href="includes/download.inc.php?name=<?php echo $pass_file['name'];?>&fname=<?php echo $pass_file['fname'] ?>">Download</a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="btn-group btn-group-lg">
                    <?php

                        if(strcmp($button,'submit')==0){

                            echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"submit\" value=\"Submit\">";
                        }else{

                            echo "<input type=\"submit\" class=\"btn btn-primary btn-lg ctrlbutton\" name=\"remove\" value=\"Remove\" onclick=\"return confirm('Are you sure?');\">";
                        }
                        ?>
                    <input type="submit" class="btn btn-primary btn-lg ctrlbutton" value="Back to Home" name="home">
                    </div>
                    <input type="text" hidden name="pass_no" value="<?php echo $result['pass_no'] ?>">


                </form>
            </div>
            <div class="col-lg-3 orange"></div>


        </div>



    </div>

</body>
</html>
