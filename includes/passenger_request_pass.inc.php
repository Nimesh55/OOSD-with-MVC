<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    session_start();
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    if (isset($_POST['submit']) && $_POST['submit']=='Submit') {
        $passenger_request_pass_controller = new Passenger_Request_Pass_Controller();
        $passenger = Passenger::getInstance($_SESSION['user_Id']);
        $pass_tracker = Pass_tracker::getInstance();
        $details = array(
            'passenger_no' => $passenger->getPassengerNo(),
            'service_no' => $passenger->getServiceNo(),
            'start_date' => $_POST['from_date'],
            'end_date' => $_POST['to_date'],
            'state' => $passenger->getState(),
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
            $pass_tracker->createPass($details);
        }
        header("Location: ../passenger_request_pass.php?{$url_extention}");
    }


