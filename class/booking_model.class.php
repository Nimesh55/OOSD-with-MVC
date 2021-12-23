<?php

require_once "dbh.class.php";
class Booking_Model extends Dbh
{
    private $record;

    function __construct($booking_no)
    {
        $stmt = $this->connect()->query("SELECT * FROM booking WHERE booking_no = $booking_no");
        $this->record = $stmt->fetch();
    }

    public function getRecord()
    {
        return $this->record;
    }

    public function updateBookingState($new_state)
    {
        $sql = "UPDATE booking SET state=$new_state where booking_no={$this->getRecord()['booking_no']}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }
}

?>