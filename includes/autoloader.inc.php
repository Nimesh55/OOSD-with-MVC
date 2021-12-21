<?php

  function autoloader($className)
  {
    $path="../class";
    $extension = ".class.php";
    $fullPath = $path."/".strtolower($className).$extension;
    // echo "$fullPath";

    if (file_exists($fullPath)) {
      require_once($fullPath);
    }
    else{
      die($fullPath." is not found!!!");
    }
  }
  spl_autoload_register('autoloader');


 ?>
