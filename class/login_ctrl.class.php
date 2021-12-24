<?php
// Controller in MVC
class Login_Controller extends Login
{
    private $uid;
    private $password;


    public function __construct($uid, $password)
    {
        $this->uid = $uid;
        $this->password = $password;
    }

    public function loginUser()
    {
        // check for all the errors using the helper functions
        if ($this->emptyField() == false) {
            // error msg here
            header("location: ../test.php?error=emptyfield");
            exit();
        }

        $userTypeVal = $this->getUser($this->uid, $this->password);

        switch ($userTypeVal) { // Complete this wthen users are done
            case '0':
                header("location: ../passenger_home.php");
                break;
            case '1':
                header("location: ../conductor_home.php");
                break;
            case '2':
                header("location: ../executive_home.php");
                break;
            case '3':
                header("location: ../board_manager_home.php");
                break;
            case '4':
                header("location: ../administrator_home.php");
                break;
            default:
                header("location: ../test.php?error=nouser");
                break;
        }
    }

    // Error handling methods
    private function emptyField()
    {
        // for executive handle company_id and company_name seperately by getting the user type       
        if (empty($this->uid) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
