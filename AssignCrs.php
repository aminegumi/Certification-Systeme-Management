<?php

session_start();
include('newconnection.php');
include('__classfiliere.php');
include('__classcourse.php');
include('__classstudent.php');
include('__classCertificat.php');
include('__classStudentTeacher.php');
include('__classcoursstudent.php');
include('__classMatiere.php');
$connection = new connection();
$connection->selectDatabase('courserax');
// $A=$_SESSION['firstnamestd']." ".$_SESSION['lastnamestd'];
// $errorMesage="";
// $successMesage="";
$error="";
$IDteach = '';
$AdminResp = '';
$emailTeach = '';
$A = '';
if(isset($_SESSION['idtch'])){
    $IDteach = $_SESSION['idtch'];
    $AdminResp=$_SESSION['idadmintch'];
    $emailTeach = $_SESSION['emailtch'];
    
    $A="Prof ".$_SESSION['firstnametch']." ". $_SESSION['lastnametch'];
}else{
     header('Location: logoutstudent.php');
}



if(isset($_GET["id"])){

 $idc=$_GET['id'];
 $crs=course::selectcourseById('course',$connection->conn,$_GET['id']);

}
$matiere=Matiere::selectMatiereById('matiere',$connection->conn,$crs['Id_mat']);
$fl=filiere::selectfiliereById('Filiere',$connection->conn,$matiere['id_filM']);
$IDcourse = $_GET['id'];
$IDfiliere=$fl['id_Filiere'];
$idm=$matiere['id_Mat'];
$groupe='';
$dateLimite = '';
if (isset($_POST['assigncourse'])){
    $groupe=$_POST['Groupe'];
    $dateLimite = $_POST['datelimite'];
    $datecontrole = $_POST['datecontrole'];
    $notation = $_POST['notation'];
    if(empty($groupe) || empty($dateLimite) || empty($datecontrole) || empty($notation)){
        $error = "all fileds must be filed out !";
    }else{
        $testasc2 = courseS::selectASCBygroupeIdANDcourse('coursestudent',$connection->conn,$groupe,$IDcourse);
        if(empty($testasc2)){
        $assignedC = new courseS($IDcourse,$IDfiliere,$groupe,$dateLimite,$datecontrole,$notation,$idm);
        $assignedC->insertcourseStud('coursestudent',$connection->conn);
        header('Location: ShowCoursesTeacher.php');
        }else{
          $assignedC = new courseS($IDcourse,$IDfiliere,$groupe,$dateLimite,$datecontrole,$notation,$idm);
          courseS::updateassignedcourse($assignedC,'coursestudent',$connection->conn,$testasc2['id_courseStud']);
          header('Location: ShowCoursesTeacher.php');
        }
        
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Emsi Coursera Platform</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .warning-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        color: #721c24;
    }

    .warning-container p {
        margin-bottom: 10px;
    }

    .warning-container ul {
        list-style-type: none;
        margin: 10px 0;
        padding: 0;
    }
</style>

  <!-- =======================================================
  * Template Name: Mentor
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="Blank.php"> Emsi Platform </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a  href="Blank.php">Home</a></li>
          <li><a class="active" href="ShowCoursesTeacher.php">Courses</a></li>
          <li ><a href="#" style="color: green;"><?php echo $A ?></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="logoutteacher.php" class="get-started-btn">Logout</a>

    </div>
  </header><!-- End Header -->




  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Assign to your groups this Course : <?php
            
             echo $crs['nom_Course'] ?> course</h2>
        </div>
    </div><!-- End Breadcrumbs --><br><br><br>

    <!-- Certificate Upload Form -->
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?php
                if (!empty($error)) {
                    echo "<div class='alert alert-danger' role='alert'>$error</div>";
                }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="linkcertif" class="form-label">Filiere</label>
                        <input type="text" class="form-control" id="linkcertif" name="linkcertif"  value="<?php 
                        echo $fl['nom_Filiere']; ?>" disabled readonly>
                    </div>
                    <?php
                    $groupeDistinct = Student_Teacher::getGrpStudentsByTeacher($IDteach, $matiere['id_Mat'] , $connection->conn) ;
                    sort($groupeDistinct);
                    ?>
                    <div class="mb-3">
                        <label for="linkcertif" class="form-label">Groupe</label>
                        <select name='Groupe' class="form-select">
                            <option>Groupe</option>
                                     <?php
                                        foreach($groupeDistinct as $gp){
                                          $testasc = courseS::selectASCBygroupeIdANDcourse('coursestudent',$connection->conn,$gp['groupe'],$IDcourse);
                                        if(empty($testasc)){
                                          echo '<option value='.$gp['groupe'].' >'.$gp['groupe'].'</option>';
                                        }else{
                                          echo '<option value='.$gp['groupe'].'>'.$gp['groupe'].'<p>  ( course already assigned to this group you will only update the deadline of course,assignment and notation )</p></option>';
                                        }
                                        
                                        }
                                    ?>
                        </select> 
                    </div>
                    <div class="mb-3">
                        <label for="linkcertif" class="form-label">Date Limite</label>
                        <input type="date" class="form-control" id="linkcertif" name="datelimite" required>
                    </div>
                    <div class="mb-3">
                        <label for="linkcertif" class="form-label">Date Controle</label>
                        <input type="date" class="form-control" id="linkcertif" name="datecontrole" required>
                    </div>
                    <div class="mb-3">
                        <label for="linkcertif" class="form-label">Notation</label>
                        <input type="text" class="form-control" id="linkcertif" name="notation" required>
                    </div>
    
                    <button type="submit" name="assigncourse" class="btn btn-success">Assign Course</button>
                </form>
            </div>
        </div>
    </div>
    <!-- warning message ... -->
</main>
<br><br><br>

 <!-- ======= Footer ======= -->
 <footer id="footer">
 <div class="footer-top">
  <div class="container">
    <div class ="row">

<div class="container d-md-flex py-4">

  <div class="me-md-auto text-center text-md-start">
    <div class="copyright">
      &copy; Copyright <strong><span>Emsi Platform</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Developed by <a href="#">ISSAME IMAD & AGOUMI MOHAMMED AMINE</a>
    </div>
    <div class="credits">
      Supervised by <a href="#">Mrs. Amine Zeguendry</a>
    </div>
  </div>
  <div class="social-links text-center text-md-right pt-3 pt-md-0">
    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
  </div>
</div>
</footer>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>