<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
Timer::getInstance()->update_All_Expire_State(); // Runs Expire method