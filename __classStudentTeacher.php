<?php
class Student_Teacher{
    private $IdTeacher;
    private $IdStudent;
    private $IdMat;
    public static $successMsg="";
    public static $errorMsg="";

    public function __construct($IdTeacher,$IdStudent,$IdMat){
        $this->IdTeacher=$IdTeacher;
        $this->IdStudent=$IdStudent;
        $this->IdMat=$IdMat;
    }

    public function insertStudentTeacher($tableName,$conn){
        $sql = "INSERT INTO $tableName (id_teach, id_stud, id_maT)
        VALUES ('$this->IdTeacher', '$this->IdStudent', '$this->IdMat')";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "New record created successfully";
            
            } else {
                self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    }
    public static function selectStudentByTeaId($tableName,$conn,$id,$ids){
        //select a student by id, and return the row result
        $sql = "SELECT * FROM $tableName  WHERE id_teach='$id' AND id_stud='$ids'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        return $row;
        }
          
    }
public static function getStudentsByTeacher($teacherId, $tableName, $conn) {
    $sql = "SELECT student.*
            FROM student
            JOIN $tableName ON student.id_student = $tableName.id_stud
            WHERE $tableName.id_teach = '$teacherId'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        return $students;
    } else {
        self::$errorMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}
public static function getGrpStudentsByTeacher($teacherId, $idm , $conn) {
    $sql = "SELECT DISTINCT student.groupe
            FROM student
            JOIN studentteacher ON student.id_student = studentteacher.id_stud
            WHERE studentteacher.id_teach = '$teacherId' AND studentteacher.id_maT='$idm'  ";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        return $students;
    } else {
        self::$errorMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}
public static function getSubjectByTeacher($teacherId, $tableName, $conn) {
    $sql = "SELECT DISTINCT matiere.*
            FROM matiere
            JOIN $tableName ON matiere.id_Mat = $tableName.id_maT
            WHERE $tableName.id_teach = '$teacherId'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        return $students;
    } else {
        self::$errorMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

public static function getStudentsByTeacherGrpFil($teacherId, $tableName, $conn,$idf,$idg) {
    $sql = "SELECT Distinct student.*
            FROM student
            JOIN $tableName ON student.id_student = $tableName.id_stud
            WHERE $tableName.id_teach = '$teacherId'
            AND student.filiereID = $idf
            AND student.groupe = $idg";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        return $students;
    } else {
        // Handle the error
        self::$errorMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}


public static function SelectAllStudentsWhereIDTeacher($teacherId, $tableName, $conn){
    $sql = "SELECT * FROM $tableName  WHERE id_teach='$teacherId'";
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
};


?>
