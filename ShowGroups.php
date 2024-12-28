<?php
//include connection file
session_start();
include('newconnection.php');
//include('loginAdmin.php');
// top
include('__classfiliere.php');
include('__classstudent.php');
include('__classteacher.php');
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
                <?php
                    include('stat.php');
                ?>
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary text-center rounded p-4">
                    <div class="row g-4">
                    <?php
                    if(!empty($filieres)){
                    foreach( $filieres as $fl) {
                        ?>
                    <div class="d-flex align-items-center text-center justify-content-between mb-4">
                        <h3 class="mb-0  "><?php echo $fl['nom_Filiere']; ?></h3>
                    </div>
                    <?php 
                    $groupe = student::selectStudentDistinctGroupe('student',$connection->conn,$fl['id_Filiere']);
                    if(empty($groupe)){
                        echo '<p>No Groupe made yet</p>';
                    }else{
                    foreach($groupe as $gp){
                        ?>
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-secondary rounded h-100 p-4">
                                 <h5><?php echo 'Groupe ' . $gp['groupe']; ?></h5>
                                 <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Modify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $studentss=student::selectStudentByfiliereIdAndGroupe('student',$connection->conn,$fl['id_Filiere'],$gp['groupe']);
                                        foreach($studentss as $std){
                                            ?>
                                            <tr>
                                                <td scope="row"><?php echo $std['firstname']?></td>
                                                <td><?php echo $std['lastname']?></td>
                                                <td><?php echo $std['email']?></td>
                                                <td><a class="btn btn-sm btn-primary" href="UpdateStudent.php?id=<?php echo $std['id_student'] ?>">Update</a>
                                                    <a class="btn btn-sm btn-primary" href="DeleteStudent.php?id=<?php echo $std['id_student'] ?>">Delete</a></td>
                                                
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                            </div>
                         </div>
                        <?php
                    }
                    }
                    ?>
                    <hr>
                        <?php
                    }}
                    ?>
                    </div> 
                    </div>
                    
                </div>
            </div>
            <!-- Recent Sales End -->

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