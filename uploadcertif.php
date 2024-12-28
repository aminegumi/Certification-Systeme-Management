<?php
session_start();
include('newconnection.php');
include('__classScraping.php');
include('__classcourse.php');
include('__classcoursstudent.php');
include('__classstudent.php');
include('__classCertificat.php');
$connection = new connection();
$connection->selectDatabase('courserax');
$error = "";
$daysDifference = '';
$link = "";
$certifimg = "";

if(isset($_GET["id"])){
    $idc=$_GET['id'];
    $date=$_GET['date'];
    $crs=course::selectcourseById('course',$connection->conn,$_GET['id']);
}

if(isset($_SESSION['idstudent'])){
    $ids = $_SESSION['idstudent'];
    $testcertif=Certificate::SelectCertificatesByStudandCourseId('Certificat',$connection->conn,$ids,$_GET['id']);
    $vargroup = $_SESSION['groupestudent'];
    $A=$_SESSION['lastnamestd']." ".$_SESSION['firstnamestd'];
    $B=$_SESSION['firstnamestd']." ".$_SESSION['lastnamestd'];
    

}else{
  header('Location: logoutstudent.php');
}

if (empty($testcertif)){

    if (isset($_POST['uploadcertif'])) {
        $link = $_POST['linkcertif'];
        $certifimg = $_FILES['filecertif']['name']; // Use $_FILES for file uploads
        $ids = $_SESSION['idstudent'];

        if(empty($link) || empty($certifimg)){
        $error = "all fields must be filled out!";
        } else {

            if (filter_var($link, FILTER_VALIDATE_URL) === false) {
                $error = "Invalid URL format you should provide a valid Link";
            } else {
                $linkScrape = new WebScraper($link);
                $linkScrape->scrape();
                $StudentScraped =  strtolower($linkScrape->getStudentName());
                $CourseScrapedWith = strtolower($linkScrape->getCourseName());
                $CourseScraped = str_replace("'", ' ', $CourseScrapedWith);
                $datescraped = $linkScrape->getFormattedDate();
                $dateScraped = new DateTime($datescraped);
                $date = new DateTime($date);

                $interval = $dateScraped->diff($date);
                $daysDifference = $interval->days;

                $notation = courseS::selectASCBygroupeIdANDcourse('coursestudent', $connection->conn, $vargroup, $idc);
                $na9iss = $notation['notation'];
                $dateXXL = $notation['DateControle'];
                $dateXXL = new DateTime($dateXXL);

                if ($dateScraped <= $date) {
                    $note = 20;
                } else {
                    if ($dateScraped <= $dateXXL) {
                        $note = 20 - intdiv($daysDifference , 7)*$na9iss;
                        $note = max(10, $note); 
                    } else {
                        $note = 0;
                    }
                }

                if((strtolower($A) == $StudentScraped || strtolower($B) == $StudentScraped) && $CourseScraped == strtolower($crs['nom_Course'])){
                $certif = new Certificate($idc, $ids, $datescraped, $link, $note, $certifimg);
                $certif->insertCertificat('Certificat', $connection->conn);
                $targetDirectory = 'C:/xampp/htdocs/CourseraProjectByIMAD&AMINEvv/certifmage/';
                $targetPath = $targetDirectory . basename($certifimg);

                    if (move_uploaded_file($_FILES['filecertif']['tmp_name'], $targetPath)) {
                        echo "The file " . basename($certifimg) . " has been uploaded.";
                    } else {
                        $error= "Sorry, there was an error uploading your file.";
                    }

                header('Location: courses.php');
                
                } else {
                    $error = 'the information provided in the certificate does not match with your information';
                }
            }
        }
    }

} else  {
    $error = "the certificate is already exists if you want to upload a new one you must delete the previous one !";
    if (isset($_POST['uploadcertif'])) {
        $link = $_POST['linkcertif'];
        $certifimg = $_FILES['filecertif']['name']; 
        $ids = $_SESSION['idstudent'];
        if(empty($link) || empty($certifimg)){
            $error = "all fields must be filled out!";
        } else {
            if (filter_var($link, FILTER_VALIDATE_URL) === false) {
                $error = "Invalid URL format you should provide a valid Link";
            } else {
                $linkScrape = new WebScraper($link);
                $linkScrape->scrape();
                $StudentScraped =  strtolower($linkScrape->getStudentName());
                $CourseScrapedWith = strtolower($linkScrape->getCourseName());
                $CourseScraped = str_replace("'", ' ', $CourseScrapedWith);
                $datescraped = $linkScrape->getFormattedDate();
                $dateScraped = new DateTime($datescraped);
                $date = new DateTime($date);

                $interval = $dateScraped->diff($date);
                $daysDifference = $interval->days;

                $notation = courseS::selectASCBygroupeIdANDcourse('coursestudent', $connection->conn, $vargroup, $idc);
                $na9iss = $notation['notation'];
                $dateXXL = $notation['DateControle'];
                $dateXXL = new DateTime($dateXXL);
                

                if ($dateScraped <= $date) {
                    $note = 20;
                } else {
                    if ($dateScraped <= $dateXXL) {
                        $note = 20 - $daysDifference * $na9iss;
                        $note = max(10, $note); 
                    } else {
                        $note = 0;
                    }
                }

                if(strtolower($A) == $StudentScraped && $CourseScraped == strtolower($crs['nom_Course'])){
                Certificate::DeleteCertificateById('Certificat',$connection->conn,$testcertif['id_certif']);
                $certif = new Certificate($idc, $ids, $datescraped, $link, $note, $certifimg);
                $certif->insertCertificat('Certificat', $connection->conn);
                $targetDirectory = 'C:/xampp/htdocs/CourseraProjectByIMAD&AMINEvv/certifmage/';
                $targetPath = $targetDirectory . basename($certifimg);

                    if (move_uploaded_file($_FILES['filecertif']['tmp_name'], $targetPath)) {
                        echo "The file " . basename($certifimg) . " has been uploaded.";
                    } else {
                        $error= "Sorry, there was an error uploading your file.";
                    }

                header('Location: courses.php');
                } else {
                 $error = 'the information provided in the certificate does not match with your information ';
                }
            }
        }
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



  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Upload certificate for <?php echo $crs['nom_Course'] ?> course</h2>
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
                        <label for="linkcertif" class="form-label">Certificate Link</label>
                        <input type="text" class="form-control" id="linkcertif" name="linkcertif" required>
                    </div>
                    <div class="mb-3">
                        <label for="filecertif" class="form-label">Upload Certificate Image</label>
                        <input type="file" class="form-control" id="filecertif" name="filecertif" accept="image/*" required>
                    </div>
                    <button type="submit" name="uploadcertif" class="btn btn-success">Upload Certificate</button>
                </form>
            </div>
        </div>
    </div>
    <!-- warning message ... -->
</main>
<br><br><br>

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