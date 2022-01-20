<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select account type</title>
    <link rel="stylesheet" href="css/account_type.css">
</head>
<body>

<div class="main-win">
    <form method="post">
        <h1 class="title">Select Account type for Sign Up</h1>
        <div class="main-buttons">
            <!--            <input type="button" value="Executive" onclick="location.href='executive_signup.php'" class="button01">-->
            <!--            <input type="button" value="Passenger" onclick="location.href='passenger_signup.php'" class="button02">-->
            <div class="selection">
                <a href="executive_signup.php">
                    <figure>
                        <img class="photo" src="img/executive.png" alt="Executive Account" width="100" height="100">
                        <figcaption>Executive</figcaption>
                    </figure>
                </a>
            </div>

            <div class="selection">
                <a href="passenger_signup.php">
                    <figure>
                        <img class="photo" src="img/passenger.png" alt="Passenger Account" width="100" height="100">
                        <figcaption>Passenger</figcaption>
                    </figure>
                </a>
            </div>
            <br>
            <br>
            If you have an account <a href="login.php">Login here</a>
        </div>

    </form>
</div>

</body>
</html>
