<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

$view = new Administrator_view(); // view class
//Service class object
$rows = $view->getApprovedRows(); // getpending rows

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
    <title>Administrator Approved Essential Services</title>
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
                            <li><a href="administrator_pending_essential_services.php">Pending Essential Services</a></li>
                            <li class="active"><a href="administrator_approved_essential_services.php">Approved Essential Services</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_Id'] ?> <span class="caret"></span></a>
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

    <!-- List Viw with two buttons -->
    <ul class="list-group action-list-group">
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
                while ($i < count($rows)) :  ?>
                    <tr>
                        <th scope="row"><?php echo $i+1; ?></th>
                        <td><?php echo $rows[$i]["id"]; ?></td>
                        <td><?php echo $rows[$i]["name"]; ?></td>
                        <td>
                            <a href="#" class="btn btn-info" onclick="clickView(<?php echo $rows[$i]['service_no'];  ?>)"> view </a>
                        </td>
                    </tr>
                <?php $i++;
                endwhile; ?>

            </tbody>
        </table>
    </ul>
    <script type="text/javascript">
        // Onclick function for the relavant button
        function clickView(arg) {
            post("administrator_approved_essential_services_view.php", {
                view: arg
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