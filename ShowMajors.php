<?php

session_start();
include('__classfiliere.php');
include('__classstudent.php');
include('__classcourse.php');
include('__classteacher.php');
include('newconnection.php');
include('__classMatiere.php');

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EMSI Coursera Platform</title>
    <link href="img/logo.jfif" rel="icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
                
        <?php
                    include('stat.php');
        ?>
                <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
                        $varCountEach = 0;
                        $varCountCoursesEach = 0;
                        $filieres=filiere::selectfiliereByAdminId('filiere',$connection->conn,$varID);
                        if(!empty($filieres)){
                        foreach( $filieres as $fl){
                            ?>  <div class="col-sm-12 col-xl-6">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <h3 class="mb-4"><?php echo $fl['nom_Filiere'] ?></h3>
                                        <hr>
                                        <p class="mb-6"> 
                                            <strong>The number of Students in This Sub Major : </strong> 
                                            <?php
                                                $studentEach=student::selectStudentByfiliereId('student',$connection->conn,$fl['id_Filiere']);
                                                if(empty($studentEach)){
                                                    echo '<p>No Students Added Yet</p>';
                                                }else{
                                                    foreach($studentEach as $std){
                                                        $varCountEach = $varCountEach + 1;
                                                    }
                                                }
                                                echo $varCountEach;
                                                $varCountEach = 0;
                                        
                                            ?>
                                        </p>
                                        <hr>
                                        <p class="mb-6">
                                            <h4>Subjectes for this Sub Major : </h4>
                                            <br>
                                            <?php
                                                $coursesEach=matiere::selectMatiereByfiliereId('matiere',$connection->conn,$fl['id_Filiere']);
                                                if(empty($coursesEach)){
                                                    echo '<h5>No Subjects added Yet</h5>';
                                                }else{
                                                    foreach($coursesEach as $cou){
                                                        echo "<h5>$cou[nom_Matiere]</h5><br>";
                                                        $varCountCoursesEach = $varCountCoursesEach + 1;
                                                    }
                                                }
                                                echo 'Total of Subjects :'.$varCountCoursesEach;
                                                $varCountCoursesEach=0;
                                            
                                            ?>
                                        </p>
                                        <hr>
                                        <h6 class="mb-6">Table Of Courses</h6>
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                    <?php
                                                        if(empty($coursesEach)){

                                                        }else{
                                                            ?>
                                                             <thead>
                                                                <tr>
                                                                    <th scope="col">ID COURSE</th>
                                                                    <th scope="col">COURSE NAME</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            foreach($coursesEach as $cou){
                                                                $crsM=course::selectCoursesByMatiereId($connection->conn,$cou['id_Mat']);
                                                                foreach($crsM as $c):
                                                                ?><tr>
                                                                    <th scope="row"><?php echo $c['id_Course'] ?></th>
                                                                    <td><?php echo $c['nom_Course'] ?></td>
                                                                </tr><?php
                                                                endforeach;
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                            
                                    </div>
                                </div>
                            
                            <?php
                        }}

                    ?>
                    
                    
                </div>
            </div>
            <!-- Table End -->
                

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