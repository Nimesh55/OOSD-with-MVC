<?php
set_time_limit(0);

$file_path='../upload/'.$_REQUEST['fname'];
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
File_Controller::getInstance()->downloadFile($file_path, ''.$_REQUEST['name'].'', 'text/plain');