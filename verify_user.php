<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>

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
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 cyan"></div>
        <div class="col-lg-6 wrapper">

<!--                        use this php block if you want to display some alert-->

            <form class="form-horizontal" role="form" action="includes/verify_user.inc.php" method="post">
                <div class="form-group">
                    <label for="code" class="col-sm-3 control-label">Verfication Code:</label>
                    <div class="col-sm-9">
                        <input name="code" type="text" class="form-control" id="code">
                    </div>
                </div>
                <br>
                <div class="btn-group btn-group-lg">
                    <input type="submit" class="btn btn-primary ctrlbutton" name="verify" value="Verify">
                    <input type="submit" class="btn btn-primary ctrlbutton" name="exit" value="Resend">
                </div>
                <input type="text" name="user_id" value="<?php echo $_POST['user_id'] ?>" hidden>
                <input type="text" name="verification_code" value="<?php echo $_POST['verification_code'] ?>" hidden>

            </form>

        </div>
        <div class="col-lg-3 orange"></div>
    </div>
</div>

</body>
</html>
