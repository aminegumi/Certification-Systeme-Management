<?php
class Progress{

    Public $idp;
    Public $idcs;
    Public $pcompleted;
    Public $punenrolled;
    Public $pinprogress;
    Public $gp;
    Public $datep;
    public static $errorMsg = "";
    public static $successMsg="";

    public function  __construct($idcs,$pcompleted,$punenrolled,$pinprogress,$gp){

    $this->idcs = $idcs;
    $this->pcompleted = $pcompleted;
    $this->punenrolled = $punenrolled;
    $this->pinprogress = $pinprogress;
    $this->gp = $gp;

    }
    public function insertProgress ($tableName,$conn){
        $sql = "INSERT INTO $tableName (idcs, pcompleted,punenrolled,pinprogress,gp)
        VALUES ('$this->idcs', '$this->pcompleted', '$this->punenrolled','$this->pinprogress','$this->gp')";
        if (mysqli_query($conn, $sql)) {
        self::$successMsg= "New record created successfully";
        
        } else {
            self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    public static function  selectAllsProgress ($tableName,$conn){
    
        //select all the student from database, and inset the rows results in an array $data[]
        $sql = "SELECT * FROM $tableName ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $data=[];
                while($row = mysqli_fetch_assoc($result)) {
                
                    $data[].=$row;
                }
                return $data;
            }
        
        }
    
    
    public static function selectProgressByCrsandGpdate($tableName,$conn,$id,$g,$d){
            //select a student by id, and return the row result
            $sql = "SELECT * FROM $tableName  WHERE idcs='$id'AND gp='$g'AND datep='$d'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            
            }
            return $row;  
    }
    public static function  selectdistinctdateProgress ($tableName,$conn){
    
        //select all the student from database, and inset the rows results in an array $data[]
        $sql = "SELECT DISTINCT datep FROM $tableName ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $data=[];
                while($row = mysqli_fetch_assoc($result)) {
                
                    $data[]=$row;
                }
                return $data;
            }
        
        }
}
?>