<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Executive_View extends Executive_Model{
    private $executivectrl;
    private $executiveobj;
    private $pass_tracker;
    private $booking_tracker;
    private $conductor_tracker;

    public function __construct(){
        $this->executivectrl = new Executive_Controller();
        $this->executiveobj = $this->executivectrl->setUpDetails();
        $this->pass_tracker = Pass_Tracker::getInstance();
        $this->booking_tracker = Booking_Tracker::getInstance();
        $this->conductor_tracker = Conductor_Tracker::getInstance();

    }

    public function getHomeDetails()
    {

        $details=array(
            "name"=> $this->executiveobj->getFirstName()." ".$this->executiveobj->getLastName(),
            "passenger_count" => $this->getPassengerCountFromService($this->executiveobj->getServiceNo()),
            "requested_passes_count" => $this->getRequestedPassesCount($this->executiveobj->getServiceNo()),
            "approved_passes_count" => $this->getApprovedPassesCount($this->executiveobj->getServiceNo()),
            "service_name"=>$this->getServiceName($this->executiveobj->getServiceNo()),
            "service_number"=>$this->executiveobj->getServiceNo());
        return $details;

    }

    public function getPassDetailsDetails(){
        $details=array(
            "name"=> $this->executiveobj->getFirstName()." ".$this->executiveobj->getLastName(),
            "service_passes" => $this->pass_tracker->getPassesArrayForService($this->executiveobj->getServiceNo()),
            "service_passes_count" => count($this->pass_tracker->getPassesArrayForService($this->executiveobj->getServiceNo())));
        return $details;
    }

    public function getPassDetailsViewDetails($pass_no){
        $pass = $this->pass_tracker->getPass($pass_no);
        $status = $this->executivectrl->getPassStatus($pass->getState());
        $details=array(
            "name"=> $this->executiveobj->getFirstName()." ".$this->executiveobj->getLastName(),
            "passenger_no" => $pass->getPassengerNo(),
            "route" => $pass->getBusRoute(),
            "time_slot" => $pass->getStartDate()." to ".$pass->getEndDate(),
            "reason" => $pass->getReason(),
            "status" => $status);
        return $details;
    }

    public function getDetails()
    {
        $details=array(
            "first_name"=> $this->executiveobj->getFirstName(),
            "last_name"=> $this->executiveobj->getLastName(),
            "address"=> $this->executiveobj->getAddress(),
            "email"=> $this->executiveobj->getEmail(),
            "telephone"=> $this->executiveobj->getTelephone());
        return $details;

    }

    public function getBookingDetailsDetails(){
        $details=array(
            "name"=> $this->executiveobj->getFirstName()." ".$this->executiveobj->getLastName(),
            "service_bookings" => $this->booking_tracker->getBookingsArrayForService($this->executiveobj->getServiceNo()));
        return $details;
    }

    public function getBookingViewDetails($booking_no){
        $booking = Booking_Tracker::getInstance()->getBooking($booking_no);
        $booking_state = $booking->getState();
        $status = $this->executivectrl->getPassStatus($booking_state);

        //Modify this after getting conductor no correctly
//        $conductor = $this->conductor_tracker->getConductor($booking->getBookedConductorNo());
//        $bus_no = $this->executivectrl->getBusNo($conductor->getvehicle_no(), $booking_state);
        $bus_no=null;
        $details=array(
            "booking_no" => $booking->getBookingNo(),
            "pickup_district" => $booking->getPickupDistrict(),
            "destination_district"=> $booking->getDestinationDistrict(),
            "start_date" => $booking->getStartDate(),
            "end_date" => $booking->getEndDate(),
            "state" => $booking_state,
            "bus_no" => $bus_no,
            "status"=> $status);
        return $details;
    }

    public function getPassesDetails($service_no)
    {
        $details= $this->getPasses($service_no);
        return $details;

    }

    public function getPassengerAll($service_no){
        $passenger_array = $this->executivectrl->getAllPassengers($service_no);
        return $passenger_array;
    }

    public function getEssentialServiceDetails($id){
        return $this->executivectrl->getServiceStatus($id);
    }

}