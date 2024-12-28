<?php
class courseS{
    private $idcourseStud;
    public $idCourse;
    public $idFiliere;
    public $idGroupe;
    public $DateLimite;
    public $DateControle;
    public $notation;
    public $idm;
    public static $SuccMsg="";
    public static $ErrMsg="";

    public function __construct($idCourse,$idFiliere,$idGroupe,$DateLimite,$DateControle,$notation,$idm){
        // hta hna nfss le3ba dyal id li f lgroupe
        $this->idCourse = $idCourse;
        $this->idFiliere = $idFiliere;
        $this->idGroupe = $idGroupe;
        $this->DateLimite = $DateLimite;
        $this->DateControle = $DateControle;
        $this->notation = $notation;
        $this->idm=$idm;

    }

    public function insertcourseStud($tableName,$conn){
        $sql = "INSERT INTO $tableName (IDfiliero, groupo, IDcrs, DateLimite, DateControle, notation,id_maT)
        VALUES ( '$this->idFiliere','$this->idGroupe','$this->idCourse','$this->DateLimite','$this->DateControle','$this->notation','$this->idm')";
        if (mysqli_query($conn, $sql)) {
        self::$SuccMsg= "New record created successfully";
        } else {
        self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public static function selectCoursesByfiliereIdANDgrp($tableName,$conn,$idf,$idg){
        //select a student by id, and return the row result
        $sql = "SELECT * FROM $tableName  WHERE IDfiliero='$idf' AND groupo='$idg' ";
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
    public static function selectGroupesByfiliereIdANDcourse($tableName,$conn,$idf,$idc){
        $sql = "SELECT * FROM $tableName  WHERE IDfiliero='$idf' AND IDcrs='$idc' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        $data=[];
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
        return $data;
        }
    }

    public static function selectASCBygroupeIdANDcourse($tableName,$conn,$idg,$idc){
        //select a student by id, and return the row result
        $sql = "SELECT * FROM $tableName  WHERE groupo='$idg' AND IDcrs='$idc' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            return $row;
            }
    }
    public static function updateassignedcourse($coustudent,$tableName,$conn,$id){
        //update a group of $id, with the values of $filiere in parameter
        //and send the user to read.php
        $sql = "UPDATE $tableName SET DateLimite = '$coustudent->DateLimite',DateControle = '$coustudent->DateControle',notation = '$coustudent->notation' WHERE id_courseStud='$id'";
            if (mysqli_query($conn, $sql)) {
            self::$SuccMsg= "New record updated successfully";
            } else {
            self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
            }
    
    
    }
    
}
?>