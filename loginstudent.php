<?php
// session_start();
include("configh.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-Ls9hH/dGHJ5IUpHtj5Y3kxTA3EnOj4mIKEXLs4OWjJUW/uLcQ2oOUhh2bgyUqyK0vTy3qj4V9TCWIB1V7/bjGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>EMSI Coursera Platform</title>
    <link href="img/logo.jfif" rel="icon">
    <style>
      .divider:after,.divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
      }
      .h-custom {
      height: calc(100% - 73px);
      }
      @media (max-width: 450px) {
      .h-custom {
      height: 100%;
      }
      }
    </style>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="img/login.jpg" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

  <form method="post"> 
          <center><img src="https://emsi.ma/wp-content/uploads/2020/07/logo-1.png"
                    style="width: 200px;" alt="logo">
          <img src="https://files.clinchtalent.com/1d7f2c0f91ebf75d580f56447fa54859/eba0875041db9b79892abad2b9e961e2/Coursera.png"
                    style="width: 200px;" alt="logo"></center> <br> <br>
          <div class="form-outline mb-4">
          <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" name="emailName" id="email" class="form-control form-control-lg"
              placeholder="Enter a valid email address"  value="<?php if(isset($emailValue)) echo $emailValue ?>"/>
              <span style="color: red;"><?php echo $emailErrorMsg ?></span>
          </div>
          <div class="form-outline mb-3">
          <label class="form-label" for="form3Example4">Password</label>
            <input type="password" name="passwordName" id="pass" class="form-control form-control-lg"
              placeholder="Enter password" />
              <span style="color: red;"><?php echo $passwordErrorMsg ?></span>
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" name="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2023. All rights reserved.
    </div>
    <div class="text-white mb-3 mb-md-0">
      Developed by <a href="#" style="color:white">ISSAME IMAD & AGOUMI MOHAMMED AMINE</a>
    </div>
    <div class="text-white mb-3 mb-md-0">
      Supervised by <a href="#" style="color:white">Mrs. Amine Zeguendry</a>
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>
</body>
</html>