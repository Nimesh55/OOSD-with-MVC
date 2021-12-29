<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    session_start();

    class Passenger_Tracker{
        private Passenger $passenger;

        public function setPassenger($user_id){$this->passenger = Passenger::getInstance($user_id);}

        public function getDetails(){
            $details = array(
                $this->passenger->getUserId(),
                $this->passenger->getFirstName(),
                $this->passenger->getLastName(),
                $this->passenger->getAddress(),
                $this->passenger->getTelephone(),
                $this->passenger->getServiceNo(),
                $this->passenger->getStaffId(),
                $this->passenger->getEmail(),
                $this->passenger->getState()
            );
            return $details;
        }


        public function creatPassenger($details){
            $passenger_controller = new Passenger_Controller();
            $error = '';
            $error=$passenger_controller->validate($details);
            if(empty($error)){

                //creat passenger object
                //return $error
            }else{
                //return error
            }


        }



    }
    $passenger_tracker = new Passenger_Tracker();
    $passenger_tracker->setPassenger(00001);
    echo "<pre>";
    print_r($passenger_tracker->getDetails());
    print_r($_SESSION);
    echo "</pre>";

    $p=new Passenger_Controller();







