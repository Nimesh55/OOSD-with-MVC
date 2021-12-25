<?php
require 'pdo.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    return;
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
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'] ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="executive_edit_profile.php">Edit profile</a></li>
                                    <li><a href="logout.php">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- List view with  view button -->
    <form action="executive_pass_details_view_page.php" method="GET">
        <?php
        $service_no = $_SESSION['service_no'];
        $data = $pdo->query("SELECT * FROM pass WHERE (state=0 OR state=1) AND service_no=$service_no");


        ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Pass Number</th>
                    <th scope="col">Passenger Name</th>
                    <th scope="col">View Details</th>

                </tr>
            </thead>
            <tbody>
                <?php while ($rows = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <th scope="row"><?php echo $rows["pass_no"]; ?></th>

                        <?php
                        $p_no = $rows["passenger_no"];
                        $passenger_query = $pdo->query("SELECT passenger_no, first_name, last_name FROM passenger WHERE passenger_no='{$p_no}' ");
                        $names = $passenger_query->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <td><?php echo $names["first_name"] . " " . $names["last_name"]; ?></td>

                        <td>
                            <!-- <input type="submit" name="submit" value="View" /> -->

                            <a href="executive_pass_details_view_page.php?pass_no=<?php echo $rows['pass_no']; ?>" class="btn btn-info"> View </a>
                        </td>
                    </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
    </form>
</body>

</html>