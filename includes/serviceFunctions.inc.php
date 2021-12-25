<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
if (isset($_SESSION['approve'])) {
    EssentialServiceTracker::getInstance()->approveService($_SESSION['approve']);
    //echo $_SESSION['approve'];
    $_SESSION['approve'] = null;
}
//header("location: ../administrator_pending_essential_services.php");

if (isset($_SESSION['decline'])) {
    EssentialServiceTracker::getInstance()->approveService($_SESSION['decline']);
    //echo $_SESSION['decline'];
    $_SESSION['decline'] = null;
}
