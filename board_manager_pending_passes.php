<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

class ViewPendingPasses extends Board_Manager{
    private $pendingPasses;
    private $pendingPassesCount;

    public function __construct(){
        $this->pendingPasses = $this->getPendingPasses();
        $this->pendingPassesCount = count($this->pendingPasses);
    }

    public function getPendingPassesCnt(){
        return $this->pendingPassesCount;
    }

    public function getPendingPassesArray(){
        return $this->pendingPasses;
    }

}


$view = new ViewPendingPasses();

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
    <title>Board Manager Pending Passes</title>
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
                            <li class="active"><a href="board_manager_pending_passes.php">Pending Passes</a></li>
                            <li><a href="board_manager_pass_details.php">Pass Details</a></li>
                            <li><a href="board_manager_conductor_details.php">Conductor Details</a></li>
                            <li><a href="board_manager_create_conductor.php">Create Conductor Account</a></li>
                            <li><a href="board_manager_allocate_vehicle.php">Allocate Vehicle</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'] ?> <span class="caret"></span></a>
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

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <form action="board_manager_pending_passes.php" method="GET">
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="input-group">
                    <input name="search" type="text" class="form-control" placeholder="Search with NIC Number" id="txtSearch" />
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>


    <!-- List view and redirected Page button -->
    <ul class="list-group action-list-group">

        <?php
        $pendingPasses = $view->getPendingPassesArray();

        for ($i = 0; $i < $view->getPendingPassesCnt(); $i++) {
            $name = $view->getPassengerName($pendingPasses[$i]['passenger_no']);
            if($name){
                echo "<li class=\"list-group-item\">";
                echo "{$name} ";
                echo "<a class=\"btn btn-sm btn-default\" href=\"board_manager_pending_passes_view_and_delete.php?pass_no={$pendingPasses[$i]['pass_no']}\">View</a>";
                echo "</li>";
            }


        }

        ?>`
    </ul>
</body>

</html>