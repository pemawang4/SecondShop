<?php 
class Database{
    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "secondShop";
    public $con;
    public $error;
    public function __construct(){
        $this->con = new mysqli($this->host, $this->username, $this->password, $this->database);

        if(!$this->con){
            echo $this->error = $this->con->connect_error;
        }
    }

    public function select($query){
        $result = $this->con->query($query);

        if($result){
            return $result;
        }else{
            echo "Error: " . $this->con->error . __LINE__;
        }
    }

    public function insert($query){
        $insertRow = $this->con->query($query);
        if($insertRow){
            return true;
        }else{
            echo "<span class='red'>Error " . $this->con->error . __LINE__ . "</span>"; 
        }
    }

    public function delete($id, $rowId, $table){
        $query = "DELETE from $table WHERE $rowId = $id";
        $delete = $this->con->query($query);
        return true;
    }

    public function update($query){
        $updateRow = $this->con->query($query);
        if($updateRow){
            return true;
        }else{
            return "Error: " . $this->con->error . __LINE__; 
        }
    }
}

$db = new Database;

?>