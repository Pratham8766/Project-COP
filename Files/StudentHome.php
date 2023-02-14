<?php 
// session_start();
include("conn.php");
$enroll = $_SESSION['enrollid'];
// $conn = mysqli_connect('localhost', 'root', '', 'COP');
$sql = "SELECT * FROM `students` where enrollment = $enroll";
$student = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Project COP</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <!--<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->
  <!--<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png"/>-->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style1.css" rel="stylesheet">
  
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
      OneSignal.init({
        appId: "e70e36b4-d07d-4173-86c1-15a7a56ab053",
      });
    });
  </script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="StudentHome.php">Project COP<span>.</span></a></h1>

      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <!--<nav id="navbar" class="navbar order-last order-lg-0">-->
      <!--  <ul>-->
      <!--    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>-->
      <!--    <li><a class="nav-link scrollto" href="#about">About</a></li>-->
      <!--    <li><a class="nav-link scrollto" href="#services">Services</a></li>-->
      <!--    <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>-->
      <!--    <li><a class="nav-link scrollto" href="#team">Team</a></li>-->
      <!--    <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>-->
      <!--      <ul>-->
      <!--        <li><a href="#">Drop Down 1</a></li>-->
      <!--        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>-->
      <!--          <ul>-->
      <!--            <li><a href="#">Deep Drop Down 1</a></li>-->
      <!--            <li><a href="#">Deep Drop Down 2</a></li>-->
      <!--            <li><a href="#">Deep Drop Down 3</a></li>-->
      <!--            <li><a href="#">Deep Drop Down 4</a></li>-->
      <!--            <li><a href="#">Deep Drop Down 5</a></li>-->
      <!--          </ul>-->
      <!--        </li>-->
      <!--        <li><a href="#">Drop Down 2</a></li>-->
      <!--        <li><a href="#">Drop Down 3</a></li>-->
      <!--        <li><a href="#">Drop Down 4</a></li>-->
      <!--      </ul>-->
      <!--    </li>-->
      <!--    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>-->
      <!--  </ul>-->
      <!--  <i class="bi bi-list mobile-nav-toggle"></i>-->
      <!--</nav><!-- .navbar -->

      <div>
        <button type="button" class="get-started-btn" style="background-color: #343a40;" data-bs-toggle="dropdown" aria-expanded="false">
          Profile
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><button class="dropdown-item" type="button" onClick="window.location='profile_view_student.php';">View Profile</button></li>
          <li><button class="dropdown-item" type="button" onClick="window.location='profile_edit.php';">Edit Profile</button></li>
          <li><button class="dropdown-item" type="button" onClick="window.location='change_pass.php';">Change Password</button></li>
          <li><button class="dropdown-item" type="button" onClick="window.location='logout.php';">log out</button></li>
        </ul>
      </div>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
          <h1>Welcome <span> <?php echo strtoupper($student['first name']); ?> </span></h1>
          <h3 style="color:aliceblue;"> <?php echo $student['enrollment']; ?></h3>
        </div>
      </div>

      <div class="row gy-4 mt-5 justify-content-center" id="ss" data-aos="zoom-in" data-aos-delay="250">
        <a href="Timetable/studentview.php">
          <div class="col-xl-2 col-md-4">
            <div class="icon-box">
              <img src="assets/img/timetable.png" style="height: 50px;">
              <h3 style="color: white;">SHOW SCHEDULE</h3>
            </div>
        </a>
      </div>

      <div class="col-xl-2 col-md-4">
        <a href="register courses/register.php">
          <div class="icon-box">
            <img src="assets/img/notes.png" style="height: 50px; width: 50px;">
            <h3 style="color: white;">Register Course</h3>
          </div>
        </a>
      </div>

      <div class="col-xl-2 col-md-4">
        <a href="/attendance/attendance_student_view.php">
          <div class="icon-box">
            <img src="assets/img/attendance.png" style="height: 60px;">
            <h3 style="color: white;">Show Attendance</h3>
          </div>
        </a>
      </div>

      <div class="col-xl-2 col-md-4">
        <a href="result/result_student_view.php">
          <div class="icon-box">
            <img src="assets/img/result.png" style="height: 50px;">
            <h3 style="color: white;">Result</h3>
          </div>
        </a>
      </div>

      <div class="col-xl-2 col-md-4">
        <a href="download_notice.php">
          <div class="icon-box">
            <img src="assets/img/notice.png" style="height: 60px;">
            <h3 style="color: white;">Notices
            </h3>
          </div>
        </a>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <?php
    $course_reg = mysqli_fetch_assoc(mysqli_query($conn, "select * from course_reg where enroll=$enroll"));
    foreach ($course_reg as $key => $value) {
      if ($key == 'enroll' || $value==null)
        continue;
      $course[$key]['id'] = $value;
      $temp = mysqli_fetch_assoc(mysqli_query($conn, "select course_name from `courses` where `course_id`='$value'"));
      $course[$key]['name'] = $temp['course_name'];
      $temp = mysqli_fetch_assoc(mysqli_query($conn, "select `first name`,`last name` from teachers where teacher_id=(select teacher_id from courses where course_id='$value')"));
      $course[$key]['teacher'] = $temp['first name'] . ' ' . $temp['last name'];
    }
    ?>
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Classroom</h2>
          <p>Classes Registered</p>
        </div>

        <div class="row">
          <?php
              if(isset($course))
              {
                  foreach ($course as $key => $value) {
                    echo '<div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                      <a href="Subject.php?id=' . $value['id'] . '">
                        <div class="icon-box">
                          <div class="icon"><i class="bx bxl-dribbble"></i></div>
                          <h4 style="color: black;">';
                            echo strtoupper($value['name']);
                        echo '</h4>
                            <p style="color: black"><b>Course Code: </b>' . strtoupper($value['id']) . '<br><b>  Teacher: </b>' . $value['teacher'] . '</p>
                          </div>
                      </a>
                    </div>';
                }
              }
               else
                    echo '<h4>No courses registered so far! Register courses from <a href="register courses/register.php" >here</a></h4>';
          ?>

          <!-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Magni Dolores</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4><a href="">Nemo Enim</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-slideshow"></i></div>
              <h4><a href="">Dele cardo</a></h4>
              <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-arch"></i></div>
              <h4><a href="">Divera don</a></h4>
              <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div> -->

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->


    <!-- </div> -->
    <!-- </section>End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Project COP<span>.</span></h3>
              <p>
                Near Mangalwari Bazar, Sadar,  <br>
                Nagpur, Maharashtra 440001<br><br>
                <strong>Phone:</strong> 0712 256 4483<br>
                <strong>Email:</strong> teamshadow237@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <!--<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>-->
                <a href="https://www.facebook.com/Government-Polytechnic-Nagpur-207890479681172" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/gp_nagpur_official/" class="instagram"><i class="bx bxl-instagram"></i></a>
                <!--<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>-->
                <!--<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>-->
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <!--<h4>Our Services</h4>-->
            <!--<ul>-->
            <!--  <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>-->
            <!--  <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>-->
            <!--  <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>-->
            <!--  <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>-->
            <!--  <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>-->
            <!--</ul>-->
          </div>

          <!--<div class="col-lg-4 col-md-6 footer-newsletter">-->
          <!--  <h4>Our Newsletter</h4>-->
          <!--  <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>-->
          <!--  <form action="" method="post">-->
          <!--    <input type="email" name="email"><input type="submit" value="Subscribe">-->
          <!--  </form>-->

          <!--</div>-->

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Project COP</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="">Team Shadow</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<script>
    OneSignal.push(function() {
      /* These examples are all valid */
      var isPushSupported = OneSignal.isPushNotificationsSupported();
      if (isPushSupported) {
        // Push notifications are supported
        console.log('supported');
        OneSignal.isPushNotificationsEnabled(function(isEnabled) {
          if (isEnabled) {
            console.log("Push notifications are enabled!");
          } else {
            console.log("Push notifications are not enabled yet.");
            OneSignal.push(function() {
              OneSignal.showHttpPrompt();
            });
          }
        });
      } else {
        // Push notifications are not supported
        console.log('not supported');
      }
    });
  </script>
