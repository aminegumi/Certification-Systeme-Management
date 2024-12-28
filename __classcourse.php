<?php
class course{
    private $idcourse;
    private $nomcourse;
    // private $datelimitecourse;
    private $linkcourse;
    public $Id_mat;
    public static $SuccMsg="";
    public static $ErrMsg="";

    public function __construct($nomcourse,$linkcourse,$Id_mat){
        $this->nomcourse = $nomcourse;
        $this->linkcourse=$linkcourse;
        $this->Id_mat=$Id_mat;
    }

    public function insertcourse($tableName,$conn){
        $sql = "INSERT INTO $tableName (nom_Course,linkTOcourse,Id_mat)
        VALUES ('$this->nomcourse','$this->linkcourse','$this->Id_mat')";
        if (mysqli_query($conn, $sql)) {
        self::$SuccMsg= "New record created successfully";
        } else {
        self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    public static function selectAllcourses($tableName,$conn){
        $sql = "SELECT id_Course, nom_Course , linkTOcourse , Id_mat FROM $tableName ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $data=[];
            while($row = mysqli_fetch_assoc($result)) {
            
                $data[]=$row;
            }
            return $data;
        }
    }
    public static function selectcourseById($tableName,$conn,$idc){
        $sql = "SELECT * FROM $tableName  WHERE id_Course='$idc'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
        
    }

public static function selectCoursesByMatiereId($conn,$idf){
    $sql = "SELECT * FROM course WHERE id_Mat='$idf'";
    $result = mysqli_query($conn, $sql);
    $data=[];
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
    }
    return $data;
}


public static function updatecourse($course,$tableName,$conn,$id){
    $sql = "UPDATE $tableName SET nom_Course = '$course->nomcourse', linkTOcourse = '$course->linkcourse', Id_mat = '$course->Id_mat' WHERE id_Course='$id'";
        if (mysqli_query($conn, $sql)) {
        self::$SuccMsg= "New record updated successfully";
        } else {
            self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
        }


}

public static function deletecourse ($tableName,$conn,$id){
    $sql = "DELETE FROM $tableName WHERE id_Course='$id'";

    if (mysqli_query($conn, $sql)) {
    self::$SuccMsg= "Record deleted successfully";
    } else {
    self::$ErrMsg= "Error deleting record: " . mysqli_error($conn);
    }

    }
}
?>