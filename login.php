<?php

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">

        <div class="row wrapper">
            <div class="col-sm-6 head-text">
                <h1>SAFE TRANSIT</h1>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
            <div class="login-dark">
                <div class="background-image"></div>
                <form action="includes/login.inc.php" method="post">
                    <div class="illustration"><img src="img/bus2.png" /></div>
                    <div class="form-group"><input class="form-control insert" type="text" name="id" placeholder="ID" required=""></div>
                    <div class="form-group"><input class="form-control insert" type="password" name="password" placeholder="Password" required=""></div>

                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit">Log In</button></div>
                    <div class="sign_up">Don't have account? &nbsp;<a href="account_type.php" class="signup">Sign up here</a></div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>