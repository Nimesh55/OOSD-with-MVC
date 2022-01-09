<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    session_start();
    if (isset($_POST['submit']) && $_POST['submit']=='Submit') {
        $passenger_request_pass_controller = new Passenger_Request_Pass_Controller();
        $passenger = Passenger_Tracker::getInstance()->getPassenger($_SESSION['user_Id']);
        $pass_tracker = Pass_tracker::getInstance();
        $details = array(
            'passenger_no' => $passenger->getPassengerNo(),
            'service_no' => $passenger->getServiceNo(),
            'start_date' => $_POST['from_date'],
            'end_date' => $_POST['to_date'],
            'bus_route' => $_POST['bus_route'],
            'reason' => $_POST['reason']
        );
        $errors = $passenger_request_pass_controller->validate($details);
        $url_extention = "reason={$details['reason']}&";
        $url_extention .= "start_date={$details['start_date']}&";
        $url_extention .= "end_date={$details['end_date']}&";
        $url_extention .= "bus_route={$details['bus_route']}&";
        $url_extention .= "error={$errors}";
        if (!strcmp($errors, "success") != 0) {
            $pass = $pass_tracker->createPass($details);
            $param = [0,$pass->getPassNo(), $pass->getBusRoute(), $pass->getStartDate(), $pass->getEndDate()];
            // Pass Pending Notification##
            Notification_handler::setupNotification($passenger->getEmail(), $passenger->getTelephone(), $param);
        }
//        header("Location: ../passenger_request_pass.php?{$url_extention}");
    }
if (isset($_POST['remove'])){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $pass_tracker = Pass_tracker::getInstance();
    $pass_tracker->declinePass($_POST['pass_no']);
    header("Location: ../passenger_request_pass.php?{$url_extention}");

}

if(isset($_POST['home'])){
    header("Location:../passenger_home.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<form id="returndata" action="../passenger_request_pass.php" method="post">
    <input type="hidden" name="reason" value="<?php echo $details['reason']; ?>">
    <input type="hidden" name="start_date" value="<?php echo $details['start_date']; ?>">
    <input type="hidden" name="end_date" value="<?php echo $details['end_date']; ?>">
    <input type="hidden" name="bus_route" value="<?php echo $details['bus_route']; ?>">
    <input type="hidden" name="error" value="<?php echo $errors; ?>">
<!--    <input type="hidden" name="error_str" value="--><?php //echo $errors_str; ?><!--">-->
    <input type="hidden" name="sub" value="finish">

</form>
<script type="text/javascript">
    document.getElementById('returndata').submit();
</script>
</body>
</html>



