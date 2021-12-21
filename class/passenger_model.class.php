<?php

	/**
	 *
	 */
  require_once "dbh.class.php";
	class Passenger_Model extends Dbh
	{
		private $record;
		function __construct($passenger_no)
		{
			$stmt = $this->connect()->query("SELECT * FROM users JOIN passenger ON Passenger.passenger_no = Users.account_no WHERE Users.user_id = $passenger_no");
			$this->record = $stmt->fetch();
		}
		public function getRecord()
		{
			return $this->record;
		}

    public function changeDetails($details)
    {
      $sql = "UPDATE Passenger SET first_name = :fn, last_name = :ln, address = :addr,
                       email = :em, telephone = :tel WHERE passenger_no = :pas_no";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ':fn' => htmlentities($details['Firstname']),
          ':ln' => htmlentities($details['Lastname']),
          ':addr' => htmlentities($details['Address']),
          ':em' => htmlentities($details['Email']),
          ':tel' => htmlentities($details['Telephone']),
          ':pas_no' => htmlentities($details['passenger_no'])));
    }
	}
 ?>
