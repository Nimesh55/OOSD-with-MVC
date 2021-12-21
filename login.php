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
    <div class="login-dark">
    <div class="background-image"></div>
    <h1>SAFE TRANSIT</h1>
        <form action="includes/login.inc.php" method="post">
            <div class="illustration"><img src="https://img.icons8.com/external-kiranshastry-gradient-kiranshastry/64/000000/external-bus-automobile-kiranshastry-gradient-kiranshastry.png"/></div>
            <div class="form-group"><input class="form-control" type="text" name="id" placeholder="ID" required=""></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required=""></div>

            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit">Log In</button></div><div class="sign_up">Don't have account? <a href="account_type.php" class="signup"> Sign up here</a></div></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
