<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>

    <link rel="stylesheet" href="css/passenger_profile_edit.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">



</head>
<body>

<div class="container heading">
    <h1>Forget Password?</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 "></div>
        <div class="col-lg-6  wrapper">

            <?php
            if (isset($_GET['error']) && strcmp($_GET['error'],"failed")==0) {
                echo "<div class=\"alert alert-danger\"><strong>"."Verification Failed"."</strong></div>";
            }else if (isset($_GET['error']) && strcmp($_GET['error'],"notfound")==0) {
                echo "<div class=\"alert alert-danger\"><strong>"."Account Not Found"."</strong></div>";
            }else if (isset($_GET['error']) && strcmp($_GET['error'],"unchangerble")==0) {
                echo "<div class=\"alert alert-danger\"><strong>"."This is Password Unchangerble account"."</strong></div>";
            }
            ?>
            <form class="form-horizontal" role="form" action="includes/forget_password.inc.php" method="post">
                <div class="form-group">
                    <label for="user_id" class="col-sm-3 control-label">User ID:</label>
                    <div class="col-sm-9">
                        <input name="user_id" type="text" class="form-control" id="user_id">
                    </div>
                </div>

                <div class="form-group">
                    <label for="medium" class="col-sm-3 control-label">Send Via:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <label class="radio-inline">
                                <input type="radio" name="medium" checked value="sms">SMS
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="medium" value="email">Email
                            </label>
                        </div>
                    </div>
                </div>



                <br>
                <div class="btn-group btn-group-lg">
                    <input type="submit" class="btn btn-primary ctrlbutton" name="submit" value="Submit">
                    <input type="submit" class="btn btn-primary ctrlbutton" name="exit" value="Exit">
                </div>

            </form>

        </div>
        <div class="col-lg-3 orange"></div>
    </div>
</div>

</body>
</html>
