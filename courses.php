<?php
session_start();
include ('__classcourse.php');
include('newconnection.php');
include('__classcoursstudent.php');
//include('configh.php');
$connection = new connection();
//call the selectDatabase method
$connection->selectDatabase('Courserax');
$VarfilID = '';
if(isset($_SESSION['idstudent'])){
    // $_SESSION['idstudent'] 
    // $_SESSION['emailstd']
    // $_SESSION['firstnamestd']
    // $_SESSION['lastnamestd']
    // $_SESSION["password"]
    $vargroup = $_SESSION['groupestudent'];
    $VarfilID = $_SESSION['idfilierestudent'];
    $A=$_SESSION['lastnamestd']." ".$_SESSION['firstnamestd'];
}else{
    header('Location: logoutstudent.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Emsi Platform</title>
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

<!-- =======================================================
* Template Name: Mentor
* Updated: Sep 18 2023 with Bootstrap v5.3.2
* Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->
</head>

<body>


<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="courses.php"> Emsi Platform </a></h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="courses.php" class="active" >Courses</a></li>

          
          <li ><a href="#" style="color: green;"><?php echo "Welcome "."".$A ?></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

      <a href="logoutstudent.php" class="get-started-btn">Logout</a>

    </div>
</header>

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Courses</h2>
        <?php
        $courses = courseS::selectCoursesByfiliereIdANDgrp('coursestudent',$connection->conn, $VarfilID,$vargroup);
         if(empty($courses)){ echo '<p> There is no courses delievred by your teachers  </p>';};
         ?>
        
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

        <?php

if(!empty($courses)){
foreach ($courses as $cr) {
    $Ders = course::selectcourseById('course',$connection->conn,$cr['IDcrs']);
    echo '
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
                <img src="assets\img\coursera1.png" class="img-fluid" alt="Coursera image" >
                <div class="course-content">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Date Limite '.$cr['DateLimite'].' </h4>
                        <p class="price"></p>
                    </div>
                    <h3><a href="' . $Ders['linkTOcourse'].'">' . $Ders['nom_Course'] . '</a></h3>
                    <p>The certificate for this course must be Uploaded before the deadline. Otherwise, your grade will be penalized<br> <span style="color:red">( -'.$cr['notation'].' points per day).</span> If the certificate is not uploaded before the assignment date <span style="color:red"> ('.$cr['DateControle'].') </span>, you will receive a final grade of 0. If you encounter any issues, do not hesitate to click here: <a href="WarningByStudent.php?idmsg='.$Ders['id_Course'].'" >Contact your prof.</a></p>
                    <div class="trainer d-flex justify-content-between align-items-center">
                        <div class="trainer-profile d-flex align-items-center">
                            
                            <span><a href="uploadcertif.php?id='.$Ders['id_Course'].'&date='.$cr['DateLimite'].'">Upload certificat</a></span>
                        </div>
                        <div class="trainer-rank d-flex align-items-center">
                            <i class="bx bx-user"></i>&nbsp; groupe '.$vargroup.'
                            &nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}}
?>



        </div>

      </div>
    </section><!-- End Courses Section -->

  </main><!-- End #main -->

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