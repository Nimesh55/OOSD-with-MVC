<?php

$error = $_GET['error'];
header("location: board_manager_create_conductor.php?error=$error");