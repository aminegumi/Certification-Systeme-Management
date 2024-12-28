<?php
class Teacher{
    private $idTeacher;
    private $FirstnameTeacher;
    private $LastnameTeacher;
    private $EmailTeacher;
    private $PasswordTeacher;
    public $ID_Res_Of_Teacher;
    public static $SuccMsg="";
    public static $ErrMsg="";


    public function __construct($FirstnameTeacher,$LastnameTeacher,$EmailTeacher,$PasswordTeacher,$ID_Res_Of_Teacher){
        // $this->idTeacher = $idTeacher;
        $this->FirstnameTeacher = $FirstnameTeacher;
        $this->LastnameTeacher =  $LastnameTeacher;
        $this->EmailTeacher =  $EmailTeacher;
        $this->PasswordTeacher =  password_hash($PasswordTeacher,PASSWORD_BCRYPT);
        $this->ID_Res_Of_Teacher =  $ID_Res_Of_Teacher;
    }
    
    public function insertTeacher($tableName, $connexion){
        // insert Teacher into the data base 
        // die(var_dump($tableName));
        $sql = "INSERT INTO $tableName (id_teacher, firstname, lastname, email, password, id_admin_resp)
         VALUES ('$this->idTeacher', '$this->FirstnameTeacher', '$this->LastnameTeacher', '$this->EmailTeacher', '$this->PasswordTeacher', '$this->ID_Res_Of_Teacher')";
         if (mysqli_query($connexion, $sql)) {
         self::$SuccMsg= "New record created successfully";
         } else {
         self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($connexion);
         }
    }

    public static function SelectALLTeachers($tableName, $connexion){
        $sql = "SELECT id_teacher, firstname, lastname, email, password, id_admin_resp FROM $tableName";
        $result = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($result) > 0) {
           // output data of each row
           $data=[];
           while($row = mysqli_fetch_assoc($result)) {
              $data[]=$row;
           }
        return $data;   
        }
        
    }

    public static function SelectTeacherById($tableName,$connexion,$idt){
        $sql = "SELECT * FROM $tableName WHERE id_teacher='$idt'";
        $result = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }

    public static function SelectTeachersByRespId($tableName, $connexion,$id){
        $sql = "SELECT id_teacher, firstname, lastname, email, password, id_admin_resp FROM $tableName WHERE id_admin_resp='$id' ";
        $result = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($result) > 0) {
           // output data of each row
           $data=[];
           while($row = mysqli_fetch_assoc($result)) {
              $data[]=$row;
           }
        return $data;   
        }
        
    }

    public static function SelectTeacherByemail($tableName,$connexion,$eml){
        $sql = "SELECT * FROM $tableName WHERE email='$eml'";
        $result = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        return $row;
        }
        
    }

    public static function DeleteTeacherById($tableName,$connexion,$id){
        $sql = "DELETE FROM $tableName WHERE id_teacher='$id'";
        if (mysqli_query($connexion, $sql)) {
            self::$SuccMsg= "Record deleted successfully";
        } else {
            self::$ErrMsg= "Error: " . $sql . "<br>" . mysqli_error($connexion);
        }
    }
// update concerne hta resp ou pas
    public static function UpdateTeacherById($teacher,$tableName,$connexion,$id){
        $sql = "UPDATE $tableName SET lastname='$teacher->LastnameTeacher',firstname='$teacher->FirstnameTeacher',email='$teacher->EmailTeacher' WHERE id_teacher='$id'";
        if (mysqli_query($connexion, $sql)) {
            self::$SuccMsg= "New record updated successfully";
            // we can add where we want to go just after the new record get add
            //header("Location:read.php");
            
        } else {
            self::$ErrMsg= "Error updating record: " . mysqli_error($connexion);
        }
    }




}
?>