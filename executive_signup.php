<?php

if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "emptyfield")
        $error_str = 'Empty Field!';
    else if ($error == "passwordmismatch")
        $error_str = 'Password is Incorrect!';
    else if ($error == "InvalidUserId")
        $error_str = 'User ID is Invalid!';
    else if ($error == "user_exist")
        $error_str = 'User exist!';
    else if ($error == "emailWrong")
        $error_str = 'Invalid Email!';
    else if ($error == "emailExist")
        $error_str = 'Email Exist!';
    else if ($error == "invalidusername")
        $error_str = 'Invalid Username!';
    else if ($error == "enterstrongpassword")
        $error_str = 'Please Enter a Strong Password!';
    else if ($error == "none")
        $error_str = 'Account successfully created!';
    else if ($error == 'invalidTelephone')
    $error_str = 'Invalid Telephone Number';
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Executive SignUp Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="css/executive_signup.css">
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

    <div class="row">
        <div class="col-sm-12">
            <h1>Executive SignUp Form</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == 'none')
                    echo "<p class=\"success\">$error_str</p>";
                else
                    echo "<p class=\"error\">$error_str</p>";
            }
            ?>
        </div>
    </div>


    <form action="includes/signup.inc.php?account_type=2" method="post">
        <div class="row">
            <div class="col-sm-6">
                <input class="text form-control" type="text" name="Firstname" placeholder="First name">
            </div>
            <div class="col-sm-6">
                <input class="text form-control" type="text" name="Lastname" placeholder="Last name">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <input class="text form-control" type="text" name="ID" placeholder="Employee ID">
            </div>
            <div class="col-sm-6">
                <input class="text form-control" type="text" name="Telephone" placeholder="Telephone number">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <input class="text form-control" type="text" name="Address" placeholder="Address">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <input class="text form-control" type="text" name="Companyname" placeholder="Company Name">
            </div>
            <div class="col-sm-6">
                <input class="text form-control" type="text" name="Companyid" placeholder="Company ID">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <input class="text email form-control" type="email" name="email" placeholder="Email">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="input-group">
                    <input class="text form-control new_pwd" type="password" name="password" placeholder="Password">
                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal_2" type="button"><i
                                                    class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group">
                    <input class="text w3lpass form-control retype_pwd" type="password" name="passwordrepeat"
                           placeholder="Confirm Password">
                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal_3" type="button"><i
                                                    class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                </div>
            </div>
        </div>
        <br>
        <div class="button">
            <input class="btn btn-primary" type="submit" name="submit" value="SIGNUP">
        </div>

    </form>
    <div class="row">
        <p>Do you have an Account? <a id="link" href="login.php"> Login Now!</a></p>

    </div>


</div>
<script src="js/change_pwd.js"></script>
</body>

</html>