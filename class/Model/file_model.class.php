<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/dbh.class.php";
class File_Model extends Dbh
{
    private static  $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new File_Model();
        }
        return self::$instance;
    }

    protected function getFileDetailsFromModel($file_no){
        $stmt = $this->connect()->prepare("SELECT * FROM files where file_no = ?");
        $stmt->execute(array($file_no));
        $file_det = $stmt->fetch(PDO::FETCH_ASSOC);
        return $file_det;
    }

    private function getFilesLastFileNo(){
        $stmt = $this->connect()->prepare("SELECT file_no FROM files ORDER BY file_no DESC ");
        $stmt->execute();
        $last_no = $stmt->fetch();
        return $last_no['file_no'];
    }

    protected function uploadFileToDB(){
        $name=$_FILES['file']['name'];
        $temp=$_FILES['file']['tmp_name'];
        $fname = date("YmdHis").'_'.$name;
        // Check if file exist
        $chk = $this->connect()->query("SELECT * FROM  files where name = '$name' ")->rowCount();
        if($chk){
            $i = 1;
            $c = 0;

            while($c == 0){
                $i++;
                $reversedParts = explode('.', strrev($name), 2);
                // New Filename
                $tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
                // Check if new file name exist in the database
                $chk2 = $this->connect()->query("SELECT * FROM  files where name = '$tname' ")->rowCount();
                if($chk2 == 0){
                    $c = 1;
                    $name = $tname;
                }
            }
        }
        $move =  move_uploaded_file($temp,"../upload/".$fname);

        if($move){
            $query=$this->connect()->query("insert into files(name,fname)values('$name','$fname')");
            if($query){
                unset($_FILES['file']);
                return $this->getFilesLastFileNo();
            }
            else{
                die($this->connect()->errorInfo());
            }
        }

    }

}