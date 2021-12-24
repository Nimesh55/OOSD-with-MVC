<?php

  require_once "dbh.class.php";
	class Passenger_Model extends Dbh
	{
		private $record;
		public function setRecord($user_id): void
		{
			$stmt = $this->connect()->query("SELECT * FROM users JOIN passenger ON Passenger.passenger_no = Users.account_no WHERE Users.user_id = $user_id");
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
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array(
          ':fn' => htmlentities($details['fname']),
          ':ln' => htmlentities($details['lname']),
          ':addr' => htmlentities($details['address']),
          ':em' => htmlentities($details['email']),
          ':tel' => htmlentities($details['telephone']),
          ':pas_no' => htmlentities($details['passenger_no'])));
    }

	}
 ?>
