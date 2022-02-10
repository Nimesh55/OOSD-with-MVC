<?php

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
<div class="fluid-container">
    <?php
    if (isset($_GET['error']) && strcmp($_GET['error'], "success") == 0) {
        echo '<div class="alert alert-success fade in tob_bar_alert">';
        echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
        echo '<strong>Password Reseted Successfully!</strong>';
        echo '</div>';
    }
    ?>
</div>
<div class="container">


    <div class="row wrapper">
        <div class="col-sm-6 head-text heading">
            <h1>SAFE TRANSIT</h1>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <div class="login-dark">
                <div class="background-image"></div>
                <form action="includes/login.inc.php" method="post">
                    <div class="illustration"><img src="img/bus2.png"/></div>
                    <div class="form-group"><input class="form-control insert" type="text" name="id" placeholder="ID"
                                                   required=""></div>
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control insert pwd" type="password" name="password"
                                   placeholder="Password" required="">
                            <span class="input-group-btn">
                                        <button class="form-control btn btn-default reveal" type="button"><i
                                                    class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                        </div>
                    </div>
                    <p><a href="forget_password.php">Forget your Password?</a></p>
                    <?php if(isset($_GET['error'])){
                        if($_GET['error']=="NoSuchUser"||$_GET['error']=="wrongPwd"){
                            echo '<p class ="loginerror">Invalid Username or Password</p>';
                        }
                    }?>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" name="submit">Log In</button>
                    </div>
                    <div class="sign_up">Don't have account? &nbsp;<a href="account_type.php" class="signup">Sign up
                            here</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/change_pwd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>