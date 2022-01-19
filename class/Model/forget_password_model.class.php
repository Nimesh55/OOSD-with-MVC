<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/Model/dbh.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Forget_Password_Model extends Dbh
{
    protected function getContactDetails($account_type, $account_no)
    {
        $query = -1;
        switch ($account_type) {
            case 0:
                $query = "SELECT Email,telephone FROM passenger WHERE passenger_no=?";
                break;

            case 1:
                $query = "SELECT Email,telephone FROM conductor WHERE conductor_no=?";
                break;

            case 2:
                $query = "SELECT Email,telephone FROM executive WHERE executive_no=?";
                break;
            default:
                break;
        }

        if ($query!=-1){
            $stmt = $this->connect()->prepare($query);
            $record = $stmt->execute([htmlentities($account_no)]);
            $results = $stmt->fetch($record);
            return $results;
        }
        return -1;

    }

    protected function getuserdetails($user_id)
    {
        $query = "SELECT account_type,account_no FROM users WHERE user_Id=?";
        $stmt = $this->connect()->prepare($query);
        $record = $stmt->execute([htmlentities($user_id)]);
        $results = $stmt->fetch($record);
        return $results;
    }

    protected function getSMS()
    {

    }
}

//$f = new Forget_Password_Model();
//$r  = $f->getuserdetails('33');
//if(!empty($r) && $r['account_type']<3){
//    echo $f->getCommiunicationDetails($r['account_type'],$r['account_no']);
//}
//if(!empty($r) && $r['account_type']=>3){
//    return "unchangerble";
//}