<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

//this is how email is sent
    $address_list  = array("yasith.19@cse.mrt.ac.lk"
//                            "nimeshariyarathne.19@cse.mrt.ac.lk",
//                            "achira.19@cse.mrt.ac.lk",
//                            "sathira.19@cse.mrt.ac.lk"
                                    );
    foreach ($address_list as $address){
        $email = new Email($address,"test 07","Test: Email Notification");
        $email_client_adapter = Email_Client_Adapter::getInstance();
        $email_client_adapter->sendEmail($email);
//        header("location:test.php");
}
