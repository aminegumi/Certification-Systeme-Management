<?php
session_start();
include('newconnection.php');
include('__classfiliere.php');
include('__classcourse.php');
include('__classstudent.php');
include('__classWarnings.php');
include('__classStudentTeacher.php');
include('__classcoursstudent.php');
include('__classMatiere.php');
$connection = new connection();
$connection->selectDatabase('courserax');
$talamid=array();
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
        $crs=course::selectcourseById('course',$connection->conn,$idcrs);
        $matiere=Matiere::selectMatiereById('matiere',$connection->conn,$crs['Id_mat']);
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
        <h2>Groups Warnings About : <?php echo $crs['nom_Course'] .' :  '.$matiere['nom_Matiere'];?></h2>
        
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
                        <div class="col-sm-12 col-xl-6">
                          <div class="bg-white rounded h-100 p-4">
                              <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Warning</th>
                                        <th scope="col">Time</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                
                                    foreach($talamid as $tilmid){

                                        ?>                                 
                                            <tr>
                                                <td scope="row"><?php echo $tilmid['firstname']?></td>
                                                <td><?php echo $tilmid['lastname']?></td>
                                                <td><?php echo $crs['nom_Course'];?></td>
                                            <?php $cir=Message::SelectMsgByCourAndStudId('messages', $connection->conn,$idcrs,$tilmid['id_student']);
                                            
                                            if(empty($cir)){
                                                echo '<td style="color : red;">No</td>
                                                      <td>-</td>
                                                      
                                                ';
                                            }else{
                                                echo '<td style="color : green;">'.$cir['message_text'].'</td>
                                                      <td>'.$cir['timestamp'].'</td>';

                                            }  ?>          
                                                
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                            </div>
                         </div>
            <!-- 7et L'id dial filiere f session lhmar li wldk  -->
                    
                </div>
                </section><!-- End Testimonials Section -->

    
  

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