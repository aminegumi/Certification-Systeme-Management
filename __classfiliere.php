<?php

    class filiere{
        private $idfiliere;
        private $nomfiliere;
        public $respid;
        public static $SuccMsg="";
        public static $ErrMsg="";


        public function __construct($nomfiliere,$respid) {
            // $this->idfiliere = $idfiliere;     nfss lblan dyal auto inrement bla mandwzoh f l param
            $this->nomfiliere = $nomfiliere;
            $this->respid = $respid;
            }



        public function insertfiliere($tableName,$connexion){
            // insert filiere into the database 
        $sql = "INSERT INTO $tableName (nom_Filiere,id_resp)
        VALUES ('$this->nomfiliere','$this->respid')";
        if (mysqli_query($connexion, $sql)) {
        self::$SuccMsg= "New record created successfully";
        } else {
        self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($connexion);
        }
        }


        public static function selectAllfilieres($tableName,$conn){
            // hna wach nhiyd id_filier nkhliw ghi nom li ytl3 ?
            $sql = "SELECT id_Filiere, nom_Filiere , id_resp  FROM $tableName ";
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
        
    
        public static function selectfiliereById($tableName,$conn,$id){
            $sql = "SELECT * FROM $tableName  WHERE id_Filiere='$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            return $row;
            }
            
        }
        public static function selectfiliereByName($tableName,$conn,$name){
            $sql = "SELECT id_Filiere FROM $tableName  WHERE nom_Filiere='$name'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            return $row;
            }
            
        }

        public static function selectfiliereByAdminId($tableName,$conn,$id){
            $sql = "SELECT * FROM $tableName  WHERE id_resp='$id'";
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
    
        public static function updatefiliere($filiere,$tableName,$conn,$id){
            //update a group of $id, with the values of $filiere in parameter
            //and send the user to read.php
            $sql = "UPDATE $tableName SET nom_Filiere = '$filiere->nomfiliere' WHERE id_Filiere='$id'";
                if (mysqli_query($conn, $sql)) {
                self::$successMsg= "New record updated successfully";
                } else {
                    self::$errorMsg= "Error updating record: " . mysqli_error($conn);
                }
        
        
        }
        
        public static function deletefiliere ($tableName,$conn,$id){
            //delete a filiere by his id, and send the user to read.php
            $sql = "DELETE FROM $tableName WHERE id_Filiere='$id'";
        
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "Record deleted successfully";
            header("Location:reads.php");
        } else {
            self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
        }
        
          
            }
    }

?>