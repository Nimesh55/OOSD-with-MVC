<?php

include "dbh.class.php";

  class Board_Manager extends Dbh{

    protected function getApprovedPaasesCount(){
      $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=2");
      $stmt->execute();
      $count1 = $stmt->fetchColumn();
      return $count1;
    }

    protected function getPendingPaasesCount(){
      $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=0 OR state=1");
      $stmt->execute();
      $count2 = $stmt->fetchColumn();
      return $count2;
    }

    protected function getConductorCount(){
      $stmt = $this->connect()->prepare("SELECT count(*) FROM conductor");
      $stmt->execute();
      $count3 = $stmt->fetchColumn();
      return $count3;
    }

    protected function getPendingPassesQuery(){

      $search = $this->connect()->quote($_GET['search']);
      $query = "SELECT * FROM users WHERE account_type=0 AND (user_id Like '%{$search}%')  ORDER BY user_no";
      $stmt = $this->connect()->prepare($query);
      if($stmt->execute()){
        $pending_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $record_count = $this->getPendingPaasesCount();

        $query = "SELECT * FROM pass WHERE state=1 AND (";
        for($i=0; $i<$record_count; $i++){
          $record = $pending_passes[$i];
          if($i < $record_count-1){
            $query .= " passenger_no={$record['user_no']} OR";
          } else {
            $query .= " passenger_no={$record['user_no']})";
          }
        }

        return $query;

      }else{
        return NULL;
      }      

    }

    protected function getPendingPassesCount(){
      $query = getPendingPassesQuery();
      
      if(!$query){
        $query = "SELECT * FROM pass WHERE state=1";
      }
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      $pending_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      return $pending_passes;
    }

  }