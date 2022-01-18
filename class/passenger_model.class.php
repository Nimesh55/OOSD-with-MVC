<?php
//  require_once "../dbh.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/dbh.class.php";

	class Passenger_Model extends Dbh
	{
		protected function getRecord($user_id)
		{
            $stmt = $this->connect()->query("SELECT * FROM users JOIN passenger ON Passenger.passenger_no = Users.account_no WHERE Users.user_id = '$user_id'");
            return $stmt->fetch();
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
		}

		protected function setCompanyDetails($service_no,$staff_id){
			$sql = "UPDATE Passenger SET staff_id = :stid,service_no= :sno,state= :st  WHERE passenger_no = :pas_no";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(array(
				':stid' => htmlentities($staff_id),
				':sno' 	=> htmlentities($service_no),
				':st' 	=> 1,
				':pas_no' => htmlentities($_SESSION['account_no'])));

		}

        protected function setCompanyDetailsWithFile($service_no,$staff_id, $last_no){

            $sql = "UPDATE Passenger SET staff_id = :stid,service_no= :sno,state= :st,file_no=:fno  WHERE passenger_no = :pas_no";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array(
                ':stid' => htmlentities($staff_id),
                ':sno' 	=> htmlentities($service_no),
                ':st' 	=> 1,
                ':fno' => $last_no,
                ':pas_no' => htmlentities($_SESSION['account_no'])));

        }

		protected function unSetCompanyDetails(){
            $sql = "UPDATE Passenger SET staff_id = :stid,service_no= :sno,state= :st,file_no=:fno  WHERE passenger_no = :pas_no";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(array(
				':stid' => 0,
				':sno' 	=> 0,
				':st' 	=> 0,
                ':fno' => null,
				':pas_no' => htmlentities($_SESSION['account_no'])));

		}

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

        protected function getAllPassengersInServiceFromModule($service_no){
            $stmt = $this->connect()->query("SELECT * FROM passenger WHERE service_no = '$service_no'");
            return $stmt->fetchAll();
        }

		protected function setPassengerServiceNo_model($service_no, $passenger_No){
			$sql = "UPDATE Passenger SET service_no= :sno WHERE passenger_no = :pas_no";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(array(
				':sno' 	=> $service_no,
				':pas_no' => $passenger_No));
		}
	}