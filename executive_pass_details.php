<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$viewobj = new Executive_View();
$passDetailsArray = $viewobj->getPassesDetails($_SESSION['service_no']);
$pendingPassesArray = array();
$acceptedPassesArray = array();
$confirmedPassesArray = array();
foreach ($passDetailsArray as $cur) { // Seperated the Passes in to 3 array for 3 tabs to display easily
    if ($cur->getState() == 0) {
        array_push($pendingPassesArray, $cur);
    } elseif ($cur->getState() == 1) {
        array_push($acceptedPassesArray, $cur);
    } elseif ($cur->getState() == 2) {
        array_push($confirmedPassesArray, $cur);
    }
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
    <title>Executive Pass Details</title>
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
                            <li><a href="executive_home.php">Home</a></li>
                            <li class="active"><a href="executive_pass_details.php">Pass Details</a></li>
                            <li><a href="executive_booking_details.php">Booking Details</a></li>
                            <li><a href="executive_passenger_details.php">Passenger Details</a></li>
                            <li><a href="executive_essential_service_details.php">Essential Service Details</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['exec_name'] ?> <span class="caret"></span></a>
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

    <!-- List view with  view button -->

    <a href="executive_add_pass_manually.php" class="btn btn-info" name="add_pass" style=""> Add pass </a>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#link1" data-toggle="tab">Pending</a></li>
            <li><a href="#link2" data-toggle="tab">Approved</a></li>
            <li><a href="#link3" data-toggle="tab">Confirmed</a></li>
        </ul>

        <div class="tab-content">
            <div id="link1" class="tab-pane fade in active">
                <form action="executive_pass_details_view_page.php" method="GET">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Pass Number</th>
                                <th scope="col">Passenger Name</th>
                                <th scope="col">View Details</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $row = 0;
                            foreach ($pendingPassesArray as $cur) :
                                $p_no = $cur->getPassengerNo();
                                $pass_no = $cur->getPassNo();
                                $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($p_no);
                                $names = array("first_name" => $passenger->getFirstName(), "last_name" => $passenger->getLastName());
                                $row++;
                            ?>
                                <tr>

                                    <th scope="row"><?php echo $row; ?></th>
                                    <td><?php echo $names["first_name"] . " " . $names["last_name"]; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-info" onclick="clickView(<?php echo $pass_no ?>)"> View </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </form>
            </div>

            <div id="link2" class="tab-pane fade">
                <form action="executive_pass_details_view_page.php" method="GET">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Pass Number</th>
                                <th scope="col">Passenger Name</th>
                                <th scope="col">View Details</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $row = 0;
                            foreach ($acceptedPassesArray as $cur) :
                                $p_no = $cur->getPassengerNo();
                                $pass_no = $cur->getPassNo();
                                $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($p_no);
                                $names = array("first_name" => $passenger->getFirstName(), "last_name" => $passenger->getLastName());
                                $row++;
                            ?>
                                <tr>

                                    <th scope="row"><?php echo $row; ?></th>
                                    <td><?php echo $names["first_name"] . " " . $names["last_name"]; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-info" onclick="clickView(<?php echo $pass_no ?>)"> View </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </form>
            </div>

            <div id="link3" class="tab-pane fade">
                <form action="executive_pass_details_view_page.php" method="GET">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Pass Number</th>
                                <th scope="col">Passenger Name</th>
                                <th scope="col">View Details</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $row = 0;
                            foreach ($confirmedPassesArray as $cur) :
                                $p_no = $cur->getPassengerNo();
                                $pass_no = $cur->getPassNo();
                                $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($p_no);
                                $names = array("first_name" => $passenger->getFirstName(), "last_name" => $passenger->getLastName());
                                $row++;
                            ?>
                                <tr>

                                    <th scope="row"><?php echo $row; ?></th>
                                    <td><?php echo $names["first_name"] . " " . $names["last_name"]; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-info" onclick="clickView(<?php echo $pass_no ?>)"> View </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Onclick function for the relavant button
        function clickView(arg) {
            post("executive_pass_details_view_page.php", {
                pass_no: arg
            });
        }
        // 
        /**
         * Dynamically creates form elements and adds to $_POST
         * path     : the path to send the post request to
         * params   : The variables to be passed
         * method   : the method to use on the form default set to 'post'
         */
        function post(path, params, method = 'post') {
            const form = document.createElement('form');
            form.method = method;
            form.action = path;

            for (const key in params) {
                if (params.hasOwnProperty(key)) {
                    const hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = key;
                    hiddenField.value = params[key];

                    form.appendChild(hiddenField);
                }
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>