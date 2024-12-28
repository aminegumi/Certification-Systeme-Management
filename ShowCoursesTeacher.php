<?php
session_start();
include ('__classteacher.php');
include ('__classcoursteacher.php');
include ('__classstudent.php');
include ('__classcourse.php');
include('__classMatiere.php');
include('__classfiliere.php');
include('__classStudentTeacher.php');
include('newconnection.php');
//include('configh.php');
$connection = new connection();
//call the selectDatabase method
$connection->selectDatabase('Courserax');
$IDteach = '';
$AdminResp = '';
$emailTeach = '';
$A = '';
if(isset($_SESSION['idtch'])){
    $IDteach = $_SESSION['idtch'];
    $AdminResp=$_SESSION['idadmintch'];
    $emailTeach = $_SESSION['emailtch'];
    
    $A="Prof " . $_SESSION['firstnametch']." ". $_SESSION['lastnametch'];
}else{
    // header('Location: logoutstudent.php');
    $A="session makaynach";
}
$students=Student_Teacher::getStudentsByTeacher($IDteach, 'studentteacher', $connection->conn);
$matiere=Student_Teacher::getSubjectByTeacher($IDteach, 'studentteacher', $connection->conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>EMSI Coursera Platform</title>
<link href="img/logo.jfif" rel="icon">
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="assets/img/favicon.png" rel="icon">
<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">

</head>

<body>


<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="ShowCoursesTeacher.php"> Emsi Platform </a></h1>
      

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="ShowCoursesTeacher.php">Courses</a></li>
          <li ><a href="#" style="color: green;"><?php echo $A ?></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="logoutteacher.php" class="get-started-btn">Logout</a>

    </div>
  </header>

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Courses</h2>
        <?php
        $matiere=Student_Teacher::getSubjectByTeacher($IDteach, 'studentteacher', $connection->conn);
         if(empty($matiere)){ echo '<p> There is no Subjects delievred by your Admin  </p>';};
         ?>
        
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

        <?php

if(!empty($matiere)){
  foreach($matiere as $m){
    $coursee= course::selectCoursesByMatiereId($connection->conn,$m['id_Mat']);
    if(!empty($coursee)){
    foreach($coursee as $cr){
      $Filiere=filiere::selectfiliereById('filiere',$connection->conn,$m['id_filM']);
  
    echo '
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
                <img src="assets/img/coursera.png" class="img-fluid" alt="...">
                <div class="course-content">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Date Limite</h4>
                        <p class="price"></p>
                    </div>
                    <h3>'.$Filiere['nom_Filiere'].' : '.$m['nom_Matiere'].'</h3>
                    <br>
                    <h3><a href="' . $cr['linkTOcourse'].'">' . $cr['nom_Course'] . '</a></h3>
                    <p>If you Want To see Warnings About This Course click <a href="WarningsGroupe.php?idmsgT='.$cr['id_Course'].'" >here</a></p>
                    <div class="trainer d-flex justify-content-between align-items-center">
                        <div class="trainer-profile d-flex align-items-center">
                        <i class="bx bx-pin"></i>&nbsp;<span><a href="AssignCrs.php?id='.$cr['id_Course'].'">Assign Course</a></span>
                        </div>
                        <div class="trainer-rank d-flex align-items-center">
                            <i class="bx bx-show"></i>&nbsp;<a href="certificateTeacher.php?id='.$cr['id_Course'].'">Certificat</a> 
                            &nbsp;&nbsp;
                        </div>
                        <div class="trainer-rank d-flex align-items-center">
                            <i class="bx bx-trending-up"></i>&nbsp;<a href="Progressteacher.php?id='.$cr['id_Course'].'">Progress</a> 
                            &nbsp;&nbsp;
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>';
}}}}
?>


          

        </div>

      </div>
    </section><!-- End Courses Section -->

  </main><!-- End #main -->

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
</footer><!-- End Footer -->

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