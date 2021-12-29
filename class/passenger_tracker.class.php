<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    session_start();

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

        public function getPassenger($user_id)
        {
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









