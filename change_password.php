<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/change_password.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <title>Change Password</title>
</head>

<body>
    <div class="container">
        <div class="heading">
            <h1>Change Password</h1>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 wrapper">

                <div class="wrapper">
                    <form method="POST" class="form-horizontal" action="includes/change_password.inc.php ?>">

                        <?php
                        if (isset($_SESSION["error"])) {
                            $error = $_SESSION["error"];
                            echo "<div class=\"alert alert-danger\"><strong>" . $error . "</strong></div>";
                        }
                        ?>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="current">Current Password:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" name="current_password" class="form-control pwd" id="current" placeholder="Enter Current Password ">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                </div>
                            </div>

                        </div>


                        <div class=" form-group">
                            <label class="control-label col-sm-3" for="new">New Password:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" name="new_password" class="form-control new_pwd" id="new" placeholder="Enter New Password">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal_2" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="retype_new">ReEnter New Password:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" name="retype_password" class="form-control retype_pwd" id="retype_new" placeholder="ReEnter New Password">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal_3" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="btn-group btn-group-lg">
                            <input name='change' value="Change Password" type="submit" class="btn btn-primary ctrlbutton">
                            <input name='cancel' value="Cancel" type="submit" class="btn btn-primary ctrlbutton">
                        </div>


                    </form>
                </div>

            </div>
            <div class="col-sm-1"></div>
        </div>

    </div>

    <script src="js/change_pwd.js"></script>
</body>

</html>

<?php
unset($_SESSION["error"]);
?>