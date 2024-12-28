<?php 
    class MatTeaGrp{
        private $idt;
        private $idM;
        private $grp;
        public static $SuccMsg="";
        public static $ErrMsg="";

    public function __construct($idt,$idM,$grp){
        $this->idt = $idt;
        $this->idM = $idM;
        $this->grp = $grp;
    }
    public function insertMatTeaGrp($tableName,$conn){
        $sql = "INSERT INTO $tableName (id_t, id_m,grp)
        VALUES ( '$this->idt','$this->idM','$this->grp')";
        if (mysqli_query($conn, $sql)) {
        self::$SuccMsg= "New record created successfully";
        } else {
        self::$ErrMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    public static function selectMatTeaGrpWTG($tableName,$conn,$idt,$grp){
        $sql = "SELECT * FROM $tableName  WHERE id_t='$idt' AND grp='$grp' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        $data=[];
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
        return $data;
        }
    }
    public static function selectMatTeaGrpWT($tableName,$conn,$idt){
        $sql = "SELECT * FROM $tableName  WHERE id_t='$idt'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        $data=[];
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
        return $data;
        }
    }
    public static function updateMatTeaGrp($MatTeaGrp,$tableName,$conn,$id){
        $sql = "UPDATE $tableName SET id_t = '$MatTeaGrp->idt',grp = '$MatTeaGrp->grp' WHERE id_m='$id'";
            if (mysqli_query($conn, $sql)) {
            self::$SuccMsg= "New record updated successfully";
            } else {
            self::$ErrMsg= "Error updating record: " . mysqli_error($conn);
            }
    }
    }
?>