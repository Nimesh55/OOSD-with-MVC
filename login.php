<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['id']) && isset($_POST['password']) ) {
    $stmt = $pdo->query("SELECT * FROM users WHERE user_Id='".$_POST['id']."' ");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row == null) {
        $_SESSION['error'] = "Incorrect username or password";
        header("location:login.php");
        return;
    }
    
    $hashedPwd = $row['password'];
    $pwd =  $_POST['password'];
    if ( password_verify($pwd, $hashedPwd)  && $_POST['id'] == $row['user_id'] ) {
        $_SESSION['error'] = "";
        if ($row['account_type']=='0'){
            $stmt2 = $pdo->query("SELECT first_name,last_name FROM passenger WHERE passenger_no='".$row['account_no']."' ");
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $row2['first_name'].' '.$row2['last_name'];
            $_SESSION['passenger_no'] = $_POST['id'];
            header("Location: passenger_home.php");
            return;
        }elseif ($row['account_type']=='1'){
            $stmt2 = $pdo->query("SELECT first_name,last_name FROM conductor WHERE conductor_no='".$row['account_no']."' ");
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $row2['first_name'].' '.$row2['last_name'];
            $_SESSION['conductor_no'] = $_POST['id'];
            header("Location: conductor_home.php");
            return;
        }elseif ($row['account_type']=='2'){
            $stmt2 = $pdo->query("SELECT first_name,last_name,service_no FROM executive WHERE executive_no='".$row['account_no']."' ");
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $row2['first_name'].' '.$row2['last_name'];
            $_SESSION['executive_no'] = $_POST['id'];
            $_SESSION['service_no'] = $row2['service_no'];
            header("Location: executive_home.php");
            return;
        }elseif ($row['account_type']=='3'){
            $_SESSION['username'] = 'Board Manager';
            $_SESSION['type'] = 3;
            header("Location: board_manager_home.php");
            return;
        }elseif ($row['account_type']=='4'){
            $_SESSION['username'] = 'Administrator';
            $_SESSION['type'] = 4;
            header("Location: administrator_home.php");
            return;
        }
    }else{
        $_SESSION['error'] = "Incorrect username or password";
        header("Location: login.php");
        return;     
    }
}

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
        <form method="post">            
            <div class="illustration"><img src="https://img.icons8.com/external-kiranshastry-gradient-kiranshastry/64/000000/external-bus-automobile-kiranshastry-gradient-kiranshastry.png"/></div>
            <div class="form-group"><input class="form-control" type="text" name="id" placeholder="ID" required=""></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required=""></div>
            <?php
                if ( isset($_SESSION['error']) ) {
                    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                    unset($_SESSION['error']);
                }
            ?>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div><div class="sign_up">Don't have account? <a href="account_type.php" class="signup"> Sign up here</a></div></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>