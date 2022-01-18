<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    session_start();

    if(!isset($_SESSION['user_Id'])){
        header("Location: login.php");
        return;
    }

    $passengerview = new Passenger_View($_SESSION['user_Id']);
    $row = $passengerview->getDetails();
    $row['user_id']=$_SESSION['user_Id'];
    $username = $passengerview->getUserName();
    $state=0;

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="css/conductor_home.css">-->
    <link rel="stylesheet" href="css/passenger_home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Passenger Home</title>
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
                        <li class="active"><a href="passenger_home.php">Home</a></li>
                        <li><a href="passenger_register_in_company.php">Register in a company</a></li>
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




<div class="container">
    <h1 id="heading"> <?= $username; ?> </h1>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 wrapper">

            <div class="row">
                <div class="col-sm-4 p-3 field">
                    <p>First Name</p>
                </div>
                <div class="col-sm-1 p-3">:</div>
                <div class="col-sm-7 p-3">
                    <p><?= $row['first_name'] ?> </p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 p-3 field">
                    <p>Last Name</p>
                </div>
                <div class="col-sm-1 p-3">:</div>
                <div class="col-sm-7 p-3">
                    <p><?= $row['last_name'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 p-3 field">
                    <p>Address</p>
                </div>
                <div class="col-sm-1 p-3">:</div>
                <div class="col-sm-7 p-3">
                    <p><?= $row['address'] ?> </p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 p-3 field">
                    <p>NIC</p>
                </div>
                <div class="col-sm-1 p-3">:</div>
                <div class="col-sm-7 p-3">
                    <p><?= $row['user_id'] ?> </p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 p-3 field">
                    <p>Telephone NO</p>
                </div>
                <div class="col-sm-1 p-3">:</div>
                <div class="col-sm-7 p-3">
                    <p><?= $row['telephone'] ?> </p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 p-3 field">
                    <p>Email</p>
                </div>
                <div class="col-sm-1 p-3">:</div>
                <div class="col-sm-7 p-3">
                    <p><?= $row['email'] ?> </p>
                </div>
            </div>

        </div>
        <div class="col-lg-3"></div>

    </div>

</div>

  </body>

  </html>
