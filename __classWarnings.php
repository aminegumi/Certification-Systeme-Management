<?php
class Message{
    private $idmsg;
    public $Id_Cours;
    public $Id_Stud;
    private $Time;
    private $MsgText;
    public static $SuccMsg="";
    public static $ErrMsg="";

    public function __construct($Id_Cours,$Id_Stud,$Time,$MsgText){
        // $this->idCertif = $idCertif;
        $this->Id_Cours = $Id_Cours;
        $this->Id_Stud =  $Id_Stud;
        $this->Time =  $Time;
        $this->MsgText = $MsgText;
    }
    public function insertMessage($tableName, $connexion){
        // insert Certificate into the data base 
        $sql = "INSERT INTO $tableName (id_msg, student_id, course_id, message_text, timestamp)
         VALUES ('$this->idmsg', '$this->Id_Stud', '$this->Id_Cours', '$this->MsgText', '$this->Time' )";
         if (mysqli_query($connexion, $sql)) {
         self::$SuccMsg= "New record created successfully";
         } else {
         self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($connexion);
         }
    }
    public static function selectWarningById($tableName,$conn,$idc){
        $sql = "SELECT * FROM $tableName  WHERE id_msg='$idc'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
    
        }
        return $row;
    }
    public static function SelectMsgByCourId($tableName, $connexion,$id){
        $sql = "SELECT * FROM $tableName WHERE course_id='$id' ";
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
    public static function SelectMsgByCourAndStudId($tableName, $connexion,$id,$idS){
        $sql = "SELECT * FROM $tableName WHERE course_id='$id' and student_id='$idS' ";
        $result = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            return $row;
            }
            
    }
    public static function updateMessage($Message,$tableName,$conn,$id){
        //update a group of $id, with the values of $filiere in parameter
        //and send the user to read.php
        $sql = "UPDATE $tableName SET message_text = '$Message->MsgText' WHERE id_msg='$id'";
            if (mysqli_query($conn, $sql)) {
            self::$SuccMsg= "New record updated successfully";
            header("Location:reads.php");
            } else {
                self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
            }
    
    
    }
        
    

}
?>