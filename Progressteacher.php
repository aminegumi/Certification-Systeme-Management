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
include('__classProgress.php');
$connection = new connection();
$connection->selectDatabase('courserax');
$error="";
$IDteach = '';
$AdminResp = '';
$emailTeach = '';
$A = '';
if(isset($_SESSION['idtch'])){
    $IDteach = $_SESSION['idtch'];
    $AdminResp=$_SESSION['idadmintch'];
    $emailTeach = $_SESSION['emailtch'];
    
    $A=$_SESSION['firstnametch']." ". $_SESSION['lastnametch'];
}else{
     header('Location: logoutstudent.php');
}

$groupix="";

if(isset($_GET["id"])){

 $idc=$_GET['id'];
 $crs=course::selectcourseById('course',$connection->conn,$_GET['id']);

}
$matiere=Matiere::selectMatiereById('matiere',$connection->conn,$crs['Id_mat']);
$fl=filiere::selectfiliereById('Filiere',$connection->conn,$matiere['id_filM']);
$IDcourse = $_GET['id'];
$IDfiliere=$fl['id_Filiere'];
$groupe='';
$dateprogress ='';
if (isset($_POST['viewProgress'])){
    $groupe=$_POST['Groupe'];
    $dateprogress=$_POST['DateP'];
    if(empty($groupe) || empty($dateprogress)){
        $error = " Choose the Group and the date!";
    }else{
        
        $pro = Progress::selectProgressByCrsandGpdate('progress',$connection->conn,$IDcourse,$groupe,$dateprogress);
        $_SESSION['unenrolled']=$pro['punenrolled'];
        $_SESSION['inprogress']=$pro['pinprogress'];
        $_SESSION['completed']=$pro['pcompleted'];
        $_SESSION['filierii']=$fl['id_Filiere'];
        $_SESSION['groupies']=$groupe;
        $_SESSION['coursawi']=$IDcourse;
        $_SESSION['dta']=$dateprogress;

        header('Location:ShowProgressdetails.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>View Certificat</title>
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
            <h2>View Progress for this Course : <?php echo $crs['nom_Course'] .' :   '. $matiere['nom_Matiere'] ; ?> course</h2>
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
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="linkcertif" class="form-label">Filiere</label>
                        <input type="text" class="form-control" id="linkcertif" name="linkcertif"  value="<?php echo $fl['nom_Filiere']; ?>" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label for="linkcertif" class="form-label">Date Progress</label>
                        <select name='DateP' class="form-select">
                            <option>Date Progress</option>
                                     <?php
                                     $Progresses = Progress::selectdistinctdateProgress('progress',$connection->conn);
                                     if(empty($Progresses)){
                                      echo '<option>khawia</option>';
                                     }else{
                                      foreach($Progresses as $P){
                                        echo '<option value='.$P['datep'].' >'.$P['datep'].'</option>';
                                      }
                                     }
                                    ?>
                        </select>
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
                                        echo '<option value='.$gp['groupe'].' >'.$gp['groupe'].'</option>';
                                        }
                                    ?>
                        </select>
                    </div>
    
                    <button type="submit" name="viewProgress" class="btn btn-success">View Progess</button>
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