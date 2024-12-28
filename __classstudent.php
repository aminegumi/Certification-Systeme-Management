<?php
class student{
    private $idstudent;
    private $firstnamestudent;
    private $lastnamestudent;
    private $passwordstudent;
    public $filiereid;
    private $groupestudent;
    private $emailstudent;
    public static $errorMsg = "";
    public static $successMsg="";

public function __construct($lastnamestudent,$firstnamestudent,$passwordstudent,$filiereid,$groupestudent,$emailstudent){
    $this->lastnamestudent=$lastnamestudent;
    $this->firstnamestudent=$firstnamestudent;  
    // $this->idstudent=$idstudent;
    $this->passwordstudent=password_hash($passwordstudent,PASSWORD_DEFAULT);
    $this->filiereid=$filiereid;
    $this->groupestudent=$groupestudent;
    $this->emailstudent=$emailstudent;
}
public function insertStudent ($tableName,$conn){
    $sql = "INSERT INTO $tableName (firstname, lastname, email,password,filiereID,groupe)
    VALUES ('$this->firstnamestudent', '$this->lastnamestudent', '$this->emailstudent','$this->passwordstudent','$this->filiereid','$this->groupestudent')";
    if (mysqli_query($conn, $sql)) {
    self::$successMsg= "New record created successfully";
    
    } else {
        self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
public static function  selectAllstudent ($tableName,$conn){

    //select all the student from database, and inset the rows results in an array $data[]
    $sql = "SELECT id_student, firstname, lastname,email,filiereID,groupe FROM $tableName ";
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


public static function selectStudentById($tableName,$conn,$id){
        //select a student by id, and return the row result
        $sql = "SELECT firstname, lastname,email,filiereID,groupe FROM $tableName  WHERE id_student='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        
        }
        return $row;  
    }

    public static function selectStudentByemail($tableName,$conn,$eml){
        //select a student by id, and return the row result
        $sql = "SELECT * FROM $tableName  WHERE email='$eml'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
         return $row;  
        }
       
    }
    public static function selectStudentBygroupe($tableName,$conn,$id){
        //select a student by id, and return the row result
        $sql = "SELECT firstname, lastname,email,filiereID,groupe FROM $tableName  WHERE groupe='$id'";
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
    public static function selectStudentByfiliereId($tableName,$conn,$idf){
        //select a student by id, and return the row result
        $sql = "SELECT * FROM $tableName  WHERE filiereID='$idf'";
        $result = mysqli_query($conn, $sql);
        $data=[];
        if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
        }
        return $data;
    }
    public static function selectStudentByfiliereIdAndGroupe($tableName,$conn,$idf,$grp){
        //select a student by id, and return the row result
        $sql = "SELECT * FROM $tableName  WHERE filiereID='$idf' AND groupe='$grp' ORDER BY lastname ASC ";
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

    public static function selectStudentDistinctGroupe($tableName,$conn,$idf){
        $sql = "SELECT DISTINCT groupe FROM $tableName  WHERE filiereID='$idf' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        $data=[];
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
        return $data;
        
        }
    }
    public static function selectStudentMajor($tableName,$conn,$idS){
        $sql = "SELECT filiereID FROM $tableName  WHERE id_student='$idS' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        }
        return $row;  
        
    }
    public static function selectStudentGroupfil($tableName,$conn,$idS,$idf){
        $sql = "SELECT groupe FROM $tableName  WHERE id_student='$idS' and filiereID='$idf'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row; 
        }
        
        
    }
    

public static function updateStudent($student,$tableName,$conn,$id){
        $sql = "UPDATE $tableName SET lastname='$student->lastnamestudent',firstname='$student->firstnamestudent',email='$student->emailstudent',
        filiereID = '$student->filiereid',groupe = '$student->groupestudent' WHERE id_student='$id'";
            if (mysqli_query($conn, $sql)) {
            self::$successMsg= "New record updated successfully";
            } else {
                self::$errorMsg= "Error updating record: " . mysqli_error($conn);
            }
    
    
    }
    
public static function deleteStudent ($tableName,$conn,$id){
        $sql = "DELETE FROM $tableName WHERE id_student='$id'";
    
    if (mysqli_query($conn, $sql)) {
        self::$successMsg= "Record deleted successfully";
    } else {
        self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
    }
    
      
    }


public static function selectStudentByLastnameAndGrpAndFil($tableName,$conn,$lname,$grp,$idFl){
        $sql = "SELECT * FROM $tableName  WHERE lastname='$lname' AND groupe='$grp' AND filiereID='$idFl' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
         return $row;  
        }
       
    }

    public static function selectCountStudentGrp($tableName, $conn, $G) {
        $sql = "SELECT count(*) as count FROM $tableName WHERE groupe='$G'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result); 
            return $row['count'];
        } else {
            return 0; 
        }
    }
    public static function selectCountStudentGrpFil($tableName, $conn, $id) {
        $sql = "SELECT count(*) as count 
            FROM $tableName 
            INNER JOIN filiere ON $tableName.filiereID = filiere.id_Filiere 
            WHERE filiere.id_resp = '$id'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result); 
            return $row['count'];
        } else {
            return 0; 
        }
    }
}


?>