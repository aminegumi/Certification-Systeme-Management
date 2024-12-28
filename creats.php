

<?php
//include connection file
include('newconnection.php');
// top
include('student.php');
   

//create in instance of class Connection
$connection = new connection();


//call the selectDatabase method
$connection->selectDatabase('courserax');
$emailValue = "";
$lnameValue = "";
$fnameValue = "";
$passwordValue = "";
$filiereValue = "";
$groupeValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submitStudent"])){

    $emailValue = $_POST["email"];
    $lnameValue = $_POST["nom"];
    $fnameValue = $_POST["prenom"];
    $passwordValue = $_POST["password"];
    $filiereValue = $_POST["filiere"];
    // $idValue = $_POST["idStudent"];
    $groupeValue = $_POST["groupe"];
    // $idCityValue=$_POST["cities"];

    if(empty($emailValue) || empty($fnameValue) || empty($lnameValue) || empty($passwordValue) || empty($filiereValue) || empty($groupeValue)){

            $errorMesage = "all fileds must be filed out!";

    }else if(strlen($passwordValue) < 8 ){
        $errorMesage = "password must contains at least 8 char";
    }else if(preg_match("/[A-Z]+/", $passwordValue)==0){
        $errorMesage = "password must contains  at least one capital letter!";
    // }else if(preg_match("/^[a-z]+@emsi.ma{1}$/", $emailValue)==0){
    //   $errorMesage = "please enter a valid emsi email!";
    // }
    }else if(preg_match("/^[a-z]+@emsi.ma{1}$/", $emailValue)==0){

      $errorMesage= "please enter a valid emsi email!";
  
    }else{
       
    
    //include the client file
    // included on the top of the file shame on youuu

    //create new instance of client class with the values of the inputs
    $student = new student($lnameValue,$fnameValue,$passwordValue,$filiereValue,$groupeValue,$emailValue);

//call the insertClient method
$student->insertStudent('student',$connection->conn);

//give the $successMesage the value of the static $successMsg of the class
$successMesage = student::$successMsg;

//give the $errorMesage the value of the static $errorMsg of the class
$errorMesage = student::$errorMsg;

$emailValue = "";
$lnameValue = "";
$fnameValue = "";
$filiereValue = "";
$groupeValue = "";
      
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-Ls9hH/dGHJ5IUpHtj5Y3kxTA3EnOj4mIKEXLs4OWjJUW/uLcQ2oOUhh2bgyUqyK0vTy3qj4V9TCWIB1V7/bjGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('https://t3.ftcdn.net/jpg/03/35/00/02/360_F_335000208_XJyUUnkg2TPfrMfiHPWW9LtCvea3x46K.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">ADD NEW STUDENT</h2>
          <br>    
    <?php

                if(!empty($errorMesage)){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMesage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                </button>
                </div>";
                }
    ?>
    <br>
          <form method="post">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                <label class="form-label" for="form3Example1">First name</label>
                  <input type="text" name="prenom" id="form3Example1" class="form-control" />
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                <label class="form-label" for="form3Example2">Last name</label>
                  <input type="text" name="nom" id="form3Example2" class="form-control" />
                </div>
              </div>
            </div>

            <!-- ID student -->
            <!-- <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3">ID student</label>
              <input type="text" name="idStudent" id="form3Example3" class="form-control" />
            </div> -->

            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3">Email address</label>
              <input type="email" name="email" id="form3Example3" class="form-control" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
            <label class="form-label" for="form3Example4">Password</label>
              <input type="password" name="password" id="form3Example4" class="form-control" />
               <!-- Checkbox -->
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Show Password</label>
            </div>
            </div>
            <!-- filiere -->
            <div class="form-outline mb-4">
            <label for="filiere" class="form-label">Choose your major</label>
            <input class="form-control" list="filieres" name="filiere" id="filiere" pattern="1er Annee preparatoire|2eme Annee preparatoire|1er annee Genie Civil|2eme annee Genie Civil|3eme annee Genie Civil|4eme annee Genie Civil|5eme annee Genie Civil|3eme Informatique et Reseaux|4eme Informatique et Reseaux|5eme Informatique et Reseaux|1er annee Finance et Audit |2eme annee Finance et Audit|3eme annee Finance et Audit|4eme annee Finance et Audit|5eme annee Finance et Audit|3eme Informatique Industrille|4eme Informatique Industrille|5eme Informatique Industrille|3eme Automatisme|4eme Automatisme|5eme Automatisme" required>
            <datalist id="filieres">
              <option value="1er Annee preparatoire">
              <option value="2eme Annee preparatoire">
              <option value="1er annee Genie Civil ">
              <option value="2eme annee Genie Civil ">
              <option value="3eme annee Genie Civil ">
              <option value="4eme annee Genie Civil ">
              <option value="5eme annee Genie Civil ">
              <option value="3eme Informatique et Reseaux">
              <option value="4eme Informatique et Reseaux">
              <option value="5eme Informatique et Reseaux">
              <option value="1er annee Finance et Audit ">
              <option value="2eme annee Finance et Audit ">
              <option value="3eme annee Finance et Audit ">
              <option value="4eme annee Finance et Audit ">
              <option value="5eme annee Finance et Audit ">
              <option value="3eme Informatique Industrille">
              <option value="4eme Informatique Industrille">
              <option value="5eme Informatique Industrille">
              <option value="3eme Automatisme">
              <option value="4eme Automatisme">
              <option value="5eme Automatisme">
            </datalist>
          </div>

          <!-- Groupe -->
          <div class="form-outline mb-4">
            <label for="groupe" class="form-label">Choose your group</label>
            <input class="form-control" list="groupes" name="groupe" id="groupe" pattern="1|2|3|4|5|6|7|8|9|10" required>
            <datalist id="groupe">
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

          
<!-- the first one 
            <div class="form-check d-flex justify-content-center mb-4">
            <label class="form-check-label" for="form2Example33">Subscribe to our newsletter</label><br>
              <input class="form-check-input me-2" type="checkbox" value="Subscribe to our newsletter" id="form2Example33" checked />
            </div>
-->
<?php
            if(!empty($successMesage)){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMesage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
            </button>
            </div>";
            }
  ?>  
            <!-- Submit button -->
            <button type="submit" name="submitStudent" class="btn btn-success btn-block mb-4">
              ADD STUDENT
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
