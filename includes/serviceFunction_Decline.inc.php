<?php
// Button presses from Service approval View
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

if (isset($_SESSION['decline'])) {
    EssentialServiceTracker::getInstance()->declineService($_SESSION['decline']);
    $_SESSION['decline'] = null;
}

if (isset($_GET['x'])) {
    $x = $_GET['x'];
    if ($x == 'r') {
        header("location: ../administrator_approved_essential_services.php");
    }
    else if ($x == 'd' ) {
        header("location: ../administrator_pending_essential_services.php");
    }
}
