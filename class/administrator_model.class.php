<?php

include "dbh.class.php";

  class Administrator_model extends Dbh{

    protected function getNumberOfPendingCompanies(){
      $stmt = $this->connect()->prepare("SELECT count(*) FROM service WHERE state=1");
      $stmt->execute();
      $count1 = $stmt->fetchColumn();
      return $count1;
    }

    protected function getNumberofServicesApproved(){
      $stmt = $this->connect()->prepare("SELECT count(*) FROM service WHERE state=2");
      $stmt->execute();
      $count2 = $stmt->fetchColumn();
      return $count2;
    }

    protected function getNumberofIssuedPasses(){
      $stmt = $this->connect()->prepare("SELECT count(*) FROM pass");
      $stmt->execute();
      $count3 = $stmt->fetchColumn();
      return $count3;
    }
  }