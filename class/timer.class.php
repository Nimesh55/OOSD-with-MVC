<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Timer
{

    private static  $instance = null;
    private $passTracker;
    private $bookingTracker;

    private function __construct()
    {
        $this->passTracker = Pass_Tracker::getInstance();
        $this->bookingTracker = Booking_Tracker::getInstance();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Timer();
        }
        return self::$instance;
    }

    private function updateStateinPasses()
    {
        $change=0;
        $passesArray = $this->passTracker->getAllPasses();
        $current = date('Y-m-d');
        foreach ($passesArray as $pass) {
            $passEndDate = $pass->getEndDate();
            if ($current > $passEndDate) {
                $this->passTracker->setPassStateExpired($pass->getPassNo());
                $change++;
            }
        }
        return $change;
    }

    private function updateStateinBookings()
    {
        $change=0;
        $bookingArray = $this->bookingTracker->getBookingsArray();
        $curDate = date('Y-m-d');
        foreach ($bookingArray as $booking) {
            $bookingEnd = $booking->getEndDate();
            if ($curDate > $bookingEnd && $booking->getState()!=2) {
                $this->bookingTracker->setbookingStateExpired($booking->getBookingNo());
                $change++;
            }
        }
        return $change;
    }

    public function update_All_Expire_State()
    {
        $passes = $this->updateStateinPasses();
        $bookings = $this->updateStateinBookings();

        //Add to a log
        $log  = "Expiration System Ran on : ".date("F j, Y, g:i a")." ; Passes Changed : ".$passes." | Bookings Changed : ".$bookings."\n";
        file_put_contents('./timerLog.txt', $log, FILE_APPEND);
    }
}

Timer::getInstance()->update_All_Expire_State(); // Runs Expire method