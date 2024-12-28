<?php
require_once 'vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use \PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\IOFactory;
session_start();
include('__classfiliere.php');
include('newconnection.php');
include('__classstudent.php');


$connection = new connection();
$connection->selectDatabase('Courserax');

if(isset($_SESSION['idadmin'])){
    $varID = $_SESSION['idadmin'];
    $varnom = $_SESSION['nom'];
    $varprenom = $_SESSION['prenom'];
} else {
    header('Location: logoutAdmin.php');
}

$email = "";
$last_name = "";
$first_name = "";
$password = "";
$Filiere = "";
$errorMesage = "";
$successMesage = "";
$K=0;  
$Groupe = 1;

if(isset($_POST["submitGroups"])){
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
    


if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)) {
        $reader = new Xlsx(); 
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']); 
        $worksheet = $spreadsheet->getActiveSheet();  
        $worksheet_arr = $worksheet->toArray(); 
        $fil=[];
        $fil=explode(" ",trim($worksheet_arr[3][0]));
        $FiliereN=$fil[0].' '.$fil[1];
        $FilF=filiere::selectfiliereByName('filiere',$connection->conn,$FiliereN);
        $Filiere=$FilF['id_Filiere'];
        unset($worksheet_arr[0]);
        unset($worksheet_arr[1]);
        unset($worksheet_arr[2]);
        unset($worksheet_arr[3]);
        unset($worksheet_arr[4]);
        $usedColors=[];
        $x=count($worksheet_arr)+5;
        for($i=6; $i<=$x; $i++){
            $color=$worksheet->getStyle("A{$i}")->getFill()->getStartColor()->getARGB();
            array_push($usedColors,$color);
        }
foreach ($worksheet_arr as $row) {
   if(!empty($row[0])){
    // $f=$index+6;
    // $colorrr=$worksheet->getStyle("A{$f}")->getFill()->getStartColor()->getARGB();
    // array_push($usedColorsss,$colorrr);
    $last_name = strtolower($row[1]);
    $first_name = strtolower($row[2]);
    $email = ucfirst(strtolower(preg_replace('/\s+/', '', $first_name))).ucfirst(strtolower(preg_replace('/\s+/', '', $last_name))) . '@emsi.ma';
    $password = ucfirst(preg_replace('/\s+/', '', $last_name)) . '000000';
    
   
    
        if (empty($email) || empty($first_name) || empty($last_name) || empty($password) || empty($Filiere) || empty($Groupe)) {
            $errorMesage = "All fields must be filled out!";
        } else if (strlen($password) < 8) {
            $errorMesage = "Password must contain at least 8 characters";
        } else if (preg_match("/[A-Z]+/", $password) == 0) {
            $errorMesage = "Password must contain at least one capital letter!";
        } else if (preg_match("/[a-zA-Z]+@emsi.ma{1}$/", $email) == 0) {
            $errorMesage = "Please enter a valid emsi email!";
        } else {
            $student = new student($last_name, $first_name, $password, $Filiere, $Groupe, $email);
            $student->insertStudent('student', $connection->conn);
            $successMesage = "Groups added successfully!";
            $email = "";
            $last_name = "";
            $first_name = "";
        
        }
        if($usedColors[$K]!=$usedColors[$K+1]) {
            $Groupe=$Groupe+1;
        }
        $K=$K+1;
    
   }
} 
}else {
    $errorMesage = 'Invalid file type';
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EMSI Coursera Platform</title>
    <link href="img/logo.jfif" rel="icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">

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
        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="AdminIterface.php" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>ADD Groups</h3>
                            </a>
                            </div>

                            <?php

                            if(!empty($errorMesage)){
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$errorMesage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                            </button>
                            </div>";
                            }
                            ?>

                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                                <label for="formFile" class="form-label">Excel file</label>
                                <input class="form-control bg-dark" type="file" id="formFile" name="file">
                         </div>
                        
                       <?php if(!empty($successMesage)){
                             echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                             <strong>$successMesage</strong>
                             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                             </button>
                             </div>";
                             }
                        ?>  
                        <button type="submit" name ="submitGroups" class="btn btn-primary py-3 w-100 mb-4">Add Groups</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
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