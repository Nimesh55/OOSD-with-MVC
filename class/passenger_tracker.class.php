<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
//    session_start();

    class Passenger_Tracker extends Tracker
    {
        private static  $instance = null;
        private Passenger $passenger;
        private Passenger_Controller $passenger_ctrl;

        /**
         * @param Passenger $passenger
         */
        private function __construct()
        {
            $this->passenger_ctrl = new Passenger_Controller();
        }

        public static function getInstance(){
            if (self::$instance == null) {
                self::$instance = new Passenger_Tracker();
            }
            return self::$instance;
        }

        public function getPassengerByPassengerNo($passenger_no){
            // FIX THIS ERROR###
            $passenger_model = new Passenger_Model();
            return $this->getPassenger($passenger_model->getUserId($passenger_no));
        }

        public function getPassenger($user_id)
        {
            $this->passenger = Passenger::getInstance($user_id);
            return $this->passenger;
        }

//         public function creatPassenger($details)
//         {
//             $passenger_controller = new Passenger_Controller();
//             $error = '';
//             $error = $passenger_controller->validate($details);
// //            echo $error;
//             if (empty($error)) {

//                 //creat passenger object
//                 $signup_controller = new Signup_Controller(
//                     $details['fname'],
//                     $details['lname'],
//                     $details['user_id'],
//                     $details['address'],
//                     $details['email'],
//                     $details['telephone'],
//                     $details['password'],
//                     $details['password_repeat'],
//                     "",
//                     0,
//                     "",
//                     "",
//                     0
//                 );
//                 $signup_controller->signupUser();

//                 return $error;
//                 //return $error
//             } else {
//                 //return error
//                 return $error;
//             }


//         }

        public function createPassenger($passenger_no){
            $passengerdetails = $this->passenger_ctrl->getPassenger($passenger_no);
            $passengerObj = new Passenger2($passengerdetails);
            return $passengerObj;
        }
    }