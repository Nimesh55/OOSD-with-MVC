+<?php

	/**
	 *
	 */
	class Passenger_Model extends Passenger
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
	}
 ?>
