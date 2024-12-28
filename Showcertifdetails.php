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
    $havingCertif = array();
    $notHavingCertif = array();
    foreach($talamid as $st){
      $cirti=Certificate::SelectCertificatesByStudandCourseId('certificat', $connection->conn,$st['id_student'],$idcrs);
      if(empty($cirti)){
        array_push($notHavingCertif, $st['id_student']);
      }else{
        array_push($havingCertif, $st['id_student']);
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
        <h2>Certificate Informations</h2>
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
                              
                              <!-- Search form -->
                              <div class="container mt-4 mb-4">
                                  <form method="post" class="row g-3">
                                    <div class="col-md-6">
                                      <div class="input-group">
                                          <input type="text" class="form-control" placeholder="Search by Acquisition status, All, or any lastname..." name="searchval" value="">
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                          <button class="btn btn-success" name="search" type="submit">Search</button>
                                    </div>
                                  </form>
                              </div>
                              <form method="POST" id="convert_form" action="_excel.php">
                              <table class="table table-bordered table-hover" id="table_content">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Acquisition status</th>
                                        <th scope="col">Certificate Mark</th>
                                        <th scope="col">Link Certificat</th>
                                        <th scope="col">Show Certificat</th>
                                        <th scope="col">Update Mark</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(isset($_POST['search'])){
                                      $search=$_POST['searchval'];
                                      $st=student::selectStudentByLastnameAndGrpAndFil('student',$connection->conn,$search,$idgrp,$idfiliero);
                                      if(empty($st)){
                                      if(strtolower($_POST['searchval']) == 'all' ){
                                        foreach($talamid as $tilmid){

                                          ?> <tr>
                                                <td scope="row"><?php echo $tilmid['firstname']?></td>
                                                <td><?php echo $tilmid['lastname']?></td>
                                                <td><?php $carsos=course::selectcourseById('course',$connection->conn,$idcrs) ; 
                                                          echo $carsos['nom_Course'];?></td>
                                              <?php $cir=Certificate::SelectCertificatesByStudandCourseId('certificat', $connection->conn,$tilmid['id_student'],$idcrs);
                                              if(empty($cir)){
                                                echo '<td style="color : red;">No</td>
                                                      <td>0</td>
                                                      <td>-</td>
                                                      <td>-</td>     
                                                '; 
                                            }else{
                                                echo '<td style="color : green;">Yes</td>
                                                      <td>'.$cir['note'].'</td>
                                                      <td><a href="'.$cir['Link_Coursera'].'" target="_bl">Show by link</a></td>
                                                      <td><button class="showCertificateBtn btn btn-success btn-sm" data-toggle="modal" data-target="#certificateModal" data-certificate="'.htmlspecialchars($cir['certif_image']).'">Show Certificate</button></td>
                                                      <td>
                                                        <button class="editMarkBtn btn btn-danger btn-sm"><a href="updatemark.php?idcc='.$cir['id_certif'].'&idss='.$tilmid['id_student'].'" style="color : white;">Edit Mark</a>
                                                        </button>
                                                      </td>';
                                             }    ?> 
                                            </tr>
                                          <?php
                                        
                                      }
                                    }elseif(strtolower($_POST['searchval']) == 'yes'){
                                      for($i=0;$i<count($havingCertif);$i++){
                                        $etu=student::selectStudentById('student',$connection->conn,$havingCertif[$i])
                                      ?>    
                                            <tr>
                                                <td scope="row"><?php echo $etu['firstname']?></td>
                                                <td><?php echo $etu['lastname']?></td>
                                                <td><?php $carsos=course::selectcourseById('course',$connection->conn,$idcrs) ; 
                                                          echo $carsos['nom_Course'];?></td>
                                              <?php $cir=Certificate::SelectCertificatesByStudandCourseId('certificat', $connection->conn,$havingCertif[$i],$idcrs);
                                                echo '<td style="color : green;">Yes</td>
                                                      <td>'.$cir['note'].'</td>
                                                      <td><a href="'.$cir['Link_Coursera'].'" target="_bl">Show by link</a></td>
                                                      <td><button class="showCertificateBtn btn btn-success btn-sm" data-toggle="modal" data-target="#certificateModal" data-certificate="'.htmlspecialchars($cir['certif_image']).'">Show Certificate</button></td>
                                                      <td>
                                                        <button class="editMarkBtn btn btn-danger btn-sm"><a href="updatemark.php?idcc='.$cir['id_certif'].'&idss='.$havingCertif[$i].'" style="color : white;">Edit Mark</a>
                                                        </button>
                                                      </td>';
                                             ?> 
                                            </tr>
                                      
                                      
                                      <?php
                                      }
                                    }elseif(strtolower($_POST['searchval']) == 'no'){
                                      for($i=0;$i<count($notHavingCertif);$i++){
                                        $etu=student::selectStudentById('student',$connection->conn,$notHavingCertif[$i])
                                      ?>    
                                            <tr>
                                                <td scope="row"><?php echo $etu['firstname']?></td>
                                                <td><?php echo $etu['lastname']?></td>
                                                <td><?php $carsos=course::selectcourseById('course',$connection->conn,$idcrs) ; 
                                                          echo $carsos['nom_Course'];?></td>
                                              <?php echo '<td style="color : red;">No</td>
                                                      <td>0</td>
                                                      <td>-</td>
                                                      <td>-</td>     
                                                '; 
                                             ?> 
                                            </tr>
                                      <?php
                                      }

                                    }elseif(empty($_POST['searchval'])){
                                      echo '<p style="color: green; font-weight: bold;">Search Bar is empty</p>';
                                      foreach($talamid as $tilmid){

                                        ?> <tr>
                                              <td scope="row"><?php echo $tilmid['firstname']?></td>
                                              <td><?php echo $tilmid['lastname']?></td>
                                              <td><?php $carsos=course::selectcourseById('course',$connection->conn,$idcrs) ; 
                                                        echo $carsos['nom_Course'];?></td>
                                            <?php $cir=Certificate::SelectCertificatesByStudandCourseId('certificat', $connection->conn,$tilmid['id_student'],$idcrs);
                                            if(empty($cir)){
                                              echo '<td style="color : red;">No</td>
                                                    <td>0</td>
                                                    <td>-</td>
                                                    <td>-</td>     
                                              '; 
                                            }else{
                                                echo '<td style="color : green;">Yes</td>
                                                      <td>'.$cir['note'].'</td>
                                                      <td><a href="'.$cir['Link_Coursera'].'" target="_bl">Show by link</a></td>
                                                      <td><button class="showCertificateBtn btn btn-success btn-sm" data-toggle="modal" data-target="#certificateModal" data-certificate="'.htmlspecialchars($cir['certif_image']).'">Show Certificate</button></td>
                                                      <td>
                                                        <button class="editMarkBtn btn btn-danger btn-sm"><a href="updatemark.php?idcc='.$cir['id_certif'].'&idss='.$tilmid['id_student'].'" style="color : white;">Edit Mark</a>
                                                        </button>
                                                      </td>';
                                            }    ?> 
                                            </tr>
                                        <?php
                                      
                                        }

                                    }else{
                                      echo '<p style="font-weight: bold;">Student <b style="color: red;">'.$_POST['searchval'].' </b> Not Found, Verify The Lastname Provided</p>';
                                      foreach($talamid as $tilmid){

                                        ?> <tr>
                                              <td scope="row"><?php echo $tilmid['firstname']?></td>
                                              <td><?php echo $tilmid['lastname']?></td>
                                              <td><?php $carsos=course::selectcourseById('course',$connection->conn,$idcrs) ; 
                                                        echo $carsos['nom_Course'];?></td>
                                            <?php $cir=Certificate::SelectCertificatesByStudandCourseId('certificat', $connection->conn,$tilmid['id_student'],$idcrs);
                                            if(empty($cir)){
                                              echo '<td style="color : red;">No</td>
                                                    <td>0</td>
                                                    <td>-</td>
                                                    <td>-</td>     
                                              '; 
                                            }else{
                                                echo '<td style="color : green;">Yes</td>
                                                      <td>'.$cir['note'].'</td>
                                                      <td><a href="'.$cir['Link_Coursera'].'" target="_bl">Show by link</a></td>
                                                      <td><button class="showCertificateBtn btn btn-success btn-sm" data-toggle="modal" data-target="#certificateModal" data-certificate="'.htmlspecialchars($cir['certif_image']).'">Show Certificate</button></td>
                                                      <td>
                                                        <button class="editMarkBtn btn btn-danger btn-sm"><a href="updatemark.php?idcc='.$cir['id_certif'].'&idss='.$tilmid['id_student'].'" style="color : white;">Edit Mark</a>
                                                        </button>
                                                      </td>';
                                            }    ?> 
                                            </tr>
                                        <?php
                                      
                                        }
                                    } 
                                    }else{
                                      ?> <tr>
                                            <td scope="row"><?php echo $st['firstname']?></td>
                                            <td><?php echo $st['lastname']?></td>
                                            <td><?php $carsos=course::selectcourseById('course',$connection->conn,$idcrs) ; 
                                                      echo $carsos['nom_Course'];?></td>
                                          <?php $cir=Certificate::SelectCertificatesByStudandCourseId('certificat', $connection->conn,$st['id_student'],$idcrs);
                                          if(empty($cir)){
                                            echo '<td style="color : red;">No</td>
                                                  <td>0</td>
                                                  <td>-</td>
                                                  <td>-</td>     
                                            '; 
                                        }else{
                                            echo '<td style="color : green;">Yes</td>
                                                  <td>'.$cir['note'].'</td>
                                                  <td><a href="'.$cir['Link_Coursera'].'" target="_bl">Show by link</a></td>
                                                  <td><button class="showCertificateBtn btn btn-success btn-sm" data-toggle="modal" data-target="#certificateModal" data-certificate="'.htmlspecialchars($cir['certif_image']).'">Show Certificate</button></td>
                                                  <td>
                                                    <button class="editMarkBtn btn btn-danger btn-sm"><a href="updatemark.php?idcc='.$cir['id_certif'].'&idss='.$st['id_student'].'" style="color : white;">Edit Mark</a>
                                                    </button>
                                                  </td>';
                                         }    ?> 
                                        </tr>
                                      <?php
                                    }
                                 
                                   }else{
                                    foreach($talamid as $tilmid){

                                      ?> <tr>
                                            <td scope="row"><?php echo $tilmid['firstname']?></td>
                                            <td><?php echo $tilmid['lastname']?></td>
                                            <td><?php $carsos=course::selectcourseById('course',$connection->conn,$idcrs) ; 
                                                      echo $carsos['nom_Course'];?></td>
                                          <?php $cir=Certificate::SelectCertificatesByStudandCourseId('certificat', $connection->conn,$tilmid['id_student'],$idcrs);
                                          if(empty($cir)){
                                            echo '<td style="color : red;">No</td>
                                                  <td>0</td>
                                                  <td>-</td>
                                                  <td>-</td>     
                                            '; 
                                        }else{
                                            echo '<td style="color : green;">Yes</td>
                                                  <td>'.$cir['note'].'</td>
                                                  <td><a href="'.$cir['Link_Coursera'].'" target="_bl">Show by link</a></td>
                                                  <td><button class="showCertificateBtn btn btn-success btn-sm" data-toggle="modal" data-target="#certificateModal" data-certificate="'.htmlspecialchars($cir['certif_image']).'">Show Certificate</button></td>
                                                  <td>
                                                    <button class="editMarkBtn btn btn-danger btn-sm"><a href="updatemark.php?idcc='.$cir['id_certif'].'&idss='.$tilmid['id_student'].'" style="color : white;">Edit Mark</a>
                                                    </button>
                                                  </td>';
                                         }    ?> 
                                        </tr>
                                      <?php
                                    
                                    }
                                   }
                                        ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="file_content" id="file_content" />
                            <button type="button" name="convert" id="convert" class="btn btn-primary">Convert</button>
                            </form>
                            </div>
                         </div>
            <!-- 7et L'id dial filiere f session lhmar li wldk  -->
                    
                </div>
                </section><!-- End Testimonials Section -->
        
                <!-- Modal -->
<div class="modal fade" id="certificateModal" tabindex="-1" role="dialog" aria-labelledby="certificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificateModalLabel">Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content of the modal -->
                <img id="certificateImage" src="" alt="Certificate Image" class="img-fluid" >
            </div>
        </div>
    </div>
</div>


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

<script>
    $(document).ready(function () {
        // Handle click on "Show Certificate" button
        $('.showCertificateBtn').click(function () {
            var certificatePath = $(this).data('certificate');
            $('#certificateImage').attr('src', 'certifmage/' + certificatePath);
        });
    });

$(document).ready(function(){
    $('#convert').click(function(){
      var table_content = '<table>';
      table_content += $('#table_content').html();
      table_content += '</table>';
      $('#file_content').val(table_content);
      $('#convert_form').submit();
    });
});
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</body>

</html>
