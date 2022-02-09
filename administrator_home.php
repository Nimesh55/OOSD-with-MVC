<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['account_no'])) {
    header("Location: login.php");
    return;
}


$view = new Administrator_View();
$viewArray = $view->getDetails();
$numofpendingCompanies = $viewArray["pending"];
$numofServicesApproved = $viewArray["approved"];

$numofIssuedPasses = $viewArray["issued"];
$pendingPasses = $viewArray["pendingPass"];
$declinedPass = $viewArray["declinedPass"];
$acceptedPass = $viewArray["acceptedPass"];
$confirmedPass = $viewArray["confirmed"];
$expiredPass = $viewArray["expiredPass"];

$pendingBookings = $viewArray["pendingBooking"];
$declinedBookings = $viewArray["declinedBooking"];
$approvedBookings = $viewArray["approvedBooking"];
$expiredBookings = $viewArray["expiredBooking"];
$completedBookings = $viewArray["completedBooking"];
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <title>Administrator Home</title>
</head>

<body>
    <div class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                        </button>
                        <strong class="navbar-brand">Safe Transit</strong>
                    </div>

                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="administrator_home.php">Home</a></li>
                            <li><a href="administrator_pending_essential_services.php">Pending Essential Services</a></li>
                            <li><a href="administrator_approved_essential_services.php">Approved Essential Services</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo 'Administrator'; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="administrator_configuration_settings.php">Settings</a></li>
                                    <li><a href="change_password.php">Change Password</a></li>
                                    <li><a href="includes/logout.inc.php">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <!--        <h1> --><? //= $_SESSION['user_Id'] 
                            ?>
        <!-- </h1>-->
        <div class="heading">
            <h1 id="heading"> <?= 'Administrator'; ?> </h1>
        </div>

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10 wrapper">

                <div class="row">
                    <div class="col-sm-6 p-3 field">
                        <p>Number of Pending Companies</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-5 p-3">
                        <p><?php echo $numofpendingCompanies ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 p-3 field">
                        <p>Number of Approved Companies</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-5 p-3">
                        <p><?php echo $numofServicesApproved ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 p-3 field">
                        <p>Number of Issued Passes</p>
                    </div>
                    <div class="col-sm-1 p-3">:</div>
                    <div class="col-sm-5 p-3">
                        <p><?php echo $numofIssuedPasses ?></p>
                    </div>
                </div>

                <div class="row" style="background-color:white;border-radius:10px;text-align:center;">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10"><canvas id="myChart1" style="width:100%;max-width:600px;color:aliceblue;"></canvas>
                        <canvas id="myChart2" style="width:100%;max-width:600px;color:aliceblue;"></canvas>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="col-lg-1"></div>

        </div>

    </div>

    <script>
        var xValues = ["Pending", "Accepted", "Confirmed", "Declined", "Expired"];
        var yValues = [<?php echo $pendingPasses ?>, <?php echo $acceptedPass ?>, <?php echo $confirmedPass ?>, <?php echo $declinedPass ?>, <?php echo $expiredPass ?>];
        var barColors = [
            "#e1e990",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#909090"
        ];

        new Chart("myChart1", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Passes"
                }
            }
        });
    </script>

    <script>
        var xValues = ["Pending", "Approved", "Declined", "Expired", "Completed"];
        var yValues = [<?php echo $pendingBookings ?>, <?php echo $approvedBookings ?>, <?php echo $declinedBookings ?>, <?php echo $expiredBookings ?>, <?php echo $completedBookings ?>];
        var barColors = [
            "#e1e990",
            "#00aba9",
            "#FF0000",
            "#909090",
            "#1e7145"
        ];

        new Chart("myChart2", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Bookings"
                }
            }
        });
    </script>

</body>

</html>