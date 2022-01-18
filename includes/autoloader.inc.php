<?php

  function autoloader($className)
  {

//    categorize
//    echo $className;

    $classNameParts = explode("_",$className);
//    echo "<pre>";
////    print_r($classNameParts);
//    echo "</pre>";

    $folder = "";
    if(strcmp(end($classNameParts),"Model")==0){
      $folder = "/Model";
    }else if(strcmp(end($classNameParts),"View")==0){
      $folder = "/View";
    }else if(strcmp(end($classNameParts),"Controller")==0){
      $folder = "/Controller";
    }else{
      $folder="";
    }

    // chdir($_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/OOSD-with-MVC");
    $path=$_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class{$folder}";
    $extension = ".class.php";
    $fullPath = $path."/".strtolower($className).$extension;
//    echo "{$fullPath}<br>";

    if (file_exists($fullPath)) {
      require_once($fullPath);
    }
    else{
      die($fullPath." is not found!!!");
    }
  }
  spl_autoload_register('autoloader');



 ?>
