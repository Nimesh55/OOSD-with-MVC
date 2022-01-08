<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
    class Passenger_Request_Pass_Controller{
        private $error ;
        public function validate($details){
            if(empty($details['reason'])){
                $this->error="*Enter the reason!!!";
            }
            elseif(empty($details['bus_route'])){
                $this->error="*Enter the bus_route!!!";
            }
            elseif(empty($details['start_date'])){
                $this->error="*Enter the start date!!!";
            }
            elseif(empty($details['end_date'])){
                $this->error="*Enter the end date!!!";
            }
            elseif($details['start_date']<date("y-m-d") or $details['end_date']<$details['start_date']){
                $this->error="*Dates are invalid. Check your dates and try again!!!";
            }
            else{
                $this->error="success";
            }

            return $this->error;
        }

    }
