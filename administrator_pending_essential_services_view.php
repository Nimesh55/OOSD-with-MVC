<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

if (isset($_POST['view'])) {
    $id =$_POST['view'];
    $view = new Administrator_view();
    $rows = $view->fetchDetails($id);
    $service_id = $rows['id'];
    $service_name = $rows['name'];
    $status = $rows['state'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/passenger_home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Administrator Approved Essential Services</title>
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
                            <li><a href="administrator_home.php">Home</a></li>
                            <li class="active"><a href="administrator_pending_essential_services.php">Pending Essential Services</a></li>
                            <li><a href="administrator_approved_essential_services.php">Approved Essential Services</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_Id'] ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="change_password.php">Change Password</a></li>
                                    <li><a href="logout.php">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <input type="hidden" name="pass_no" value="<?php echo $pass_no ?>">
        <!-- Details of A single pass -->
        <div class="container mt-3">

            <div style="margin-top:100px;">

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Service ID</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?php echo $service_id ?></p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Service Name</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?php echo $service_name ?></p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3 bg-dark text-white">
                        <p>Status</p>
                    </div>
                    <div class="col-sm-3 p-3 bg-primary text-white">
                        <p>: <?php echo $status ?></p>
                    </div>
                    <div class="col-sm-3 p-3"></div>
                </div>

                <br>
                <br>

                <!-- accept and decline buttons -->
                <div class="row">
                    <div class="col-sm-3 p-3"></div>
                    <div class="col-sm-3 p-3">
                        <a href="includes/serviceFunctions.inc.php" class="btn btn-info" onclick="<?php $_SESSION['decline'] = $service_id ?>"> Approve </a>
                        <a href="includes/serviceFunctions.inc.php" class="btn btn-danger" onclick="<?php $_SESSION['decline'] = $service_id ?>"> Decline </a>
                    </div>

                    <div class="col-sm-3 p-3"></div>
                </div>
            </div>
        </div>
</body>

</html>