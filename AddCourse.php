<?php
session_start();
include("__classcourse.php");
include("__classfiliere.php");
include("__classMatiere.php");
include("newconnection.php");
$connection = new connection();
$connection->selectDatabase('courserax');
if(isset($_SESSION['idadmin'])){
    $varID = $_SESSION['idadmin'];
    $varnom = $_SESSION['nom'];
    $varprenom = $_SESSION['prenom'];
}else{
    header('Location: logoutAdmin.php');
}
// $teacher = new Teacher(); ha lghalat dayr constructeur par defaut
$data=[];

// $idTeacherValue = ""; 
$CourseNameValue = "";
$LinkCourseValue = "";
//$DateLimiteValue= "10-10-2010";
$MajorDestValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submitCourse"])){


    $CourseNameValue = str_replace("'", ' ', $_POST["CourseName"]);
    $LinkCourseValue = $_POST["LinkCourse"];
    $DateLimiteValue;
    $MajorDestValue = $_POST["MajorDest"];
    

    if(empty($CourseNameValue) || empty($LinkCourseValue) || empty($MajorDestValue)){

        $errorMesage = "all fileds must be filed out!";

    }else{

        $teacher = new Course($CourseNameValue,$LinkCourseValue,$MajorDestValue);

        $teacher->insertcourse('course',$connection->conn);

        $successMesage = Course::$SuccMsg;

        $errorMesage = Course::$ErrMsg;
        
        $CourseNameValue = "";
        $LinkCourseValue = "";
        $DateLimiteValue= "";
        $MajorDestValue = "";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- Favicon -->
    <title>Emsi Coursera Platform</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="img/logo.jfif" rel="icon">

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
        
      <?php include('sidebar.php'); ?>
        

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
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>ADD COURSE</h3>
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

                            <form action="" method="post">
                                
                        <!-- id student -->
                        <!-- <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingText" placeholder="etud-$">
                            <label for="floatingText">ID Student</label>
                        </div> -->
                        <div class="form-floating mb-3">
                            <input type="text" name="CourseName" class="form-control" id="floatingText" placeholder="first name">
                            <label for="floatingText">Course Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="LinkCourse" class="form-control" id="floatingText" placeholder="first name">
                            <label for="floatingText">Link To Course</label>
                        </div>
                        <!-- <div class="form-floating mb-3">
                            <input type="date" name="DateLimite" class="form-control" id="floatingText" placeholder="first name">
                            <label for="floatingText">DeadLine</label>
                        </div> -->
                        <div class="form-floating mb-3">
                            <select name='MajorDest' class="form-select" id="SelectFiliere">
                                    <option selected>Major Destination</option>
                                     <?php
                                        $data=filiere::selectfiliereByAdminId('filiere',$connection->conn,$varID);
                                        foreach($data as $row){
                                            echo "<option value='$row[id_Filiere]'>$row[nom_Filiere]</option>";   
                                        }
                                            
                                    ?>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <select name='Subject' class="form-select" id="SelectMatieres">
                                <option value="" selected>Subject</option>
                            </select>
                        </div>
                       <?php if(!empty($successMesage)){
                             echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                             <strong>$successMesage</strong>
                             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                             </button>
                             </div>";
                             }
                        ?>  
                        <button type="submit" name ="submitCourse" class="btn btn-primary py-3 w-100 mb-4">Add Course</button>
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
    <script>
        document.getElementById('SelectFiliere').addEventListener('change', function() {
            var selectedFiliereId = this.value;

            fetch('fetch_matieres.php?filiere_id=' + selectedFiliereId)
                .then(response => response.json())
                .then(data => {
                    var selectMatieres = document.getElementById('SelectMatieres');
                    selectMatieres.innerHTML = "<option value='' selected>Subject</option>";

                    data.forEach(matiere => {
                        var option = document.createElement('option');
                        option.value = matiere.id_Mat;
                        option.textContent = matiere.nom_Matiere;
                        selectMatieres.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching Matieres:', error));
        });
    </script>
    </div>
    
</body>
</html>