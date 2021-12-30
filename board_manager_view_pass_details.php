<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_GET['pass_no'])){
    header("Location: board_manager_pending_passes.php");
    return;
}

$pass_no = $_GET['pass_no'];

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->viewPassDetails($pass_no);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="css/passenger_home.css">-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

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
                            <?php
                            if($details['state']==1){
                                echo '<li class="active"><a href="board_manager_pending_passes.php">Back</a></li>';
                            }else{
                                echo '<li class="active"><a href="board_manager_pass_details.php">Back</a></li>';
                            }
                            ?>

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
                <th scope="row"><?= $details['passenger_email'] ?></th>
                <td><?= $details['passenger_name'] ?></td>
                <td><?= $details['service_name'] ?></td>
                <td><?= $details['time_slot'] ?></td>
                <td><?= $details['reason'] ?></td>
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
        echo "<form class=\"form-horizontal\" action=\"board_manager_view_pass_details.php?pass_no={$pass_no}\" style=\"width: 600px;\" method=\"POST\">";
        echo "<div class=\"form-group\">";
        echo "<div class=\"col-sm-offset-2 col-sm-10\">";
        if($details['state']==1){
            echo "<a class=\"btn btn-default\" href=\"includes/view_pass.inc.php?action=accept&pass_no={$pass_no}\">Accept</a>";
            echo "<a class=\"btn btn-default\" href=\"includes/view_pass.inc.php?action=decline&pass_no={$pass_no}\">Decline</a>";
        }else{
            echo "<a class=\"btn btn-default\" href=\"includes/view_pass.inc.php?action=remove&pass_no={$pass_no}\">Remove</a>";
        }
        echo "</div>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    

    ?>
</body>

</html>