<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    session_start();

    if(!isset($_SESSION['account_no'])){
        header("Location: login.php");
        return;
    }

    $passengerview = new Passenger_View($_SESSION['account_no']);
    $pass_state = $passengerview->getPassState();
    $username = $passengerview->getUserName();
    $service_no=$passengerview->getPassengerServiceNo();
    $state=0;
    $state_name ='';
    if($pass_state == '0'){
        $state = 0;
    }elseif($pass_state == '1'){
        $state = 1;
        $state_name = "Pending";
    }else{
        $state = 2;
        $state_name = "Accepted";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Profile Edit</title>

    <link rel="stylesheet" href="css/passenger_register_in_company.css">
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
                        <li class="active"><a href="passenger_register_in_company.php">Register in a company</a></li>
                        <?php
                        if($state>1){
                            echo'<li><a href="passenger_request_pass.php">Request pass</a></li>';
                        }else{
                            echo '<li class="disabled"><a>Request pass</a></li>';
                        }
                        ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $username ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="passenger_edit_profile.php">Edit profile</a></li>
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
    <h1>Register In Company</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 cyan"></div>
        <div class="col-lg-6 pink wrapper">
            <form class="form-horizontal" role="form" action="includes/passenger_edit_profile.inc.php" method="post">
                <div class="form-group">
                    <label for="pass_status" class="col-sm-3 control-label">Passenger Status:</label>
                    <div class="col-sm-9">
                        <input name="pass_status" type="text" class="form-control" id="pass_status" readonly value="<?php echo $state_name; ?>
                        ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="company" class="col-sm-3 control-label">Company:</label>
                    <div class="col-sm-9">
                        <input name="company" type="text" class="form-control" id="company" readonly >
                    </div>
                </div>

                <div class="form-group">
                    <label for="staff_id" class="col-sm-3 control-label">Staff ID:</label>
                    <div class="col-sm-9">
                        <input name="staff_id" type="text" class="form-control" id="staff_id" readonly >
                    </div>
                </div>
                <br>

                <input type="button" class="btn btn-default btn-lg" value="Remove">

            </form>

        </div>
        <div class="col-lg-3 orange"></div>
    </div>
</div>

</body>
</html>
