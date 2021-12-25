<?php

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    return;
}

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/_home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-3">
        <h1> Essential Service Request</h1>
        <div style="margin-top:100px;">
            <div class="row">
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Company Name</p>
                </div>
                <div class="col-sm-3 p-3 bg-primary text-white">

                    <p>: Company Name </p>
                </div>
                <div class="col-sm-3 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Company ID</p>
                </div>
                <div class="col-sm-3 p-3 bg-primary text-white">

                    <p>: Company ID </p>
                </div>
                <div class="col-sm-3 p-3"></div>
            </div>

            <div class="row">
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3 bg-dark text-white">
                    <p>Reason</p>
                </div>
                <div class="col-sm-3 p-3 bg-primary text-white">
                    <p>: Reason</p>
                </div>
                <div class="col-sm-3 p-3"></div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3"></div>
                <div class="col-sm-3 p-3">
                    <form class="form-horizontal" action="/action_page.php" style="width: 600px;">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type=" submit" class="btn btn-default" style="margin-right:15px;" ;">Request</button>
                                <button type="submit" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <script src="" async defer></script>
</body>

</html>