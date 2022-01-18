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
        <title>Change Password</title>
    </head>

    <body>
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
                                <input type="password" name="current_password" class="form-control" id="current"
                                       placeholder="Enter Current Password ">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="control-label col-sm-3" for="new">New Password:</label>
                            <div class="col-sm-9">
                                <input type="password" name="new_password" class="form-control" id="new"
                                       placeholder="Enter New Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="retype_new">ReEnter New Password:</label>
                            <div class="col-sm-9">
                                <input type="password" name="retype_password" class="form-control" id="retype_new"
                                       placeholder="ReEnter New Password">
                            </div>
                        </div>

                        <div class="btn-group btn-group-lg">
                            <input name='change' value="Change Password" type="submit"
                                   class="btn btn-primary ctrlbutton">
                            <input name='cancel' value="Cancel" type="submit" class="btn btn-primary ctrlbutton">
                        </div>


                    </form>
                </div>

            </div>
            <div class="col-sm-1"></div>
        </div>

    </div>
    </body>

    </html>

<?php
unset($_SESSION["error"]);
?>