<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

$type = $_GET['account_type'];
$change_password_controller = new Change_Password_Controller();

if (isset($_POST["change"])) {

    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $password_repeat = $_POST["retype_password"];

    $change_password_controller->updatePassword($current_password,$new_password, $password_repeat, $type);

}else if (isset($_POST["cancel"])) {
    $change_password_controller->returnPage($type);
}
