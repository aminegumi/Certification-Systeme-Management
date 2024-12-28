<?php
class courseT{
    private $idcourseTeach;
    // private $nomcourseTeach;
    // private $datelimitecourseTeach;
    // private $linkcourseTeach;
    public $idCourse;
    public $idteach;
    public static $SuccMsg="";
    public static $ErrMsg="";

    public function __construct($idCourse,$idteach){
        // hta hna nfss le3ba dyal id li f lgroupe
        $this->idCourse = $idCourse;
        $this->idteach=$idteach;
    }
    public function insertcourseTeach($tableName,$conn){

    // insert courseTeach into the database 
    $sql = "INSERT INTO $tableName (IDcrs,IDteach)
    VALUES ('$this->idCourse','$this->idteach')";
    if (mysqli_query($conn, $sql)) {
    self::$SuccMsg= "New record created successfully";
    } else {
    self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
    public static function selectAllcourseTeachs($tableName,$conn){
    // hna wach nhiyd id_courseTeach nkhliw ghi nom li ytl3 nfss remark?
    $sql = "SELECT * FROM $tableName ";
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
public static function selectcourseTeachById($tableName,$conn,$idc){
    $sql = "SELECT * FROM $tableName  WHERE id_courseTeach='$idc'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);

    }
    return $row;
}

public static function selectcoursedelievByteachId($tableName,$conn,$idf){
    //select a student by id, and return the row result
    $sql = "SELECT * FROM $tableName  WHERE IDteach='$idf'";
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


public static function updatecourseTeach($courseTeach,$tableName,$conn,$id){
    //update a courseTeach of $id, with the values of $courseTeach in parameter
    //and send the user to read.php <<<<<< Update  ?
    $sql = "UPDATE $tableName SET nom_courseTeach = '$courseTeach->nomcourseTeach', linkTOcourseTeach = '$courseTeach->linkcourseTeach', IDteach = '$courseTeach->idteach' WHERE id_courseTeach='$id'";
        if (mysqli_query($conn, $sql)) {
        self::$SuccMsg= "New record updated successfully";
        header("Location:reads.php");
        } else {
            self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
        }


}

public static function deletecourseTeach ($tableName,$conn,$id){
    //delete a courseTeach by his id, and send the user to read.php
    $sql = "DELETE FROM $tableName WHERE id_courseTeach='$id'";

    if (mysqli_query($conn, $sql)) {
    self::$SuccMsg= "Record deleted successfully";
    header("Location:reads.php");
    } else {
    self::$ErrMsg= "Error deleting record: " . mysqli_error($conn);
    }

    }
}
?>