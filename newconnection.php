<?php
class connection{
private $servername = "localhost";
private $username = "root";
private $password = "";
public $conn;

public function __construct(){
    $this->conn = mysqli_connect($this->servername, $this->username, $this->password);
    if (! $this->conn) {
     die("Connection failed: " . mysqli_connect_error());
    }      
}

public function createDatabase($dbName){
    $sql = "CREATE DATABASE $dbName";
        if (mysqli_query($this->conn, $sql)) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . mysqli_error($this->conn);
        }
    }
public function selectDatabase($dbName){
    //selecting a database with the conn in the class ($this->conn)
    mysqli_select_db( $this->conn,$dbName);
       // echo "Connected successfully";

}
public function createTable($query){
    //creating a table with the conn in the class ($this->conn)
    if (mysqli_query($this->conn, $query)) {
        echo "Table created successfully";
    }else{
        echo "Error creating table: " . mysqli_error($this->conn);
    }
}
}

?>