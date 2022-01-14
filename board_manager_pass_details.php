<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$board_manager_view = new Board_Manager_View();
$details = $board_manager_view->getApprovedPassesDetails();

$approvedPasses = $details['approvedPassesArray'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/board_manager_pass_details.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/buttons.js"></script>
    <title>Board Manager Pass Details</title>
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
                            <li><a href="board_manager_home.php">Home</a></li>
                            <li><a href="board_manager_pending_passes.php">Pending Passes</a></li>
                            <li class="active"><a href="board_manager_pass_details.php">Pass Details</a></li>
                            <li><a href="board_manager_conductor_details.php?show=none">Conductor Details</a></li>
                            <li><a href="board_manager_create_conductor.php">Create Conductor Account</a></li>
                            <li><a href="board_manager_allocate_vehicle.php">Allocate Vehicle</a></li>
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
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><strong><?= $_SESSION['success'] ?></strong></div>
    <?php endif; ?>

    <div class="container mt-3" id="contanier-data">
        <!-- SearchBar -->
        <?php 
        if(empty($approvedPasses) and isset($_GET['search'])){
            echo "<div class=\"alert alert-danger\"><strong>" . "No matches found" . "</strong></div>";
            
        }
        ?>
        
        <form action="board_manager_pass_details.php" method="GET">
            <div class="row">
                <div class="col-sm-1 p-3"></div>
                <div class="col-sm-10 p-3">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search with NIC Number" id="txtSearch" />
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 p-3"></div>
            </div>
        </form>
        <br>
        <!-- List view and redirected Page button -->

        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Passenger No.</th>
                    <th scope="col">Click Here to View</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 0;
                foreach ($approvedPasses as $pass) {
                    $name = $board_manager_view->getPassengerName($pass->getPassengerNo());
                    if ($name) {
                        $i++;
                        echo "<tr>";
                        echo "<th scope=\"row\">{$i}</th>";
                        echo "<td>{$name}</td>";
                        echo "<td><a class=\"btn btn-sm btn-primary\" id=\"btn-primary-Not\" href=\"#\" onclick = \" clickView({$pass->getPassNo()},'board_manager_view_pass_details.php') \">View</a></td>";
                        echo "</tr>";
                    }
                }

                

                ?>

            </tbody>
        </table>
    </div>

</body>
</html>

<?php
unset($_SESSION['success']);
?>