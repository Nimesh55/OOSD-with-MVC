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
<?php
    for ($i=0;$i<10;$i++){
        echo "<button onclick=\"gfg_Run({$i})\">click to set $i</button>";
    }
?>

<form action="test.php" method="post" id="f">
    <input type="text" id="id1" name="fname" hidden>
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