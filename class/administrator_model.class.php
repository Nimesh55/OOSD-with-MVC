<?php

include "dbh.class.php";

class Administrator_model extends Dbh
{

  protected function getNumberOfPendingCompanies()
  {
    $stmt = $this->connect()->prepare("SELECT count(*) FROM service WHERE state=1");
    $stmt->execute();
    $count1 = $stmt->fetchColumn();
    return $count1;
  }

  protected function getNumberofServicesApproved()
  {
    $stmt = $this->connect()->prepare("SELECT count(*) FROM service WHERE state=2");
    $stmt->execute();
    $count2 = $stmt->fetchColumn();
    return $count2;
  }

  protected function getNumberofIssuedPasses()
  {
    $stmt = $this->connect()->prepare("SELECT count(*) FROM pass");
    $stmt->execute();
    $count3 = $stmt->fetchColumn();
    return $count3;
  }

  protected function getPendingEssentialServices()
  {
    $stmt = $this->connect()->prepare("SELECT * FROM service WHERE state = 1 ORDER BY service_no;");
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  protected function getApprovedEssentialServices()
  {
    $stmt = $this->connect()->prepare("SELECT * FROM service WHERE state = 2 ORDER BY service_no;");
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  protected function getEmailSettings(){
      $stmt = $this->connect()->prepare("SELECT * FROM email;");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row;
  }
  protected function addNewEmailSettings($email,$password,$port){
      $query1 = "INSERT INTO email (email,password,port) VALUES (?, ?, ?);";
      $stmt1 = $this->connect()->prepare($query1);

      $stmt1->execute(array(
             htmlentities($email),
             htmlentities($password),
             htmlentities($port)
      ));
  }

  protected function editEmailSettings(){
      echo "Edit action";
      $sql = "UPDATE email SET email = :email, password = :password, port = :port WHERE row_id = 0";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array(
          ':email' => htmlentities($_POST['email']),
          ':password' => htmlentities($_POST['password']),
          ':port' => htmlentities($_POST['port'])));
  }


}
