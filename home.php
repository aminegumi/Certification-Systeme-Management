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
  <style>
  .sponsor-logo {
    height: 200px; /* Set the desired height for the sponsor logos */
  }
  #trainers .member img {
      width: 450px;
      height: 450px;
      object-fit: cover;
    }




.course-item .trainer-profile {
  display: flex;
  align-items: center;
}

.course-item .trainer-profile img {
  width: 50px; /* Set a fixed width for the image */
  height: 50px; /* Set a fixed height for the image */
  border-radius: 50%; /* Make the image circular */
  object-fit: cover; /* Ensure the image covers the entire circle */
  margin-right: 10px; /* Adjust as needed for spacing */
}

.course-item .trainer-profile span {
  font-weight: bold;
}

</style>
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
          <li><a class="active" href="home.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="courses.php">Courses</a></li>
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

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Learning Today,<br>Leading Tomorrow</h1>
      <h2>We provide our engineering students with high-quality education and experiences that prepare them for success in their careers. We also assist them in discovering a field that they are passionate about and encourage them to lead in that direction. Our schools are recognized by the State </h2>
      <a href="courses.php" class="btn-get-started">View Courses</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <br><br><br>
            <img src="assets/img/IMGGG.PNG" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>The media is talking about us</h3>
            <!-- <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p> -->
            <p><br></p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <a href="https://www.leconomiste.com/flash-infos/l-emsi-primee-tokyo"> EMSI Awarded in Tokyo </li>
              <li><i class="bi bi-check-circle"></i> <a href="https://leseco.ma/business/emsi-mohamed-essaidi-notre-relation-avec-les-entreprises-est-une-relation-de-proximite.html"> EMSI. Mohamed Essaidi: " Our relationship with companies is one of proximity "</li>
              <li><i class="bi bi-check-circle"></i> <a href="https://fr.media7.ma/les-technologies-de-lia-et-de-realite-virtuelle-sont-en-train-de-revolutionner-les-modes-denseignement-expert/"> AI and Virtual Reality Technologies are Revolutionizing Teaching Methods</li>
              <li><i class="bi bi-check-circle"></i> <a href="https://www.leconomiste.com/flash-infos/innovation-l-emsi-primee-aux-etats-unis"> Innovation: EMSI Awarded in the United States</li>
              <li><i class="bi bi-check-circle"></i> <a href="https://telquel.ma/2021/12/09/signature-dune-convention-de-partenariat-entre-axa-services-maroc-et-lecole-marocaine-des-sciences-de-lingenieur-emsi_1746649"> Signing of a partnership agreement between AXA Services Morocco and the Moroccan School of Engineering Sciences (EMSI)</li>
              <li><i class="bi bi-check-circle"></i> <a href="https://www.leconomiste.com/flash-infos/l-emsi-s-illustre-au-canada?fbclid=IwAR2A6JPErM6XV4lZlkAcd6JXBsDaJXl1dsvAs1dvmsBwKMjYbLZZ8IdLj-A"> EMSI Shines in Canada</li>
              <li><i class="bi bi-check-circle"></i> <a href="https://fr.hibapress.com/news-48660.html"> Singapore: Thanks to EMSI, Morocco Excels with Three Medals</li>
              <li><i class="bi bi-check-circle"></i> <a href="https://www.leconomiste.com/flash-infos/l-emsi-brille-la-silicon-valley"> EMSI Shines in Silicon Valley </li>

            </ul>
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

    <!-- ======= Nos Sponsors Section ======= -->
<!-- ======= Nos Sponsors Section ======= -->

<!-- ======= Nos Sponsors Section ======= -->
<section id="nos-sponsors" class="nos-sponsors">
  <div class="container" data-aos="fade-up">
    <!-- Replace the following content with your sponsor logos -->
    <br><br>
    <div class="section-title">
          <h2>Our Sponsors</h2>
          <p>Popular Sponsors</p>
        </div>
    <div class="row d-flex align-items-center">
      <div class="col-lg-3">
        <img src="https://www.ibm.com/brand/experience-guides/developer/8f4e3cc2b5d52354a6d43c8edba1e3c9/02_8-bar-reverse.svg" alt="Sponsor Logo 1" class="img-fluid sponsor-logo">
      </div>
      <div class="col-lg-3">
        <img src="https://logowik.com/content/uploads/images/royal-air-maroc5848.jpg" alt="Sponsor Logo 4" class="img-fluid sponsor-logo">
      </div>
      <div class="col-lg-3">
        <img src="https://africabusinesscommunities.com/Images/Key%20Logos/Maroc%20Telecom.jpg" alt="Sponsor Logo 2" class="img-fluid sponsor-logo">
      </div>
      <div class="col-lg-3">
        <img src="https://leseco.ma/wp-content/uploads/2020/01/5e1334d6c660f.png" alt="Sponsor Logo 3" class="img-fluid sponsor-logo">
      </div>
      <!-- Add more columns for additional sponsor logos as needed -->
    </div>
  </div>
