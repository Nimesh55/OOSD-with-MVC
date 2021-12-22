<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Board_Manager_Controller extends Board_Manager_Model{

  public function viewPage($page){
    if($page=="home"){
      header("location:../board_manager_home.php");
    }elseif($page=="pending_passes"){
      header("location:../board_manager_home.php");
    }elseif($page=="pass_details"){

    }elseif($page=="conductor_details"){

    }elseif($page=="create_conductor"){
      header("location:../board_manager_conductor_details.php");
    }elseif($page=="allocate_vehicle"){

    }
  }




}

?>

  
  

}

?>
