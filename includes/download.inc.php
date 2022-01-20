<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

set_time_limit(0);

$file_path='../upload/'.$_REQUEST['fname'];

File_Controller::getInstance()->downloadFile($file_path, ''.$_REQUEST['name'].'', 'text/plain');