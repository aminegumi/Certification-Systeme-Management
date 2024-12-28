<?php
session_start();
include("__classteacher.php");
include("newconnection.php");
$connection = new connection();
$connection->selectDatabase('courserax');
if(isset($_SESSION['idadmin'])){
    $varID = $_SESSION['idadmin'];
    $varnom = $_SESSION['nom'];
    $varprenom = $_SESSION['prenom'];
}else{
    header('Location: logoutAdmin.php');
}
// $teacher = new Teacher(); ha lghalat dayr constructeur par defaut

// $idTeacherValue = ""; 
$emailValue = "";
$lastnameValue = "";
$firstnameValue = "";
$passwordValue = "";
$adminRespValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submitTeacher"])){

    // $idTeacherValue = $_POST["IdTeacher"]; hadi Autoincrement
    $emailValue = $_POST["email"];
    $lastnameValue = $_POST["lastname"];
    $firstnameValue = $_POST["firstname"];
    $passwordValue = $_POST["password"];
    $adminRespValue = $varID;
    // die($adminRespValue);

// empty($idTeacherValue) ||  hadi dart liya derangement
    if(empty($emailValue) || empty($firstnameValue) || empty($lastnameValue) || empty($passwordValue) || empty($adminRespValue)){

        $errorMesage = "all fileds must be filed out!";

    }else if(strlen($passwordValue) < 8 ){
        $errorMesage = "password must contains at least 8 char";
    }else if(preg_match("/[A-Z]+/", $passwordValue)==0){
        $errorMesage = "password must contains  at least one capital letter!";
    }else if(preg_match("/^[a-z]+@emsi.ma{1}$/", $emailValue)==0){
        $errorMesage= "please enter a valid emsi email! '@emsi.ma'";
    } else{

        $teacher = new Teacher($firstnameValue,$lastnameValue,$emailValue,$passwordValue,$adminRespValue);

        //call the insertClient method
        $teacher->insertTeacher('teacher',$connection->conn);
        
        //give the $successMesage the value of the static $successMsg of the class
        $successMesage = Teacher::$SuccMsg;
        
        //give the $errorMesage the value of the static $errorMsg of the class
        $errorMesage = Teacher::$ErrMsg;
        
        $emailValue = "";
        $lastnameValue = "";
        $firstnameValue = "";
        $passwordValue = "";
        $adminRespValue = "";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EMSI Coursera Platform</title>
    <link href="img/logo.jfif" rel="icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
        

      <!-- Sidebar Start -->
      <?php include('sidebar.php'); ?>
        <!-- Sidebar End -->
        <div class="content">
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                    <a href="AdminIterface.php" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src="img/user3.png" alt="" style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex"><?php echo $varnom . " " . $varprenom  ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">My Profile</a>
                                <a href="#" class="dropdown-item">Settings</a>
                                <a href="logoutAdmin.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>

            <!-- Sign Up Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="AdminIterface.php" class="">
                                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>ADD TEACHER</h3>
                                </a>
                
                            </div>
                            <?php

                            if(!empty($errorMesage)){
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$errorMesage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                            </button>
                            </div>";
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="firstname" id="floatingText" placeholder="first name">
                                    <label for="floatingText">First Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="lastname" id="floatingText" placeholder="last name">
                                    <label for="floatingText">Last Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@emsi.ma">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <!-- this have to refere to the admin connected -->
                                <div class="mb-3">
                                    <?php if(isset($_SESSION['idadmin'])){
                                        ?>
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" name="admin" id="floatingText" placeholder="admin" value="<?php echo $varnom ." ".$varprenom; ?>">
                                            <label for="floatingText">Admin</label>
                                        </div>
                                    <?php
                                    }else{
                                        ?>
                                        <select name='admin' class="form-select">
                                            <option selected>Your admin</option>
                                            <?php
                                                include('__classAdmin.php');
                                                $responsables=Admin::SelectALLAdmins('admin',$connection->conn);
                                                foreach($responsables as $resp){
                                                echo "<option value='$resp[id_admin]' disabled>$resp[firstnameAdmin] $resp[lastnameAdmin]</option>";
                                                }
                                            ?>
                                        </select>
                                    <?php
                                    } ?>
                                    
                                </div> 
                        <?php if(!empty($successMesage)){
                             echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                             <strong>$successMesage</strong>
                             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                             </button>
                             </div>";
                             }
                        ?>  
                                <button type="submit" name="submitTeacher" class="btn btn-primary py-3 w-100 mb-4">Add Teacher</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sign Up End -->

        </div>


        <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </div>
    
</body>
</html>