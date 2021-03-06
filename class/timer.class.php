<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/class/observable.interface.php";

class Timer implements Observable
{
    private static $instance = null;
    private $Observers;

    private function __construct()
    {
        self::setTimeZone();
        $this->Observers = array();
        $this->addObservers(Pass_Tracker::getInstance());
        $this->addObservers(Booking_Tracker::getInstance());
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Timer();
        }
        return self::$instance;
    }
    public static function setTimeZone(){
        date_default_timezone_set("Asia/Colombo");
    }

    public function addObservers($observer)
    {
        array_push($this->Observers, $observer);
    }

    public function removeObservers($observer)
    {
        $observerArray = $this->Observers;
        foreach ($observerArray as $key => $object) {
            if ($object == $observer) {
                array_splice($observerArray, $key, 1);
            }
        }
    }

    public function notifyAll()
    {
        $curDate = date('Y-m-d');
        $changes = array();
        $i = 0;
        foreach ($this->Observers as $obs) {
            $changes[$i] = $obs->update($curDate);
            $i++;
        }
        return $changes;
    }

    //calls the expire methods and write the number of state changes in to timerLog.txt
    public function update_All_Expire_State()
    {
        $changes = $this->notifyAll();
        $passes = $changes[0];
        $bookings = $changes[1];

        //Add to a log
        $log  = "Expiration System Ran on : " . date("F j, Y, g:i a") . " ; Passes Changed : " . $passes . " | Bookings Changed : " . $bookings . "\n";
        file_put_contents('logs/timerLog.log', $log, FILE_APPEND);
    }

    public function my_date_diff($s_date, $e_date, $allowedDiff)
    {
        $datetime1 = date_create($s_date);
        $datetime2 = date_create($e_date);
        $interval = date_diff($datetime1, $datetime2);
        if ($interval->format('%a') > $allowedDiff) {
            return true;
        }
        return false;
    }

    public function get_current_date(){
        return date('Y-m-d');
    }

}