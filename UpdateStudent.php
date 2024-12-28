<?php
//include connection file
session_start();
include('__classfiliere.php');
include('__classteacher.php');
include('__classstudent.php');
include('__classStudentTeacher.php');
include('newconnection.php');
$errorMesage = "";
$successMesage = "";
$fnameValue = "";
$lnameValue = "";
$emailValue = "";
$groupeValue = "";
$FiliereIDValue = "";
//include('loginAdmin.php');
// top
//include('__classfiliere.php');
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


if($_SERVER['REQUEST_METHOD']=='GET'){

    $id = $_GET['id'];

    //call the staticbselectClientById method and store the result of the method in $row
    $std=student::selectStudentById('student',$connection->conn,$id);
    $fnameValue = $std['firstname'];
    $lnameValue = $std['lastname'];
    $emailValue = $std['email'];
    $groupeValue = $std['groupe'];
    $FiliereIDValue = $std['filiereID'];
}
else if(isset($_POST['UpdateStudent'])){
    $fnameValue = $_POST['firstnameInput'];
    $lnameValue = $_POST['lastnameInput'];
    $emailValue = $_POST['emailInput'];
    $groupeValue = $_POST['groupeInput'];
    $FiliereIDValue = $_POST['filiereIDInput'];
    if(empty($emailValue) || empty($fnameValue) || empty($lnameValue) || empty($groupeValue) || empty($FiliereIDValue)){

        $errorMesage = "all fileds must be filed out!";

    }
    else {

        
        //create a new instance of client ($client) with inputs values
        $student = new student($lnameValue,$fnameValue,'',$FiliereIDValue,$groupeValue,$emailValue);

        //call the static updateClient method and give $client in the parameters
        student::updateStudent($student,'student',$connection->conn, $_GET['id']);
        header('Location: ShowGroups.php');
            
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
    <!-- <style>
        body {
    background-color: white; /* Set the background color to white */
    color: green; /* Set the text color to green */
}

.navbar.bg-secondary {
    background-color: green !important; /* Set the navbar background color to green */
}

.navbar-dark .navbar-toggler-icon {
    background-color: white; /* Set the color of the navbar toggler icon to white */
}

.navbar-dark .navbar-nav .nav-link {
    color: white !important; /* Set the color of the navbar links to white */
}

.sidebar {
    background-color: green; /* Set the sidebar background color to green */
    color: white; /* Set the text color in the sidebar to white */
}

.sidebar .navbar-brand h3 {
    color: white; /* Set the color of the brand in the sidebar to white */
}

.sidebar .navbar-nav .nav-link {
    color: white !important; /* Set the color of the sidebar links to white */
}

.sidebar .navbar-nav .nav-item.active {
    background-color: white; /* Set the background color of the active link in the sidebar to white */
    color: green !important; /* Set the color of the text in the active link to green */
}

.content {
    background-color: white; /* Set the background color of the content area to white */
    color: green; /* Set the text color in the content area to green */
}

    </style> -->

    
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
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <form class="d-none d-md-flex ms-4">
                        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                    </form>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-envelope me-lg-2"></i>
                                <span class="d-none d-lg-inline-flex">Message</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all message</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-bell me-lg-2"></i>
                                <span class="d-none d-lg-inline-flex">Notificatin</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Profile updated</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">New user added</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Password changed</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all notifications</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
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
                <!-- Navbar End -->
                <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>UPDATE STUDENT</h3>
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
                            <input type="text" name="firstnameInput" class="form-control" value="<?php echo $fnameValue ?>" id="floatingText" placeholder="first name">
                            <label for="floatingText">First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="lastnameInput" value="<?php echo $lnameValue ?>" class="form-control" id="floatingText" placeholder="last name">
                            <label for="floatingText">Last Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="emailInput" value="<?php echo $emailValue ?>" class="form-control" id="floatingInput" placeholder="name@emsi.ma">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="mb-3">
                        <select name='filiereIDInput' class="form-select">
                            <option value="<?php echo $FiliereIDValue ?>">new Major</option>
                                     <?php
                                        $data=filiere::selectfiliereByAdminId('filiere',$connection->conn,$varID);
                                        foreach($data as $row){
                                        echo "<option value='$row[id_Filiere]' >$row[nom_Filiere]</option>";
                                        }
                                    ?>
                        </select>
                        </div> 
                        <div class="mb-3">
                            <label for="groupe" class="form-label">Choose new group</label>
                            <input class="form-control" value="<?php echo $groupeValue ?>" list="groupes" name="groupeInput" id="groupes" pattern="1|2|3|4|5|6|7|8|9|10" required>
                            <datalist id="groupes">
                            <option value="1">
                            <option value="2">
                            <option value="3">
                            <option value="4">
                            <option value="5">
                            <option value="6">
                            <option value="7">
                            <option value="8">
                            <option value="9">
                            <option value="10">
                            </datalist>
                       </div>
                        </div>
                       <?php if(!empty($successMesage)){
                             echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                             <strong>$successMesage</strong>
                             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                             </button>
                             </div>";
                             }
                        ?>  
                        <button type="submit" name ="UpdateStudent" class="btn btn-primary py-3 w-100 mb-4">UPDATE</button>
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