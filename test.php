<?php
    if(isset($_POST['fname'])){
        print_r($_POST);
    }
?>


<!DOCTYPE html>
<html>

<head>
    <title> </title>
</head>

<body>

<button onclick="gfg_Run()">
    click to set
</button>
<form action="test.php" method="post" id="f">
    <input type="text" id="id1" name="fname">
</form>
<script>
    // var el_down = document.getElementById("GFG_DOWN");
    var inputF = document.getElementById("id1");

    function gfg_Run() {
        inputF.setAttribute('value', 'Nimesh');
        document.getElementById('f').submit();
    }
</script>
</body>

</html>