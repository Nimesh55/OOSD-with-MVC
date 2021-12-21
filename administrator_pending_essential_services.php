<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$view = new Administrator_view(); // view class

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
    <title>Administrator Pending Essential Services</title>
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

    <!-- List Viw with two buttons -->
    <ul class="list-group action-list-group">
        <form action="administrator_pending_essential_services_view.php" method="POST">
            <?php $data = $pdo->query("SELECT * FROM service WHERE state = 1 ORDER BY service_no;"); ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Service ID</th>
                        <th scope="col">Service Name</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($rows = $data->fetch(PDO::FETCH_ASSOC)) : $i++; ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $rows["id"]; ?></td>
                            <td><?php echo $rows["name"]; ?></td>

                            <?php //$btn_name = "{$rows["service_no"]}"; 
                            ?>

                            <td><a href="administrator_pending_essential_services_view.php?view=<?php echo $rows['service_no']; ?>" class="btn btn-info"> view </a>
                            </td>

                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
        </form>

    </ul>
</body>

</html>