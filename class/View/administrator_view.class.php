
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
class Administrator_View extends Administrator_Model
{
  private $adminobj;
  private $adminctrl;

  public function __construct()
  {
    $this->adminctrl = new Administrator_Controller;
    $this->adminobj = $this->adminctrl->setUpDetails();
  }
  public function getDetails()
  {
    // Overall Pass Data
    $passes = Pass_Tracker::getInstance()->getAllPasses();
    $pendingPasses = array();
    $declinedPass = array();
    $acceptedPass = array();
    $confirmedPass = array();
    $expiredPass = array();
    foreach ($passes as $pass) {
      if ($pass->getState() == 0) {
        array_push($pendingPasses, $pass);
      } elseif ($pass->getState() == 1) {
        array_push($acceptedPass, $pass);
      } elseif ($pass->getState() == 2) {
        array_push($confirmedPass, $pass);
      } elseif ($pass->getState() == 3) {
        array_push($expiredPass, $pass);
      } elseif ($pass->getState() == 4) {
        array_push($declinedPass, $pass);
      }
    }
    // Overall Booking Data
    $bookings = Booking_Tracker::getInstance()->getBookingsArray();
    $pendingBookings = array();
    $declinedBookings = array();
    $approvedBookings = array();
    $completedBookings = array();
    $expiredBookings = array();
    foreach ($bookings as $booking) {
      if ($booking->getState() == 0) {
        array_push($pendingBookings, $booking);
      } elseif ($booking->getState() == 1) {
        array_push($approvedBookings, $booking);
      } elseif ($booking->getState() == 2) {
        array_push($expiredBookings, $booking);
      } elseif ($booking->getState() == 3) {
        array_push($declinedBookings, $booking);
      } elseif ($booking->getState() == 4) {
        array_push($completedBookings, $booking);
      }
    }

    $details = array(
      "uid" => $this->adminobj->getUid(),
      "pending" => $this->adminobj->getnumPendingCompany(),
      "approved" => $this->adminobj->getnumApprovedService(),
      "issued" => $this->adminobj->getnumIssuedPasses(),
      "pendingPass" => count($pendingPasses),
      "declinedPass" => count($declinedPass),
      "acceptedPass" => count($acceptedPass),
      "confirmed" => count($confirmedPass),
      "expiredPass" => count($expiredPass),
      "pendingBooking" => count($pendingBookings),
      "approvedBooking" => count($approvedBookings),
      "expiredBooking" => count($expiredBookings),
      "declinedBooking" => count($declinedBookings),
      "completedBooking" => count($completedBookings)
    );

    return $details;
  }

  public function getPendingRows()
  {
    return $this->getPendingEssentialServices();
  }

  public function getApprovedRows()
  {
    return $this->getApprovedEssentialServices();
  }

  public function fetchDetails($service_no)
  {
    $row = $this->adminctrl->formatForView($service_no);
    $details = array(
      "service_no" => $row['service_no'],
      "id" => $row['id'],
      "name" => $row['name'],
      "state" => $row['state'],
      "file_no" => $row['file_no']
    );
    return $details;
  }
  public function getEmailSettingsDetails()
  {
    return $this->getNotificationConfigData();
  }
}
