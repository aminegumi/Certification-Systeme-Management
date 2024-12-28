<?php
    class Matiere{
        private $idMat;
        public $nomMatiere;
        public $idfiliereM;
        public static $SuccMsg="";
        public static $ErrMsg="";
        
        public function __construct($nomMatiere,$idfiliereM) {
            $this->nomMatiere = $nomMatiere;
            $this->idfiliereM = $idfiliereM;
        }
        public function insertMatiere($tableName,$connexion){
            $sql = "INSERT INTO $tableName (nom_Matiere,id_filM)
            VALUES ('$this->nomMatiere','$this->idfiliereM')";
            if (mysqli_query($connexion, $sql)) {
                self::$SuccMsg= "New record created successfully";
            } else {
                self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($connexion);
            }
        }
        public static function selectAllMatieres($tableName,$conn){
            $sql = "SELECT * FROM $tableName ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $data=[];
                while($row = mysqli_fetch_assoc($result)) {
                
                    $data[]=$row;
                }
                return $data;
            }
        }
        public static function selectMatiereById($tableName,$conn,$idM){
            $sql = "SELECT * FROM $tableName  WHERE id_Mat='$idM'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    
            }
            return $row;
        }
        public static function selectMatiereByfiliereId($tableName,$conn,$idf){
            $sql = "SELECT * FROM $tableName  WHERE id_filM='$idf'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            $data=[];
            while($row = mysqli_fetch_assoc($result)) {
            
                $data[]=$row;
            }
            return $data;
            
            }
        }
        public static function selectDistIdfiliereByMatId($tableName,$conn,$idm){
            $sql = "SELECT DISTINCT id_filM FROM $tableName  WHERE id_Mat='$idm'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            $data=[];
            while($row = mysqli_fetch_assoc($result)) {
            
                $data[]=$row;
            }
            return $data;
            
            }
        }
        public static function updateMatiere($matiere,$tableName,$conn,$id){
            $sql = "UPDATE $tableName SET nom_Matiere = '$matiere->nomMatiere', id_filM = '$matiere->id_filM' WHERE id_Mat='$id'";
                if (mysqli_query($conn, $sql)) {
                    self::$SuccMsg= "New record updated successfully";
                } else {
                    self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
                }
        
        
        }
        public static function deleteMatiere ($tableName,$conn,$id){
            $sql = "DELETE FROM $tableName WHERE id_Mat='$id'";
            if (mysqli_query($conn, $sql)) {
                self::$SuccMsg= "Record deleted successfully";
            } else {
                self::$ErrMsg= "Error deleting record: " . mysqli_error($conn);
            }
        
        }

    }
?>