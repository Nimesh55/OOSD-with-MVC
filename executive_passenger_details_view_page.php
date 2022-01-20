<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}
if (!isset($_POST['variablePass1']) and !isset($_SESSION['variablePass1'])) {
    header("Location: executive_passenger_details.php");
    return;
}

if(isset($_SESSION['link']))
    unset($_SESSION['link']);

if(!isset($_POST['variablePass1']))
    $_POST['variablePass1'] = $_SESSION['variablePass1'];
    unset($_SESSION['variablePass1']);

$passenger_no = $_POST['variablePass1'];
$passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($passenger_no);
$passenger_file = File_Controller::getInstance()->getFileDetails($passenger->getFileNo());
$row = array('state' => $passenger->getState(), 'first_name' => $passenger->getFirstName(), 'last_name' => $passenger->getLastName(), 'address' => $passenger->getAddress(), 'staff_id' => $passenger->getStaffId(), 'user_id' => $passenger->getUserId(), 'telephone' => $passenger->getTelephone(), 'email' => $passenger->getEmail());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/executive_passenger_details_view_page.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/buttons.js"></script>
    <title>Executive Passenger Details</title>
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
                            <li><a href="executive_pass_details.php">Pass Details</a></li>
                            <li><a href="executive_booking_details.php">Booking Details</a></li>
                            <li class="active"><a href="executive_passenger_details.php">Passenger Details</a></li>
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

    <!-- Details are shown here -->
    <form method="post">
        <div class="container">



            <div class="row">

                <div class="col-lg-3"></div>

                <div class="col-lg-6 wrapper">

                    <div class="row">
                        <div class="col-sm-5  field">
                            <p>Name</p>
                        </div>
                        <div class="col-sm-2 ">:</div>
                        <div class="col-sm-5 data">
                            <p><?= $row['first_name'] . ' ' . $row['last_name'] ?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5  field">
                            <p>Address</p>
                        </div>
                        <div class="col-sm-2 ">:</div>
                        <div class="col-sm-5 data">
                            <p><?= $row['address'] ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5  field">
                            <p>Staff ID</p>
                        </div>
                        <div class="col-sm-2 ">:</div>
                        <div class="col-sm-5 data">
                            <p><?= $row['staff_id'] ?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5  field">
                            <p>Telephone NO</p>
                        </div>
                        <div class="col-sm-2 ">:</div>
                        <div class="col-sm-5 data">
                            <p><?= $row['telephone'] ?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5  field">
                            <p>Email</p>
                        </div>
                        <div class="col-sm-2 ">:</div>
                        <div class="col-sm-5 data">
                            <p><?= $row['email'] ?> </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5  field">
                            <p>Attachments</p>
                        </div>
                        <div class="col-sm-2 ">:</div>
                        <div class="col-sm-5 data">

                            <?php
                            if($passenger_file==null):
                                ?>
                                <p>No files added </p>
                            <?php
                            else:
                                ?>
                                <a class="btn btn-primary btn-sm" href="includes/download.inc.php?name=<?php echo $passenger_file['name'];?>&fname=<?php echo $passenger_file['fname'] ?>">Download</a>
                            <?php
                            endif;
                                $_SESSION['link']="../executive_passenger_details_view_page.php";
                                $_SESSION['variablePass1'] = $_POST['variablePass1'];
                            ?>



                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="btn-group btn-group-lg">
                    <?php
                    if ($row['state'] == 1) {
                        echo '<a class="btn btn-default ctrlbutton" type="submit" value="Accept" name="decline" onclick="clickView(\'2-'.$passenger_no.'\',\'includes/executive_passenger_view.inc.php\')">Accept</a>';
                        echo '<a class="btn btn-default ctrlbutton" type="submit" value="Decline" name="decline" onclick="clickView(\'0-'.$passenger_no.'\',\'includes/executive_passenger_view.inc.php\')">Decline</a>';
                    } elseif ($row['state'] == 2) {
                        echo '<a class="btn btn-default ctrlbutton" type="submit" value="Remove" name="decline" onclick="clickView(\'0-'.$passenger_no.'\',\'includes/executive_passenger_view.inc.php\')">Remove</a>';
                    }
                    ?>

                        <a class="btn btn-default ctrlbutton" type="submit" value="Exit" name="exit" href="executive_passenger_details.php">Exit</a>
                    </div>




                </div>
                <div class="col-lg-3"></div>

            </div>

        </div>
    </form>

</body>

</html>