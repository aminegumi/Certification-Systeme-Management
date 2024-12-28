<?php
    // include('logoutstudent.php');
    // session_start();
    include('configh.php');
    if(isset($_SESSION['firstnamestd'])){
      $A=$_SESSION['lastnamestd']." ".$_SESSION['firstnamestd'];

    }else{
       header('Location: logoutstudent.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Emsi Coursera Platform</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/logo.jfif" rel="icon">
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
 <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="home.php"> Emsi Platform </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="about.php"class="active">About</a></li>
          <li><a href="courses.php"  >Courses</a></li>
          <!-- <li><a href="trainers.html">Trainers</a></li> -->
          <!-- <li><a href="events.html">Events</a></li> -->
          <!-- <li><a href="pricing.html">Pricing</a></li> -->

          
          <li ><a href="#" style="color: green;"><?php echo "Welcome "."".$A ?></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="logoutstudent.php" class="get-started-btn">Logout</a>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>About Us</h2>
        <p>At our engineering school, we are dedicated to academic excellence, innovation, and preparing students for successful careers in engineering. With a committed faculty, advanced facilities, and a practical curriculum, we provide a dynamic learning environment that equips students with the skills to excel in the evolving field of engineering. Our focus on real-world applications, research, and industry relevance distinguishes us as a leading choice for aspiring enginee .</p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/histoire.jpg" class="img-fluid" alt="">
          </div>
          <!-- <center></center> -->
          <div class="section-title" >
            <br><br><br><br>
            <h2>Interview</h2>
            <p>Prof. Daissaoui KAMAL</p>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <br> 
            <h3>WHAT MOTIVATED YOU TO CREATE THE MOROCCAN SCHOOL OF ENGINEERING SCIENCES?</h3> <br>
            <!-- <p class="fst-italic" style="line-height: 2.5;">
              
Our story began 35 years ago with a founding commitment to academic excellence, a dedication to research and innovation, and a focus on employability. Over the years, our institution has grown and flourished, now spanning 16 campuses and welcoming more than 11,000 engineering students. With 35 years of experience, we take pride in our role as a key contributor to education and development, having produced over 16,000 laureates. Recognized by the state, our journey continues as we actively engage in the international arena, fostering a vibrant student life and promoting a holistic approach to education that extends beyond the classroom.
            </p> -->
            <p class="fst-italic" style="line-height: 1.9;" >
              In 1986, we were four professors, founding members of the Moroccan School of Engineering Sciences, who decided to take over the responsibility of training engineers in a 4-year program after high school. The initially chosen curriculum matched our areas of expertise and perfectly addressed the needs of the employment sector. Our current program has evolved into a Bac+5 level. Our school closely monitors technological advancements and strategic changes in Morocco. It is within this framework that we have established several disciplines. The Engineering Division includes four disciplines: Computer Engineering and Networks, Automation Engineering and Industrial Computing, Industrial Engineering, Civil Engineering, and Construction. The Finance Division has one discipline with the possibility of two major options: Financial Engineering and Accounting, Control, and Audit.
            </p> <br><br>
            <h3>WHAT RESOURCES DO YOU HAVE FOR TRAINING FUTURE ENGINEERS IN THE ENGINEERING AND FINANCE DIVISIONS?</h3> <br>
            <p class="fst-italic" style="line-height: 1.9;" >
              EMSI has a total of 14 campuses across the Kingdom of Morocco (Casablanca, Rabat, Marrakech, and Tangier). Each of these campuses is equipped with numerous classrooms, laboratories, and computing centers equipped with sophisticated and state-of-the-art didactic materials for practical work, mini-projects, projects, and scientific research. More than 500 highly skilled permanent or visiting professors and engineers, from top schools, universities, and Moroccan businesses, contribute to EMSI. Additionally, our numerous partnership agreements with prestigious French universities allow our engineering students to simultaneously pursue a master's degree alongside the EMSI curriculum. Courses are jointly taught by professors from partner universities and EMSI instructors. This international openness enables some graduates to obtain a dual degree: the EMSI diploma and that of the partner university.
            </p> 
            <!-- <ul>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li> -->
            <!-- </ul> -->
            <!-- <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            </p> -->

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="11000" data-purecounter-duration="2" class="purecounter"></span>
            <p>Students</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="16" data-purecounter-duration="2" class="purecounter"></span>
            <p>Campuses</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="37" data-purecounter-duration="2" class="purecounter"></span>
            <p>Events</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="16000" data-purecounter-duration="2" class="purecounter"></span>
            <p>Laureates</p>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Testimonials</h2>
          <p>What are they saying</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                  <h3>Laarbi Batou</h3>
                  <h4>Computer Engineering Student</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Choosing EMSI was the best decision I made for my engineering education. The hands-on approach to learning, modern facilities, and supportive faculty have truly prepared me for the challenges of the tech industry.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                  <h3>Dr. Fati Sekhfa</h3>
                  <h4>Engineering Faculty</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Teaching at EMSI is fulfilling. The commitment to academic excellence and the continuous evolution of the curriculum keep me inspired. It's a joy to contribute to shaping the next generation of engineers.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                  <h3>Amina Sota</h3>
                  <h4>Finance Student</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    EMSI not only provided me with a strong foundation in financial engineering but also opened doors to international opportunities. The diverse curriculum and expert professors make learning here a rewarding experience.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                  <h3>Simo L cabale</h3>
                  <h4>Administrative Staff</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Being part of the EMSI team is like being part of a family. The dedication to student success and the positive work environment make every day enjoyable. I'm proud to contribute to the success of the institution.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                  <h3>Prof. Karim papay</h3>
                  <h4>Finance Faculty</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    EMSI's approach to finance education is dynamic and forward-thinking. The collaborative atmosphere among faculty and the emphasis on practical applications create an enriching teaching environment.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

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

</body>

</html>