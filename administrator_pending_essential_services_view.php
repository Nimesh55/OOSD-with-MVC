<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

if (isset($_POST['view'])) {
    $id =$_POST['view'];
    $view = new Administrator_View();
    $rows = $view->fetchDetails($id);
    $service_no = $rows['service_no'];
    $service_id = $rows['id'];
    $service_name = $rows['name'];
    $status = $rows['state'];
    $service_file = File_Controller::getInstance()->getFileDetails($rows['file_no']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/administrator_pending_essensial_services.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
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
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo "Administrator" ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="administrator_configuration_settings.php">Settings</a></li>
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

    <div class="container">
        <div class="heading">
            <h1><?php echo $service_name; ?></h1>
        </div>
    </div>
        <input type="hidden" name="pass_no" value="<?php echo $pass_no ?>">
        <!-- Details of A single pass -->


            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 wrapper">

                    <div class="row">
                        <div class="col-sm-5 field">
                            <p>Service ID</p>
                        </div>
                        <div class="col-sm-2">:</div>
                        <div class="col-sm-5 data">
                            <p><?= $service_id ?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 field">
                            <p>Service Name</p>
                        </div>
                        <div class="col-sm-2">:</div>
                        <div class="col-sm-5 data">
                            <p><?= $service_name ?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 field">
                            <p>Status</p>
                        </div>
                        <div class="col-sm-2">:</div>
                        <div class="col-sm-5 data">
                            <p><?= $status ?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5 field">
                            <p>Attachments</p>
                        </div>
                        <div class="col-sm-2">:</div>
                        <div class="col-sm-5 data">

                            <?php
                            if($service_file==null):
                                ?>
                                <p>: No files added </p>
                            <?php
                            else:
                                ?>
                                <a class="btn btn-primary" href="includes/download.inc.php?name=<?php echo $service_file['name'];?>&fname=<?php echo $service_file['fname'] ?>">Download</a>
                            <?php
                            endif;
                            ?>


                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="btn-group btn-group-md">
                        <a href="includes/serviceFunction_Approve.inc.php" class="btn btn-info ctrlbutton" onclick="<?php $_SESSION['approve'] = $service_no ?>"> Approve </a>
                        <a href="includes/serviceFunction_Decline.inc.php?x=d" class="btn btn-danger ctrlbutton" onclick="<?php $_SESSION['decline'] = $service_no ?>"> Decline </a>
                        <a href="administrator_pending_essential_services.php" class="btn btn-default ctrlbutton"> Exit </a>
                    </div>


                </div>
                <div class="col-lg-3"></div>

            </div>



        </div>
</body>

</html>