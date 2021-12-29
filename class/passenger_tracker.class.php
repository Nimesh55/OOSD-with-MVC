<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
//    session_start();

    class Passenger_Tracker
    {
        private static  $instance = null;
        private Passenger $passenger;

        /**
         * @param Passenger $passenger
         */
        private function __construct()
        {

        }

        public static function getInstance(){
            if (self::$instance == null) {
                self::$instance = new Passenger_Tracker();
            }
            return self::$instance;
        }

        public function getPassengerByPassengerNo($passenger_no){
            $passenger_model = new Passenger_Model();
            return $this->getPassenger($passenger_model->getUserId($passenger_no));
        }

        public function getPassenger($user_id)
        {
            unset($_SESSION['instance']);
            $this->passenger = Passenger::getInstance($user_id);
            return $this->passenger;
        }

//        public function getDetails()
//        {
//            $details = array(
//                $this->passenger->getUserId(),
//                $this->passenger->getFirstName(),
//                $this->passenger->getLastName(),
//                $this->passenger->getAddress(),
//                $this->passenger->getTelephone(),
//                $this->passenger->getServiceNo(),
//                $this->passenger->getStaffId(),
//                $this->passenger->getEmail(),
//                $this->passenger->getState()
//            );
//            return $details;
//        }

        public function creatPassenger($details)
        {
            $passenger_controller = new Passenger_Controller();
            $error = '';
            $error = $passenger_controller->validate($details);
//            echo $error;
            if (empty($error)) {

                //creat passenger object
                $signup_controller = new Signup_Controller(
                    $details['fname'],
                    $details['lname'],
                    $details['user_id'],
                    $details['address'],
                    $details['email'],
                    $details['telephone'],
                    $details['password'],
                    $details['password_repeat'],
                    "",
                    0,
                    "",
                    "",
                    0
                );
                $signup_controller->signupUser();

                return $error;
                //return $error
            } else {
                //return error
                return $error;
            }


        }
    }




//    $passenger_tracker = Passenger_Tracker::getInstance();
//    $details=array(
//    'fname' => "Yasith",
//    'lname' => "Heshan",
//    'address' => "My address",
//    'telephone'=>'0714748483',
//    'email'=>'yheshan1@gmail.com',
//    'user_id'=>'972661180v',
//    'password'=>'1997922@Test',
//    'password_repeat'=>'1997922@Test');
//
//    echo $passenger_tracker->creatPassenger($details);

//  $passenger_tracker = Passenger_Tracker::getInstance();
////  $passenger1=$passenger_tracker->getPassenger(00001);
////  $passenger2=$passenger_tracker->getPassenger(00002);
////  $passenger3=$passenger_tracker->getPassenger(00003);
////  $passenger4=$passenger_tracker->getPassenger(00004);
//  $passenger3=$passenger_tracker->getPassengerByPassengerNo(1);
//  $passenger4=$passenger_tracker->getPassengerByPassengerNo(2);
//  echo "<pre>";
////  print_r($passenger1);
////  print_r($passenger2);
//  print_r($passenger3);
//  print_r($passenger4);
//  echo "</pre>";









