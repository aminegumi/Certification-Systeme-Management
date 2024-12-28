<?php
  class Connexion {
    
    private $valid;
    private $err_email="";
    private $err_pass="";

    public function verification_connexion($email, $password) {
        
        include("newconnection.php");
        $connection = new connection();
        $connection->selectDatabase('courserax');
        
        $this->valid = (boolean) true;

        if(empty($email)){
            $this->valid=false;
            $this->err_email="Veillez renseigner ce chmap!!";
        }
        if(empty($password)){
            $this->valid=false;
            $this->err_pass="Veillez renseigner ce chmap!!";
        }
        if($this->valid) {
            $req = "SELECT passwordAdmin FROM `admin` WHERE emailAdmin = '$email' ";
            $result = mysqli_query($connection->conn , $req);
            if(mysqli_num_rows($result) > 0){
                $user = mysqli_fetch_assoc($result);
            }
            if(isset($user['passwordAdmin'])){
                if ($password != $user['passwordAdmin']) {
                    $this->valid = false;
                    $this->err_email="Le mot de passe est incorect ";

                }
            }else{
                $this->valid = false;
                $this->err_email="Le mot de passe ou le email est incorect";
            }
        }
        if($this->valid){
            $req = "SELECT * FROM `admin` WHERE emailAdmin='$email' ";
            $result = mysqli_query($connection->conn,$req);
            if(mysqli_num_rows($result) > 0){
                $user = mysqli_fetch_assoc($result);
            }
            if(isset($user['passwordAdmin'])){
                
                $_SESSION['idadmin'] = $user['id_admin'];
                $_SESSION['email'] = $user['emailAdmin'];
                $_SESSION['prenom'] = $user['firstnameAdmin'];
                $_SESSION['nom'] = $user['lastnameAdmin'];
                header('Location: AdminIterface.php');
                exit();

            } else{
                $this->valid = false;
                $this->err_email="Le mot de passe ou le email est incorect";
            }
        }   
        
        return [$this->err_email,$this->err_pass]; 

        

    }


    
  }

?>