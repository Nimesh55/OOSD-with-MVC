<?php

require_once "dbh.class.php";
class Pass_Model extends Dbh
{
    private $record;

    function __construct($pass_no)
    {
        $stmt = $this->connect()->query("SELECT * FROM pass WHERE pass_no = $pass_no");
        $this->record = $stmt->fetch();
    }

    public function getRecord()
    {
        return $this->record;
    }

    public function updatePassState($new_state)
    {
        $sql = "UPDATE pass SET state=$new_state where service_no={$this->getRecord()['pass_no']}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }
}

?>