<?php
include('__classmatiere.php');
session_start();
include_once("newconnection.php");
$connection = new connection();
$connection->selectDatabase('courserax');
    if(isset($_SESSION['firstnametch'])){
      $A="Prof ".$_SESSION['firstnametch']." ".$_SESSION['lastnametch'];
      

    }else{
       header('Location: logoutstudent.php');
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Delete Account</title>
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

      <h1 class="logo me-auto"><a href="Blank.php"> Emsi Platform </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="Blank.php">Home</a></li>
          <li><a href="ShowCoursesTeacher.php">Courses</a></li>
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
        <h2>Majors & Groups</h2>
        <p>This is where you can locate the academic departments associated with the classes you instruct along with the corresponding fields of study .</p>
      </div>
    </div><!-- End Breadcrumbs -->
    <?php
        $filfil=array();
        $grgr=array();
        include('__classteacher.php');
        include('__classstudent.php');
        include('__classStudentTeacher.php');
        include('__classfiliere.php');
        $data=Student_Teacher::SelectAllStudentsWhereIDTeacher($_SESSION['idtch'], 'studentteacher', $connection->conn);
        if(!empty($data)){
            foreach($data as $dt){
                $Major=student::selectStudentMajor('student',$connection->conn,$dt['id_stud']);
                array_push($filfil, $Major['filiereID']);    
            }
        
        
            $filiereDistinct = array_values(array_unique($filfil));
            sort($filiereDistinct);
            
            for($i=0;$i<count($filiereDistinct);$i++){
                
                $nameMajor = filiere::selectfiliereById('filiere',$connection->conn,$filiereDistinct[$i]);
                ?>
                <!-- ======= Testimonials Section ======= -->
                <section id="testimonials" class="testimonials">
                <div class="container" data-aos="fade-up">
                    
                    <div class="section-title">
                    <h2>Major</h2>
                    <p><?php echo $nameMajor['nom_Filiere']; ?></p>
                    </div>
                    <?php $mat=matiere ?>
                    <div class="section-title">
                    <h4>Major</h4>
                    <p><?php echo $nameMajor['nom_Filiere']; ?></p>
                    </div>
                    <?php 
                        foreach($data as $dt){

                            $groupo=student::selectStudentGroupfil('student',$connection->conn,$dt['id_stud'],$filiereDistinct[$i]); 
                            
                            if(!empty($groupo['groupe'])){
                            array_push($grgr, $groupo['groupe']);
                            }
                            
                        }
                        $groupeDistinct = array_values(array_filter(array_unique($grgr)));
                        sort($groupeDistinct);
                        
                        for($j=0;$j<count($groupeDistinct);$j++){
                          echo '<a type="button" href="tkhbiza.php?id='.$groupeDistinct[$j].'&idf='.$filiereDistinct[$i].'" class="btn btn-success"> Group '.$groupeDistinct[$j].'</a> &numsp; &numsp; &numsp;';

                           

                        }
                        //7et L'id dial filiere f session lhmar li wldk 
                         
                        
                    ?>
                    
                </div>
                </section><!-- End Testimonials Section -->
            <?php
        
        $grgr=array();
            
        }
        $_SESSION['filiere'] = $filiereDistinct;
      }else{

       echo' <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">
            
            <div class="section-title">
            <h2>Major & Groups</h2>
            <p>There is no Groups assigned to you yet</p>
            </div>
        </div>
                </section>';
      }
    ?>

    
  

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