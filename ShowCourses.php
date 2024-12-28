<?php
//include connection file
session_start();
include('newconnection.php');
//include('loginAdmin.php');
// top
include('__classcourse.php');
include('__classfiliere.php');
include('__classstudent.php');
include('__classteacher.php');
include('__classMatiere.php');
//create in instance of class Connection
$connection = new connection();
//call the selectDatabase method
$connection->selectDatabase('Courserax');
if(isset($_SESSION['idadmin'])){
    $varID = $_SESSION['idadmin'];
    $varnom = $_SESSION['nom'];
    $varprenom = $_SESSION['prenom'];
}else{
    header('Location: logoutAdmin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EMSI Coursera Platform</title>
    <link href="img/logo.jfif" rel="icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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

    <style>
    /* Add this style to break long words in table cells */
    .table.table-bordered td {
        word-wrap: break-word;
    }
    .table.table-bordered th,
    .table.table-bordered td {
        border: none;
    }
</style>
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->

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
                
                
                <?php
                    include('stat.php');
                ?>
                                
                
               
<div class="col-12">
    <div class="container-fluid pt-4 px-5">
        <?php
            if(!empty($filieres)){
            foreach ($filieres as $fl) : ?>
                <div class="bg-secondary rounded h-100 p-4 my-4">
                    <h4><?php echo $fl['nom_Filiere']; ?></h4>
                    
                <?php
                $matiere=Matiere::selectMatiereByfiliereId('matiere',$connection->conn,$fl['id_Filiere']);
                if(empty($matiere)){
                    
                    ?><br><br><h6><?php echo "No Subject Added Yet" ?></h6><?php
                }else{
                foreach ($matiere as $mt) : ?>
                <br><br>
                <h5><?php echo $mt['nom_Matiere']; ?></h5>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Course Name</th>
                                <th scope="col">Course Link</th>
                                <th scope="col">Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $TCourses = Course::selectCoursesByMatiereId($connection->conn, $mt['id_Mat']);
                            if(empty($TCourses)){
                                echo '<p>There s no courses Added to this Subject</p>';
                            }else{
                            foreach ($TCourses as $tch) : ?>
                                <tr>
                                    <td scope="row" class="text-wrap"><?php echo $tch['nom_Course']; ?></td>
                                    <td class="text-wrap">
                                        <a class="btn btn-sm btn-primary" target="_blank" href="<?php echo $tch['linkTOcourse']; ?>">GO TO Course</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="UpdateCourses.php?id=<?php echo $tch['id_Course']; ?>">Update</a>
                                        <a class="btn btn-sm btn-primary" href="DeleteCourse.php?id=<?php echo $tch['id_Course']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; }?>
                        </tbody>
                    </table>
                </div>
                
                <?php endforeach; } ?>
            </div>
        <?php 
        endforeach; } ?>
    </div>
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