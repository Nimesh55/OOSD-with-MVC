<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Board_Manager_Controller extends Board_Manager_Model
{

    //    private $pass_tracker;
    //    private $booking_tracker;
    //    private $conductor_tracker;
    //    private $passenger_tracker;

    public function __construct()
    {
        //        $this->pass_tracker = Pass_Tracker::getInstance();
        //        $this->booking_tracker = Booking_Tracker::getInstance();
        //        $this->conductor_tracker = Conductor_Tracker::getInstance();
        //        $this->passenger_tracker = Passenger_Tracker::getInstance();
    }

    public function approvePass($pass_no)
    {
        $_SESSION['success'] = "Pass approved successfully";
        $pass = Pass_Tracker::getInstance()->upgradePassState($pass_no);
        $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($pass->getPassengerNo());
        $param = [1, $passenger->getUserId(), $pass->getPassNo(), $pass->getBusRoute(), $pass->getStartDate(), $pass->getEndDate()];
        // Final Approval Notification
        Notification_handler::setupNotification($passenger->getEmail(), $passenger->getTelephone(), $param);
        header("Location: ../board_manager_pending_passes.php");
    }

    public function declinePass($pass_no)
    {
        $_SESSION['success'] = "Pass declined successfully";
        $pass = Pass_Tracker::getInstance()->declinePass($pass_no);
        $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($pass->getPassengerNo());
        $param = [2, $pass->getPassNo()];
        // Final Decline Approval Notification
        Notification_handler::setupNotification($passenger->getEmail(), $passenger->getTelephone(), $param);
        header("Location: ../board_manager_pending_passes.php");
    }

    public function removePass($pass_no)
    {
        Pass_Tracker::getInstance()->declinePass($pass_no);
        $_SESSION['success'] = "Pass removed successfully";

        $pass = Pass_Tracker::getInstance()->declinePass($pass_no);
        $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($pass->getPassengerNo());
        $param = [2, $pass->getPassNo()];
        // Final Decline Approval Notification
        Notification_handler::setupNotification($passenger->getEmail(), $passenger->getTelephone(), $param);

        header("Location: ../board_manager_pass_details.php");
    }

    public function checkCondcutorAccount($conductor_id)
    {
        // $pattern = "/1111/i";
        // if (preg_match($pattern, $conductor_id))
        //     return true;
        // return false;
        return Conductor_Tracker::getInstance()->isValidConductor($conductor_id);
    }

    public function checkNumbersOnly($conductor_id)
    {
        $pattern = "/^\d+$/";
        if (preg_match($pattern, $conductor_id))
            return true;
        return false;
    }

    public function checkEmpty($conductor_id)
    {
        if (!empty($conductor_id))
            return true;
        return false;
    }

    public function validateConductorID($conductor_id)
    {
        $error = "None";
        if ($this->checkEmpty($conductor_id) == false)
            $error = "Empty Filed!!";
        else if ($this->checkCondcutorAccount($conductor_id) == false)
            $error = "Please Enter a Valid Conductor Account";
        return $error;
    }

    public function checkConductorAccountExist($conductor_obj)
    {

        if (empty($conductor_obj->getFirstName()) && empty($conductor_obj->getLastName())) {
            $error = "Conductor Account Doesn't Exist!!";
            header("Location: board_manager_conductor_details.php?show=$error");
        }
    }

    public function getBookingDateRange($booking_no)
    {
        $booking = Booking_Tracker::getInstance()->getBooking($booking_no);
        $date_range = array("start_date" => $booking->getStartDate(), "end_date" => $booking->getEndDate());
        return $date_range;
    }

    public function allocateConductorForBooking($booking_no, $conductor_no)
    {
        $booking_tracker = Booking_Tracker::getInstance();
        $bookings_for_conductor = $booking_tracker->getBookingsForConductor_FromGivenDate($conductor_no);
        $selected_booking = $booking_tracker->getBooking($booking_no);
        $available = true;
        foreach ($bookings_for_conductor as $booking) {
            if ((strtotime($booking->getStartDate()) >= strtotime($selected_booking->getStartDate()) && strtotime($booking->getStartDate()) <= strtotime($selected_booking->getStartDate())) ||
                (strtotime($booking->getEndDate()) >= strtotime($selected_booking->getEndDate()) && strtotime($booking->getEndDate()) <= strtotime($selected_booking->getEndDate()))
            ) {
                $available = false;
            }
        }
        $booking_tracker = Booking_Tracker::getInstance();
        $booking = $booking_tracker->getBooking($booking_no);
        if ($available) {
            $booking_tracker->allocateConductorForBooking($booking_no, $conductor_no);
            $booking = $booking_tracker->getBooking($booking_no);
            $executive = $booking_tracker->getExecutiveFromBookingNumber($booking_no);
            $service = $booking_tracker->getServiceFromBookingNumber($booking_no);
            $conductor = Conductor_Tracker::getInstance()->getConductorbyNumber($conductor_no);
            $param = [8, $service->getName(), $booking->getBookingNo(), $this->getBookedVehicleNo($booking), $conductor->getSeatNo(), $booking->getPickupLocation(), $booking->getDestinationLocation(), $conductor->getFirstName() . " " . $conductor->getLastName(), $conductor->getTelephone(), $booking->getPassengerCount()];
            // Allocated Booking Notification
            Notification_handler::setupNotification($executive->getEmail(), $executive->getTelephone(), $param);

            $_SESSION['success'] = "Selected vehicle allocated for booking";

            header("Location: ../board_manager_allocate_vehicle.php");
        } else {
            $_SESSION["error"] = "This vehicle currently unavailable";
            header("Location: ../board_manager_allocate_vehicle_select.php?booking_no={$booking_no}&pickup={$booking->getPickupDistrict()}");
        }
    }

    public function getBookedVehicleNo($booking)
    {
        $vehicle_no = "-";
        if ($booking->getState() == 1) {
            $conductor_obj = Conductor_Tracker::getInstance()->getConductorbyNumber($booking->getBookedConductorNo());
            $vehicle_no = $conductor_obj->getVehicleNo();
        }
        return $vehicle_no;
    }

    public function remove_Conductor($conductor_id)
    {
        $conductor_tracker = Conductor_Tracker::getInstance();
        $conductor = $conductor_tracker->getConductor($conductor_id);
        $bookings = Booking_Tracker::getInstance()->getBookingsForConductor_FromGivenDate($conductor->getConductorNo());
        foreach ($bookings as $booking) {
            $conductor_tracker->cancel_Booking($booking->getBookingNo());
        }
        $conductor_tracker->removeConductor($conductor_id);
    }
}
