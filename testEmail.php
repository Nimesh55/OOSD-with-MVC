<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

//this is how email is sent
    $address_list  = array("yasith.19@cse.mrt.ac.lk"
//                            "nimeshariyarathne.19@cse.mrt.ac.lk",
//                            "achira.19@cse.mrt.ac.lk",
//                            "sathira.19@cse.mrt.ac.lk"
                                    );
//     foreach ($address_list as $address){
//         $email = new Email($address,"test 07","Test: Email Notification");
//         $email_client_adapter = Email_Client_Adapter::getInstance();
//         $email_client_adapter->sendEmail($email);


// //        header("location:test.php");
// }

$contactDetailsArray = array();
array_push($contactDetailsArray, "+94778665718");
array_push($contactDetailsArray, "achira.19@cse.mrt.ac.lk");
$mesb = "This is to inform \n you that your pass is Processing";
$ems = "Subject Email Testing Cyber Ducks";

// Notification_handler::sendNotification($contactDetailsArray, $mesb, $ems);
Notification_handler::setupNotification($contactDetailsArray[1], $contactDetailsArray[0],[0,1,2,3,4,5,6,7]);
