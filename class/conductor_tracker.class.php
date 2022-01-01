<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

// Tracker Class Singleton
class Conductor_Tracker extends Tracker{
    private static  $instance = null;
    private $conductor_controller;
    private $booking_tracker;
    private $essentialService_tracker;

    public function __construct()
    {
        $this->conductor_controller = new Conductor_Controller();
        $this->booking_tracker = Booking_Tracker::getInstance();
        $this->essentialService_tracker = EssentialServiceTracker::getInstance();
    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Conductor_Tracker();
        }
        return self::$instance;  
    }

    // create conductor account by conductor ID
    public function getConductor($conductor_id){
        $conductorObj = new Conductor($conductor_id);
        return $conductorObj;
    }

    //get conductor object by conductor No
    public function getConductorbyNumber($conductor_no){
        return $this->conductor_controller->getConductor_by_conductor_no($conductor_no);

    }

    public function getAvailableConductors($district_no, $start_date, $end_date){
        $conductor_arr = $this->conductor_controller->getConductorsArrayByDistrict($district_no);
        $final_conductors = array();

        foreach ($conductor_arr as $conductor_data) {
            $conductor = $this->getConductorbyNumber($conductor_data['conductor_no']);
            $leaves = $this->conductor_controller->getConductorLeavesArray($conductor->getconductor_no());
            $valid = true;
            if(!empty($leaves)){
                foreach ($leaves as $leave) {
                    if ($leave['date'] >= $start_date && $leave['date'] <= $end_date)
                        $valid = false;
                }
            }
            $bookings = $this->conductor_controller->getConductorBookings($conductor->getconductor_no());
            foreach ($bookings as $booking) {
                if (($booking->getStartDate() >= $start_date && $booking->getStartDate() <= $end_date) ||
                    ($booking->getEndDate() >= $start_date && $booking->getEndDate() <= $end_date)) {
                    $valid = false;
                }
            }

            if ($valid) {
                array_push($final_conductors, $conductor);
            }

        }
        return $final_conductors;
    }

    public function checkBooking($conductor_no, $date, $type)
    {
        return $this->booking_tracker->checkBooking($conductor_no, $date, $type);
    }
    
    public function getBookingsFor_ConductorNo($conductor_no)
    {
        return $this->booking_tracker->getBookingsForConductor($conductor_no);
    }

    // return booking object by Booking Number
    public function getBooking_by_bookingNo($bookingNo)
    {
        return $this->booking_tracker->getBooking($bookingNo);
    }

    public function getEssentialServiceName($service_no)
    {
        return $this->essentialService_tracker->getServiceName($service_no);
    }

}

?>