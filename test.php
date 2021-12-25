<?php
session_start();

if (!isset($_SESSION['user_Id'])) {
    header("Location: login.php");
    return;
}

echo $_SESSION["user_Id"];
if (isset($_POST['view'])) {
    $id = $_POST['view'];
    echo $id;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logouttest</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css"> -->
</head>

<body>
    <div class="login-dark">
        <div class="background-image"></div>
        <h1>SAFE TRANSIT</h1>
        <form action="includes/logout.inc.php" method="post">
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit">LogOut</button></div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>