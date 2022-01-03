<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

//this is how email is sent
    $address_list  = array("yasith.19@cse.mrt.ac.lk",
                            "nimeshariyarathne.19@cse.mrt.ac.lk",
                            "achira.19@cse.mrt.ac.lk",
                            "sathira.19@cse.mrt.ac.lk"
                                    );
    foreach ($address_list as $address){
        $email = new Email("safetansit@gmail.com",$address,"test 03","Test: Email Notification");
        $email->sendEmail();
        header("location:test.php");
}
