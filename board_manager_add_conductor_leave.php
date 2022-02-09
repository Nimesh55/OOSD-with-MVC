<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['conductor_id'])){
    header("Location: login.php");
    return;
}

$conductorview = new Conductor_View($_SESSION['user_Id']);

$state_query = 0;
if ($_GET["error"] != "none") {
    $state_query = 1;
    $error = $_GET["error"];
}
$_SESSION['conductor_no'] = $conductorview->getConductorNo($_SESSION['conductor_id']);
$leaves = $conductorview->getGrantedLeave($_SESSION['conductor_no']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/conductor_update_leave.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

    <title>Add Conductor Leave</title>
</head>

<body>

<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="navbar-header">
                    <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span
                                class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <strong class="navbar-brand">Safe Transit</strong>
                </div>

                <div class="navbar-collapse collapse" id="mobile_menu">

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                        class="glyphicon glyphicon-user"></span> Board Manager <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
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

        <div class="heading">
            <h1> Add Conductor Leave </h1>
            <h2> Conductor ID : <?php echo $_SESSION['conductor_id'] ?></h2>
        </div>
        
        <div class="row">

            <div class="col-lg-5 wrapper">
                <h3>Add Conductor Leave</h3>
                <br>
                <div class="row">
                    <?php if ($state_query == 1) {
                        if ($error == "Leave Granted!!")
                            echo "<p class=\"alert alert-success\" id='error'>$error</p>";
                        else
                            echo "<p class=\"alert alert-danger\" id='error'>$error</p>";
                    } ?>
                </div>
                <br>
                <form class="form-horizontal" action="includes/conductor_update_leave.inc.php" method="POST" role="form">
                    <div class="form-group">
                        <label for="leave_date" class="col-sm-3 control-label">Leave Date:</label>
                        <div class="col-sm-8">
                            <input name="leave_date" type="date" class="form-control" id="leave_date" value="">


                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row button-group">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div class="btn btn-group">
                                <button class="btn btn-primary" type="submit" name="submit_manual">Submit</button>
                                <button class="btn btn-primary" type="submit" name="cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="col-lg-1"></div>
            <div class="col-lg-5 wrapper">
                <h3>Granted Leaves</h3>
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Leave No</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($leaves as $leave) {
                            echo "<tr>";
                            echo "<td>{$leave['leave_no']}</td>";
                            echo "<td>{$leave['date']}</td>";
                            echo "</tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>

    </div>

</body>