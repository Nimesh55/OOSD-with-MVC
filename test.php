<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
if (isset($_POST['fname'])) {
    print_r($_POST);
}
if (isset($_POST['myfile'])){

}
$current = date('Y-m-d');
echo $current;
$s = array();
array_push($s,"0778665718");
notification_handler::sendNotification($s,"www.google.com","");
?>


<!DOCTYPE html>
<html>

<head>
    <title> </title>
</head>

<body>
    <?php
    for ($i = 0; $i < 10; $i++) {
        echo "<button onclick=\"gfg_Run({$i})\">click to set $i</button>";
    }
    ?>

    <form action="test.php" method="post" id="f">
        <input type="text" id="id1" name="fname" hidden>
        <label for="myfile">Select a file:</label>
        <input type="file" id="myfile" name="myfile" multiple>
    </form>
    <script>
        // var el_down = document.getElementById("GFG_DOWN");
        var inputF = document.getElementById("id1");

        function gfg_Run(x) {
            inputF.setAttribute('value', x);
            document.getElementById('f').submit();
        }
    </script>
</body>

</html>