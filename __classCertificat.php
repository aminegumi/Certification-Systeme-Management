<?php
class Certificate{
    private $idCertif;
    public $Id_Cours;
    public $Id_Stud;
    private $Date_Delivrance;
    private $Link_Coursera;
    private $note;
    private $certifimg;
    public static $SuccMsg="";
    public static $ErrMsg="";


    public function __construct($Id_Cours,$Id_Stud,$Date_Delivrance,$Link_Coursera,$note,$certifimg){
        // $this->idCertif = $idCertif;
        $this->Id_Cours = $Id_Cours;
        $this->certifimg = $certifimg;
        $this->Id_Stud =  $Id_Stud;
        $this->Date_Delivrance =  $Date_Delivrance;
        $this->Link_Coursera =  $Link_Coursera;
        $this->note = $note;
    }
    
    public function insertCertificat($tableName, $connexion){
        // insert Certificate into the database using prepared statements
        $sql = "INSERT INTO $tableName (id_certif, id_cours, id_std, Date_Delivrance, Link_Coursera , note , certif_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = mysqli_prepare($connexion, $sql);
    
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $this->idCertif, $this->Id_Cours, $this->Id_Stud, $this->Date_Delivrance, $this->Link_Coursera, $this->note, $this->certifimg);
    
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            self::$SuccMsg= "New record created successfully";
        } else {
            self::$ErrMsg = "Error: " . $sql . "<br>" . mysqli_error($connexion);
        }
    
        // Close the statement
        mysqli_stmt_close($stmt);
    }

    public static function SelectALLCertificates($tableName, $connexion){
        $sql = "SELECT id_certif, id_cours, id_std, Date_Delivrance, Link_Coursera , note , certif_image FROM $tableName";
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

    public static function SelectCertificateById($tableName,$connexion,$id){
        $sql = "SELECT * FROM $tableName WHERE id_certif='$id'";
        $result = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        return $row;
        }

    }

    public static function SelectCertificatesByStudId($tableName, $connexion,$id){
        $sql = "SELECT id_certif, id_cours, id_std, Date_Delivrance, Link_Coursera , note , certif_image FROM $tableName WHERE id_stud='$id' ";
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

    public static function SelectCertificatesByStudandCourseId($tableName, $connexion,$ids,$idc){
        $sql = "SELECT * FROM $tableName WHERE id_std='$ids' and id_cours= '$idc'";
        $result = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
         return $row;
        }
       
        
    }

    public static function SelectCertificatesBycoursId($tableName, $connexion,$id){
        $sql = "SELECT id_certif, id_cours, id_std, Date_Delivrance, Link_Coursera , note , certif_image FROM $tableName WHERE id_cours='$id' ";
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

    public static function DeleteCertificateById($tableName,$connexion,$id){
        $sql = "DELETE FROM $tableName WHERE id_certif='$id'";
        if (mysqli_query($connexion, $sql)) {
            self::$SuccMsg= "Record deleted successfully";
        } else {
            self::$ErrMsg= "Error: " . $sql . "<br>" . mysqli_error($connexion);
        }
    }

    public static function UpdateCetificateById($Certificate,$tableName,$connexion,$id){
        $sql = "UPDATE $tableName SET id_cours='$Certificate->Id_Cours',Date_Delivrance='$Certificate->Date_Delivrance',Link_Coursera='$Certificate->Link_Coursera' WHERE id_certif='$id'";
        if (mysqli_query($connexion, $sql)) {
            self::$SuccMsg= "New record updated successfully";
            // we can add where we want to go just after the new record get add
            //header("Location:read.php");
            
        } else {
            self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
        }
    }
    public static function UpdateCetificateMarkByIdstudandcour($tableName,$connexion,$id,$idc,$mark){
        $sql = "UPDATE $tableName SET note='$mark' WHERE id_std='$id' AND  id_cours='$idc'";
        if (mysqli_query($connexion, $sql)) {
            self::$SuccMsg= "New record updated successfully";
            // we can add where we want to go just after the new record get add
            //header("Location:read.php");
            
        } else {
            self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
        }
    }
    public static function UpdateCetificateMarkById($tableName,$connexion,$id,$mark){
        $sql = "UPDATE $tableName SET note='$mark' WHERE id_certif='$id'";
        if (mysqli_query($connexion, $sql)) {
            self::$SuccMsg= "New record updated successfully";
            // we can add where we want to go just after the new record get add
            //header("Location:read.php");
            
        } else {
            self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
        }
    }

}
?>