<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    session_start();


    if(!isset($_SESSION['account_no'])){
        header("Location: login.php");
        return;
    }


    $passengerview = new Passenger_View($_SESSION['user_Id']);
    $pass_state = $passengerview->getPassState();
    $username = $passengerview->getUserName();
    $service_no=$passengerview->getPassengerServiceNo();
    $staff_id = $passengerview->getPassengerStaffId();
    $service_name = $passengerview->getServiceName($service_no);
    $passenger_file = $passengerview->getPassengerFileDetails();
    $state=0;
    $state_name ='';

    $service_model = Service_Model::getInstance();
    $services=$service_model->getServiceNames();

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

<?php
    if ($state>=1){
        require_once "includes/passenger_register_in_company_1.inc.php";
    }
    else{
        require_once "includes/passenger_register_in_company_2.inc.php";
    }

?>

</body>
</html>