</section><!-- End Nos Sponsors Section -->



    

    <!-- ======= Popular Courses Section ======= -->
    <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Courses</h2>
          <p>Popular Courses</p>
        </div>

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="assets/img/course-1.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Web Development</h4>
                  <p class="price"></p>
                </div>

                <h3><a href="https://www.coursera.org/specializations/web-design">Website Design</a></h3>
                <p>Learn to Design and Create Websites. Build a responsive and accessible web portfolio using HTML5, CSS3, and JavaScript</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="assets/img/trainers/trainer-18.jpg" class="img-fluid" alt="">
                    <span>Imad</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="bx bx-user"></i>&nbsp;110
                    &nbsp;&nbsp;
                    <i class="bx bx-heart"></i>&nbsp;77
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="course-item">
              <img src="assets/img/course-2.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Marketing</h4>
                  <p class="price"></p>
                </div>

                <h3><a href="https://www.coursera.org/programs/3iir-marrakech-centre-g4-1p99r/professional-certificates/google-digital-marketing-ecommerce?authProvider=emsi&collectionId=skill~marketing&source=search">Google Digital Marketing & E-commerce</a></h3>
                <p>Comprehend the financial statements of a company and understand the various transactions that take place in the stock market .</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="assets/img/trainers/gigi.PNG" class="img-fluid" alt="">
                    <span>Charchabil</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="bx bx-user"></i>&nbsp;88
                    &nbsp;&nbsp;
                    <i class="bx bx-heart"></i>&nbsp;42
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="course-item">
              <img src="assets/img/course-3.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Programming</h4>
                  <p class="price"></p>
                </div>

                <h3><a href="https://www.coursera.org/programs/3iir-marrakech-centre-g4-1p99r/learn/cs-fundamentals-1?authProvider=emsi&source=search">Object-Oriented Data Structures in C++</a></h3>
                <p>Data Structures and Algorithms in C++. Learn fundamentals of computer science while implementing efficient data structures in C++.</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="assets/img/trainers/trainer-123.jpg" class="img-fluid" alt="">
                    <span>Amine</span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="bx bx-user"></i>&nbsp;120
                    &nbsp;&nbsp;
                    <i class="bx bx-heart"></i>&nbsp;95
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

        </div>

      </div>
    </section><!-- End Popular Courses Section -->

    <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
    <div class="container" data-aos="fade-up">
      <div class="row" data-aos="zoom-in" data-aos-delay="100">
        <!-- Trainer 1 -->
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <img src="assets\img\trainers\trainer-18.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Issame Imad</h4>
                <span>Web Development</span>
                <p>
                Meet Imad, our esteemed web development instructor with a wealth of expertise. Imad guides students through the intricacies of web design, imparting skills in HTML5, CSS3, and JavaScript to help them build responsive and accessible web portfolios.
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/gigi.PNG" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Charchabil</h4>
                <span>Marketing</span>
                <p>
                Charchabil, our dynamic marketing instructor, brings a wealth of experience to the classroom. With a specialization in Google Digital Marketing & E-commerce, Charchabil empowers students to navigate the world of online marketing, providing insights into effective strategies and tactics.
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/trainer-123.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Agoumi Mohammed Amine</h4>
                <span>Programming</span>
                <p>
                Amine, our dedicated programming teacher, excels in teaching Object-Oriented Data Structures in C++. Students under Amine's guidance delve into the fundamentals of computer science, implementing efficient data structures in C++ to master the art of programming and problem-solving.
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Trainers Section -->

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
      Created by <a href="#">ISSAME IMAD & AGOUMI MOHAMMED AMINE</a>
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