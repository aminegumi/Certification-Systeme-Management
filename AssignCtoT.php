<?php
//include connection file
session_start();
include('__classfiliere.php');
include('__classteacher.php');
include('__classcourse.php');
include('__classstudent.php');
include('__classcoursteacher.php');
include('__classStudentTeacher.php');
include('newconnection.php');

//include('loginAdmin.php');
// top
//include('__classfiliere.php');
//create in instance of class Connection
$connection = new connection();
//call the selectDatabase method
$connection->selectDatabase('Courserax');
if(isset($_SESSION['idadmin'])){
    $varID = $_SESSION['idadmin'];
    $varnom = $_SESSION['nom'];
    $varprenom = $_SESSION['prenom'];
}else{
    header('Location: logoutAdmin.php');
}

$idMajor="";
$idCourse="";
$idTeacher="";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["Confirm"])){
    $idMajor = $_POST['filieres'];
    if(empty($idMajor)){

        $errorMesage = "Choose the Major First!";

    }else{
        $CoursesM=course::selectCoursesByfiliereId('course',$connection->conn,$idMajor);
    }

}

if(isset($_POST["assignTtoC"])){
    $idCourse = $_POST['course'];
    $idTeacher = $_POST['teacher'];
    if(empty($idCourse) || empty($idTeacher)){

        $errorMesage = "all fileds must be filed out!";

    }else{
        $CourseToTeacher = new courseT($idCourse,$idTeacher);
        $CourseToTeacher->insertcourseTeach('courseteacher',$connection->conn);
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
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->

      <!-- Sidebar Start -->
      <?php include('sidebar.php'); ?>
    <!-- Sidebar End -->

        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <form class="d-none d-md-flex ms-4">
                        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                    </form>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-envelope me-lg-2"></i>
                                <span class="d-none d-lg-inline-flex">Message</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all message</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-bell me-lg-2"></i>
                                <span class="d-none d-lg-inline-flex">Notificatin</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Profile updated</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">New user added</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Password changed</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all notifications</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
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
                <!-- Navbar End -->
                <!-- Form Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary">Assign Course To Teacher</h3>
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
                                
                        <!-- id student -->
                        <!-- <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingText" placeholder="etud-$">
                            <label for="floatingText">ID Student</label>
                        </div> -->
                        
                        <div class="mb-3">
                        <select name='filieres' class="form-select">
                            <option>Major</option>
                                     <?php
                                        $data=filiere::selectfiliereByAdminId('filiere',$connection->conn,$varID);
                                        foreach($data as $row){
                                        echo "<option value='$row[id_Filiere]' >$row[nom_Filiere]</option>";
                                        }
                                    ?>
                        </select>
                        <button type="submit" name ="Confirm" class="btn btn-sm btn-primary m-2 centre">Confirm the Major</button>
                        </div> 
                        <div class="mb-3">
                        <select name='course' class="form-select">
                            <option>Courses</option>
                                     <?php
                                        foreach($CoursesM as $ligne){
                                            echo "<option value='$ligne[id_Course]' >$ligne[nom_Course]</option>";
                                        }
                                    ?>
                        </select>
                        </div> 
                        
                       <div class="mb-3">
                        <select name='teacher' class="form-select">
                            <option>teacher</option>
                                     <?php
                                        $data=Teacher::SelectTeachersByRespId('teacher',$connection->conn,$varID);
                                        foreach($data as $row){
                                        echo "<option value='$row[id_teacher]' >$row[firstname]  $row[lastname]</option>";
                                        }
                                    ?>
                        </select>
                        </div>
                        </div>
                       <?php if(!empty($successMesage)){
                             echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                             <strong>$successMesage</strong>
                             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                             </button>
                             </div>";
                             }
                        ?>  
                        <button type="submit" name ="assignTtoC" class="btn btn-primary py-3 w-100 mb-4">Assign Course</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Up End -->
                
                

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