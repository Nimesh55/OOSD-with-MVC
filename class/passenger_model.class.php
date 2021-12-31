<?php
  require_once "dbh.class.php";
	class Passenger_Model extends Dbh
	{
//		private $record;

//		public function setRecord($user_id): void
//		{
//			$stmt = $this->connect()->query("SELECT * FROM users JOIN passenger ON Passenger.passenger_no = Users.account_no WHERE Users.user_id = $user_id");
////			$this->record = $stmt->fetch();
//		}

		protected function getRecord($user_id)
		{
//            echo "$user_id";
            $stmt = $this->connect()->query("SELECT * FROM users JOIN passenger ON Passenger.passenger_no = Users.account_no WHERE Users.user_id = '$user_id'");
            return $stmt->fetch();
//			return $this->record;
		}

		protected function changeDetails($details)
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
//		  		$this->removeObj();
		}
		protected function setCompanyDetails($service_no,$staff_id){
			$sql = "UPDATE Passenger SET staff_id = :stid,service_no= :sno,state= :st  WHERE passenger_no = :pas_no";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(array(
				':stid' => htmlentities($staff_id),
				':sno' 	=> htmlentities($service_no),
				':st' 	=> 1,
				':pas_no' => htmlentities($_SESSION['account_no'])));
//			$this->removeObj();
		}
		protected function unSetCompanyDetails(){
			$sql = "UPDATE Passenger SET staff_id = :stid,service_no= :sno,state= :st  WHERE passenger_no = :pas_no";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(array(
				':stid' => 0,
				':sno' 	=> 0,
				':st' 	=> 0,
				':pas_no' => htmlentities($_SESSION['account_no'])));
//			$this->removeObj();
		}


//		private function removeObj(){
//			$this->setRecord($_SESSION['user_Id']);
//			unset($_SESSION['instance']);
//		}

		protected function getUserId($passenger_no){

			$stmt = $this->connect()->query("SELECT * FROM users JOIN passenger 
    							ON Passenger.passenger_no = Users.account_no 
								WHERE Passenger.passenger_no = $passenger_no AND Users.account_type = 0 ");
			$row = $stmt->fetch();
			return $row['user_id'];

		}

		// Sets passenger state by taking passenger_no and state
		protected function setPassengerStateinTable($state, $passenger_no){
			$sql = "UPDATE passenger SET state= :st  WHERE passenger_no = :pas_no";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(array(
				':st' 	=> $state,
				':pas_no' => $passenger_no));
		}

		//Gets all the details to create a Passenger Object
//		protected function getPassengerDetails($passenger_no){
//			$stmt1 = $this->connect()->prepare("SELECT * FROM passenger WHERE passenger_no = ?");
//			$stmt1->execute(array($passenger_no));
//			$x = $stmt1->fetch();
//			$stmt1 = $this->connect()->query("SELECT user_id FROM users WHERE account_type = 0 AND account_no =$passenger_no");
//			$y = $stmt1->fetch();
//			$details = array(
//			 'user_id'=>$y['user_id'],
//			 'passenger_no'=>$x['passenger_no'],
//			 'first_name'=>$x['first_name'],
//			 'last_name'=>$x['last_name'],
//			 'address'=>$x['address'],
//			 'telephone'=>$x['telephone'],
//			 'service_no'=>$x['service_no'],
//			 'staff_id'=>$x['staff_id'],
//			 'email'=>$x['email'],
//			 'state' =>$x['state'] );
//
//			 return $details;
//			}
	}