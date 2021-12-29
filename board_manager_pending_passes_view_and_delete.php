<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$email = '';
$name = '';
$company = '';
$date = '';
$reason = '';

//filter the record from the pass table
if (isset($_GET['pass_no'])) {
    $query = "SELECT * FROM pass WHERE pass_no={$_GET['pass_no']}";
    $result = mysqli_query($conn, $query);

    

    if ($result) {
        $record = mysqli_fetch_assoc($result);


        $date = "{$record['start_date']} to {$record['end_date']}";
        $reason = $record['reason'];



        //get details from passenger table such as email, name, company
        $query_2 = "SELECT first_name,last_name,email FROM passenger WHERE passenger_no={$record['passenger_no']}";
        $result_2 = mysqli_query($conn, $query_2);
        if ($result_2) {
            $record_2 = mysqli_fetch_assoc($result_2);
            $email = $record_2['email'];
            $name = $record_2['first_name'] . " " . $record_2['last_name'];
        } else {
            echo "query failed";
        }

        //get data from service table such as name
        $query_3 = "SELECT name FROM service WHERE service_no={$record['service_no']}";
        $result_3 = mysqli_query($conn, $query_3);
        if ($result_3) {
            $record_3 = mysqli_fetch_assoc($result_3);
            $company = $record_3['name'];
        } else {
            echo "query failed";
        }
    } else {
        echo "query failed";
    }
}

//request accept
if (isset($_POST['accept'])) {
    // echo "Accept";
    $query = "UPDATE pass SET state=2 WHERE pass_no={$_GET['pass_no']}";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo mysqli_affected_rows($connection) . " Records updated.";
    } else {
        echo "Database query failed.";
    }
    header("location:board_manager_pending_passes.php");
}
if (isset($_POST['decline'])) {
    $query = "UPDATE pass SET state=4 WHERE pass_no={$_GET['pass_no']}";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo mysqli_affected_rows($connection) . " Records updated.";
    } else {
        echo "Database query failed.";
    }
    header("location:board_manager_pending_passes.php");
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
    <title>Pass Details</title>
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
                            <li class="active"><a href="board_manager_pending_passes.php">Back</a></li>

                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= $details['name']  ?> <span class="caret"></span></a>
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

    <!-- List view and redirected Page button -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Email Address</th>
                <th scope="col">Name</th>
                <th scope="col">Company</th>
                <th scope="col">Date and Time</th>
                <th scope="col">Reason</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><?php echo $email ?></th>
                <td><?= $name ?></td>
                <td><?= $company ?></td>
                <td><?= $date ?></td>
                <td><?= $reason ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Deleting should be implemented later -->
    <?php
    
        echo "<div class=\"container mt-3\" style=\"float:left;\">";
        echo "<div style=\" margin-top:100px;\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-sm-3 p-3\"></div>";
        echo "<div class=\"col-sm-3 p-3\"></div>";
        echo "<div class=\"col-sm-3 p-3\"></div>";
        echo "<div class=\"col-sm-3 p-3\">";
        echo "<form class=\"form-horizontal\" action=\"board_manager_pending_passes_view_and_delete.php?pass_no={$_GET['pass_no']}\" style=\"width: 600px;\" method=\"POST\">";
        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        echo "<input type=\"submit\" class=\"btn btn-default\" style=\"margin-right:15px;\" value=\"Accept\" name=\"accept\">";
        echo "<input type=\"submit\" class=\"btn btn-default\" value=\"Decline\" name=\"decline\">";
        echo "</div>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    

    ?>
</body>

</html>