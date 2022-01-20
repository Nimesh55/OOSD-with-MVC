<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

// Tracker Class Singleton
class Conductor_Tracker extends Tracker{
    private static  $instance = null;
    private $conductor_controller;
    private $booking_tracker;
    private $essentialService_tracker;
    private $pass_tracker;

    public function __construct()
    {
        $this->conductor_controller = new Conductor_Controller();
        $this->booking_tracker = Booking_Tracker::getInstance();
        $this->essentialService_tracker = EssentialServiceTracker::getInstance();
        $this->pass_tracker = Pass_Tracker::getInstance();
    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Conductor_Tracker();
        }
        return self::$instance;  
    }

    // create conductor account by conductor ID
    public function getConductor($conductor_id){
        $conductorObj = Conductor::getInstance($conductor_id);
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
            $leaves = $this->conductor_controller->getConductorLeavesArray($conductor->getConductorNo());
            $valid = true;
            if(!empty($leaves)){
                foreach ($leaves as $leave) {
                    if (strtotime($leave['date']) >= strtotime($start_date) && strtotime($leave['date']) <= strtotime($end_date))
                        $valid = false;
                }
            }
            $bookings = $this->conductor_controller->getConductorBookings($conductor->getConductorNo());
            foreach ($bookings as $booking) {
                if ((strtotime($booking->getStartDate()) >= strtotime($start_date) && strtotime($booking->getStartDate()) <= strtotime($end_date)) ||
                    (strtotime($booking->getEndDate()) >= strtotime($start_date) && strtotime($booking->getEndDate()) <= strtotime($end_date))) {
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

    public function cancel_Booking($bookingNo)
    {
        $this->booking_tracker->cancelBooking($bookingNo);
    }

    public function getBookingsFor_ConductorNo_FromGivenDate($conductor_no)
    {
        return $this->booking_tracker->getBookingsForConductor_FromGivenDate($conductor_no);
    }

    public function removeConductor($conductor_id)
    {
        $this->conductor_controller->remove_conductor($conductor_id);
    }

    public function getPass_by_passenger_id($passenger_id)
    {
        return $this->pass_tracker->getPass_by_passenger_id($passenger_id);
    }

    public function getConductorCountToday(){
        return $this->conductor_controller->getConductorCountToday();
    }

    public function isValidConductor($conductor_id){
        return $this->conductor_controller->isConductorValid($conductor_id);
    }

    public function getConductorCount(){
        return $this->conductor_controller->getConductorCount();
    }
}

?>