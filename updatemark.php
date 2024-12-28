<?php
session_start();
include('newconnection.php');
include('__classfiliere.php');
include('__classcourse.php');
include('__classstudent.php');
include('__classCertificat.php');
include('__classStudentTeacher.php');
include('__classcoursstudent.php');
$connection = new connection();
$connection->selectDatabase('courserax');
$talamid=array();
$error="";
$mark="";
    // include('logoutstudent.php');
    // session_start();
    // include('configh.php');
    if(isset($_SESSION['firstnametch'])){
      $A="Prof ".$_SESSION['firstnametch']." ".$_SESSION['lastnametch'];

    }else{
      header('Location: logoutstudent.php');
    }
    if(isset($_SESSION['talamid'])){

        $talamid=$_SESSION['talamid'];
        $idfiliero=$_SESSION['filierii'];
        $idgrp=$_SESSION['groupies'];
        $idcrs=$_SESSION['coursawi'];
        
    }
    if(isset($_GET['idcc'])){

        $cerfatika=$_GET['idcc'];
        $stidenid=$_GET['idss'];

        $sd=student::selectStudentById('student',$connection->conn,$stidenid);
        $cr=course::selectcourseById('course',$connection->conn,$idcrs);
        $frc=Certificate::SelectCertificateById('certificat',$connection->conn,$cerfatika);
        
    }
    if(isset($_POST['mark'])){
        $mark=$_POST['newMark'];

        if(empty($mark)){
            $error="Enter the Mark";
        }else{
            Certificate::UpdateCetificateMarkById('certificat',$connection->conn,$cerfatika,$mark);
            header('Location: Showcertifdetails.php');

        }
        
    }

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
    /* Add this style to make the button green and smaller */
    .showCertificateBtn {
        background-color: #28a745; /* Green color */
        color: #fff; /* White text */
        font-size: 12px; /* Adjust the font size */
        padding: 4px 8px; /* Adjust the padding */
    }

    #certificateModal .modal-body {
    text-align: center;
}

    #certificateModal .modal-body img {
    max-width: 100%; /* Set the maximum width of the image to the modal width */
    height: auto; /* Make the image responsive while maintaining aspect ratio */
    display: inline-block; /* Align the image in the center */
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

  <main id="main"> 


  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Update Mark for  student <?php echo $sd['firstname']." ".$sd['lastname'].' and course '.$cr['nom_Course'];?></h2>
      </div>
    </div><!-- End Breadcrumbs -->
            <?php
                $nameMajor = filiere::selectfiliereById('filiere',$connection->conn,$idfiliero);
                ?>
                <!-- ======= Testimonials Section ======= -->
                <section id="testimonials" class="testimonials">
                <div class="container" data-aos="fade-up">
                    
                    <div class="section-title">
                    <h2><?php echo $nameMajor['nom_Filiere']; ?></h2>
                    <p><?php echo 'Groupe '.$idgrp.' '; ?></p>
                    </div>
                        
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
                        <label for="message" class="form-label">New Mark</label>
                        <input type="text" class="form-control" id="message" name="newMark" value="<?php echo $frc['note']; ?>" required>
                    </div>
                    <button type="submit" name="mark" class="btn btn-success">Update Mark</button>
                </form>
            </div>
        </div>
    </div>
                    
                </div>
                </section><!-- End Testimonials Section -->
        

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
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
      Designed by <a href="#">ISSAME IMAD & AGOUMI MOHAMMED AMINE</a>
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