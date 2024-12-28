<?php

// only one admin can use this class as the manager of all admins;
class Admin{
    private $idAdmin;
    private $FirstnameAdmin;
    private $LastnameAdmin;
    private $EmailAdmin;
    private $PasswordAdmin;
    public static $SuccMsg="";
    public static $ErrMsg="";


    public function __construct($FirstnameAdmin,$LastnameAdmin,$EmailAdmin,$PasswordAdmin){
        // $this->idAdmin = $idAdmin;
        $this->FirstnameAdmin = $FirstnameAdmin;
        $this->LastnameAdmin =  $LastnameAdmin;
        $this->EmailAdmin =  $EmailAdmin;
        $this->PasswordAdmin =  password_hash($PasswordAdmin,PASSWORD_BCRYPT);
    }
    
    public function insertAdmin($tableName, $connexion){
        // insert Admin into the data base 
        $sql = "INSERT INTO $tableName (id_admin, firstnameAdmin, lastnameAdmin, emailAdmin, passwordAdmin)
         VALUES ('$this->idAdmin', '$this->FirstnameAdmin', '$this->LastnameAdmin', '$this->EmailAdmin', '$this->PasswordAdmin')";
         if (mysqli_query($connexion, $sql)) {
         self::$SuccMsg= "New record created successfully";
         } else {
         self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($connexion);
         }
    }

    public static function SelectALLAdmins($tableName, $connexion){
        $sql = "SELECT id_admin, firstnameAdmin, lastnameAdmin, emailAdmin FROM $tableName";
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

    public static function SelectAdminById($tableName,$connexion,$id){
        $sql = "SELECT id_admin, firstnameAdmin, lastnameAdmin, emailAdmin  FROM $tableName WHERE id_admin='$id'";
        $result = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        }

    }

    // Admin don't have a resp
    // public static function SelectAdminsByRespId($tableName, $connexion,$id){
    //     $sql = "SELECT id_admin, firstname, lastname, email, password, id_admin_resp FROM $tableName WHERE id_admin_resp='$id' ";
    //     $result = mysqli_query($connexion, $sql);
    //     if (mysqli_num_rows($result) > 0) {
    //        // output data of each row
    //        $data=[];
    //        while($row = mysqli_fetch_assoc($result)) {
    //           $data[]=$row;
    //        }
    //     return $data;   
    //     }
        
    //}

    public static function DeleteAdminById($tableName,$connexion,$id){
        $sql = "DELETE FROM $tableName WHERE id_admin='$id'";
        if (mysqli_query($connexion, $sql)) {
            self::$SuccMsg= "Record deleted successfully";
        } else {
            self::$ErrMsg= "Error: " . $sql . "<br>" . mysqli_error($connexion);
        }
    }

    public static function UpdateAdminById($Admin,$tableName,$connexion,$id){
        $sql = "UPDATE $tableName SET lastnameAdmin='$Admin->LastnameAdmin',firstnameAdmin='$Admin->FirstnameAdmin',emailAdmin='$Admin->EmailAdmin' WHERE id_admin='$id'";
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