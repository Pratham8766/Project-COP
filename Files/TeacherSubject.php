<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // session_start();
    include "conn.php";
    $enroll = $_SESSION['enrollid'];
    $course = $_GET['id'];
    $course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `courses` where course_id='$course'"));
}
?>

<!-- notice download -->


<!-- anoncement -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $course['course_name'] ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <style>
        .wrap {
            padding: 2.3em;
            width: 80%;
            margin: 2em auto;
            background: rgba(1, 14, 21, 0.62);
        }

        h1.agile_head {
            padding-top: 1em;
            font-size: 2.5em;
            text-transform: uppercase;
            color: #fff;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 6px;
            line-height: 1.5;
        }

        #myTable,#myTable1, #myTable2,#myTable3{
            width: device-width;
            padding-top: 10px;
        }

        /* {*/
        /*                width: device-width;*/

        /*    padding-top: 10px;*/
        /*}*/

        /*{*/
        /*    padding-top: 10px;*/
        /*}*/

        /* {*/
        /*    padding-top: 10px;*/
        /*}*/
    </style>
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

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-lg-between">

            <h1 class="logo me-auto me-lg-0"><a href="TeacherHome.php">Project COP<span>.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#curricullum">Curricullum</a></li>
                    <li><a class="nav-link scrollto" href="#attendance">Attendance</a></li>
                    <li><a class="nav-link scrollto" href="#announcements">Announcements</a></li>
                    <li><a class="nav-link scrollto " href="#notes">Notes</a></li>
                    <li><a class="nav-link scrollto" href="#team">Result</a></li>
                    <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li> -->
                    <!-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li> -->
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->


        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center justify-content-center">
        <div class="container" data-aos="fade-up">
            <h1 class="agile_head text-center"><?php echo strtoupper($course['course_name']); ?></h1>
            <div class="wrap" style="font-size: extralarge; text-align:left;">
                <?php
                foreach ($course as $key => $value) {
                    if ($key == 'teacher_id') {
                        $key = 'Teacher Name';
                        $value = mysqli_fetch_row(mysqli_query($conn, "SELECT `first name`,`last name` from `teachers` where teacher_id='$value'"));
                        $value = $value[0] . ' ' . $value[1];
                    }
                    if ($key == 'course_id')
                        $key = "course code";
                    if ($key == 'course_name')
                        $key = "course name";
                    if ($key == 'classes')
                        $key = 'total no. of classes held';
                    if ($key == 'lecture') {
                        $key = "Type of Lecture";
                        if ($value == 11)
                            $value = "Theory and Practical";
                        if ($value == 1)
                            $value = "Practical";
                        if ($value == 10)
                            $value = "Theory";
                    }
                    echo '<span style="font-size: large; text-align:left; color: #ffc451">' . strtoupper($key) . '</span> : <span style="font-size: large; text-align:left; color: white">' . strtoupper($value) . '</span><br><br>';
                }
                ?>
            </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="curricullum" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2><?php echo strtoupper($course['course_id']); ?></h2>
                    <p>CURRICULLUM</p>
                </div>
                <center>
                    <div class="row" style="width: 720px; height: 1000px;">
                        <?php
                        $id = strtoupper($course['course_id']) . ".pdf";
                        echo '<div id="adobe-dc-view"></div>
                                <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
                                <script type="text/javascript">
                                  document.addEventListener("adobe_dc_view_sdk.ready", function(){
                                    var adobeDCView = new AdobeDC.View({clientId: "ce0a0727edda41a2afad7c6c99106409", divId: "adobe-dc-view"});
                                    adobeDCView.previewFile({
                                      content:{ location: 
                                        { url: "/Curriculums/'.$id.'"}},
                                      metaData:{fileName: "'.$id.'"}
                                    },
                                    {
                                      embedMode: "SIZED_CONTAINER"
                                    });
                                  });
                                </script>'; ?>
                    </div>
                </center>
            </div>
        </section><!-- End About Section -->
        
        <!-- ======= Clients Section ======= -->
        <section id="attendance" class="clients">
            <div class="container" data-aos="zoom-in">
                
                <div class="section-title">
                    <h2><?php echo strtoupper($course['course_name']); ?></h2>
                    <p>Attendance of the Class</p>
                </div>
                <div class="row">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
                    {
                        $subject = $_GET['id'];
                        $attendance[]=null;
                        $result = mysqli_query($conn, "SELECT `enrollment`,`attendance` from results where course_name='$subject'");
                        while ($students = mysqli_fetch_assoc($result)) 
                        {
                            $attendance[] = $students;
                        }
                        $classes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `classes` from courses where course_id='$subject'"));
                        $classes = $classes['classes'];
                        echo '<table style="width: device-width"class="table table-bordered table-dark table-hover" id="myTable3">
                                <thead style="color: #ffc451">
                                    <th style="text-align:center">Enrollment</th>
                                    <th style="text-align:center">Attendance</th>
                                    <th style="text-align:center">Percentage</th>
                                </thead>';
                                if($classes!=0)
                                {
                                    for ($i = 1; $i < count($attendance); $i++) 
                                    {
                                        echo '<tr>
                                            <td style="text-align:center">' .  $attendance[$i]['enrollment'] . '</td>';
                                                echo '<td style="text-align:center; color:grey"><a style="color: white">' .  $attendance[$i]['attendance'] . '<a>/' . $classes . '</td>';
                                                    $percent = $attendance[$i]['attendance'] / $classes;
                                                    $percent = $percent * 100;
                                                    if ($percent >= 85)
                                                        echo '<td style="text-align:center; color: lightgreen;">' .  $percent . '</td>';
                                                    elseif ($percent >= 75)
                                                        echo '<td style="text-align:center; color : yellow">' .  $percent . '</td>';
                                                    else {
                                                        echo '<td style="text-align:center; color: red">' .  $percent . '</td>';
                                                        $detian[] = array($attendance[$i]['enrollment'] => $percent);
                                                    }
                                                echo '</tr>';
                                    }
                                    echo ' </table>';
                                    echo '<form action="detainstudents.php" method="POST">
                                            <input type="hidden" name="course" value="' . $subject . '">
                                            <input type="hidden" name="detain" value="' . htmlentities(serialize($detian)) . '">
                                            <center><button class="get-started-btn scrollto" name="detention">Create Detention</button></center>
                                        </form>';
                                }
                                else echo'</table>';
                    }
                    ?>
                </div>
            </div>
        </section><!-- End Clients Section -->

        <!-- ======= Features Section ======= -->
        <!--<section id="features" class="features">-->
        <!--    <div class="container" data-aos="fade-up">-->

        <!--        <div class="row">-->
        <!--            <div class="image col-lg-6" style='background-image: url("assets/img/features.jpg");' data-aos="fade-right"></div>-->
        <!--            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">-->
        <!--                <div class="icon-box mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="150">-->
        <!--                    <i class="bx bx-receipt"></i>-->
        <!--                    <h4>Est labore ad</h4>-->
        <!--                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>-->
        <!--                </div>-->
        <!--                <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">-->
        <!--                    <i class="bx bx-cube-alt"></i>-->
        <!--                    <h4>Harum esse qui</h4>-->
        <!--                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>-->
        <!--                </div>-->
        <!--                <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">-->
        <!--                    <i class="bx bx-images"></i>-->
        <!--                    <h4>Aut occaecati</h4>-->
        <!--                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>-->
        <!--                </div>-->
        <!--                <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">-->
        <!--                    <i class="bx bx-shield"></i>-->
        <!--                    <h4>Beatae veritatis</h4>-->
        <!--                    <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->

        <!--    </div>-->
        <!--</section><!-- End Features Section -->

        <!-- ======= Services Section ======= -->
        <section id="announcements" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2><?php echo strtoupper($course['course_name']); ?></h2>
                    <p>Announcements</p>
                </div>

                <div class="row">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "GET") {
                        // $course = $_GET['id'];
                        $srno = 1;
                        echo '<div class = "container mb-3" style="width: device-width">
                                <table class="table table-bordered table-dark table-hover" id="myTable1">
                                    <thead  style="color: #ffc451">
                                        <th width=50px>Sr No.</th>
                                        <th>Uploaded at</th>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Due Date</th>
                                        <th>Attachment</th>
                                    </thead>
                                    <tbody>';
                        $sql = "SELECT * FROM `announcements` ORDER BY time DESC";
                        $result = mysqli_query($conn, $sql);
                        $file1s = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($file1s as $file1) :
                            if ($file1['subject'] == $course['course_id']) {
                                echo '<tr>';
                                echo '<td>' . $srno . '</td>';
                                echo '<td>' . $file1["time"] . '</td>';
                                echo '<td>' . $file1["title"] . '</td>';
                                echo '<td>' . $file1["body"] . '</td>';
                                echo '<td>' . $file1["due_date"] . '</td>';
                                echo '<td><a href="annoncements/annoncement_download.php?file_id1=' . $file1["id"] . '">' . $file1['name'] . '</a></td>
                                            </tr>';
                                $srno++;
                            }
                        endforeach;
                        echo '</tbody>
                                </table>
                        </div>';
                    }
                    ?>
                    <center><button class="get-started-btn scrollto" type="submit" onClick="window.location='annoncements/upload.php';">Make Annoncement</button></center>

                </div>
        </section><!-- End Services Section -->

        <!-- ======= Cta Section ======= -->
        <!--<section id="cta" class="cta">-->
        <!--    <div class="container" data-aos="zoom-in">-->

        <!--        <div class="text-center">-->
        <!--            <h3>Call To Action</h3>-->
        <!--            <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>-->
        <!--            <a class="cta-btn" href="#">Call To Action</a>-->
        <!--        </div>-->

        <!--    </div>-->
        <!--</section><!-- End Cta Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="notes" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Notes</h2>
                    <p>Notes to Download</p>
                </div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    // $course = $_GET['id'];
                    echo '<div class = "container mb-3"style="width: device-width">
                                <table class="table table-bordered table-dark" id="myTable">
                                    <thead style="color: #ffc451">
                                        <th width=50px>Sr No.</th>
                                        <th>Uploaded on</th>
                                        <th>Filename</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>';
                    $srno = 1;
                    $sql = "SELECT * FROM notes order by `upload_date` desc";
                    $result = mysqli_query($conn, $sql);
                    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($files as $file) :
                        if ($file['course_id'] == $course['course_id']) {
                            echo '<tr>';
                            echo '<td>' . $srno . '</td>';
                            echo '<td>' . $file["upload_date"] . '</td>';
                            echo '<td>' . $file["name"] . '</td>';
                            echo '<td>' . $file["unit"] . '</td>';
                            echo '<td><a href="notes/downloadnotes.php?file_id=' . $file["id"] . '">Download</a></td></tr>';
                            $srno++;
                        }
                    endforeach;
                    echo '</tbody>
                                </table>
                        </div>';
                }
                ?>
                <?php echo $_GET['id']; $_SESSION['c']=$_GET['id'];?>
                <center><button class="get-started-btn scrollto" type="submit" onClick="window.location='notes/notes_upload.php';">Upload Notes</button></center>
            </div>

        </section><!-- End Portfolio Section -->

        <!-- ======= Counts Section ======= -->
        <!--<section id="counts" class="counts">-->
        <!--    <div class="container" data-aos="fade-up">-->

        <!--        <div class="row no-gutters">-->
        <!--            <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" data-aos-delay="100"></div>-->
        <!--            <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch" data-aos="fade-left" data-aos-delay="100">-->
        <!--                <div class="content d-flex flex-column justify-content-center">-->
        <!--                    <h3>Voluptatem dignissimos provident quasi</h3>-->
        <!--                    <p>-->
        <!--                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit-->
        <!--                    </p>-->
        <!--                    <div class="row">-->
        <!--                        <div class="col-md-6 d-md-flex align-items-md-stretch">-->
        <!--                            <div class="count-box">-->
        <!--                                <i class="bi bi-emoji-smile"></i>-->
        <!--                                <span data-purecounter-start="0" data-purecounter-end="65" data-purecounter-duration="2" class="purecounter"></span>-->
        <!--                                <p><strong>Happy Clients</strong> consequuntur voluptas nostrum aliquid ipsam architecto ut.</p>-->
        <!--                            </div>-->
        <!--                        </div>-->

        <!--                        <div class="col-md-6 d-md-flex align-items-md-stretch">-->
        <!--                            <div class="count-box">-->
        <!--                                <i class="bi bi-journal-richtext"></i>-->
        <!--                                <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="2" class="purecounter"></span>-->
        <!--                                <p><strong>Projects</strong> adipisci atque cum quia aspernatur totam laudantium et quia dere tan</p>-->
        <!--                            </div>-->
        <!--                        </div>-->

        <!--                        <div class="col-md-6 d-md-flex align-items-md-stretch">-->
        <!--                            <div class="count-box">-->
        <!--                                <i class="bi bi-clock"></i>-->
        <!--                                <span data-purecounter-start="0" data-purecounter-end="35" data-purecounter-duration="4" class="purecounter"></span>-->
        <!--                                <p><strong>Years of experience</strong> aut commodi quaerat modi aliquam nam ducimus aut voluptate non vel</p>-->
        <!--                            </div>-->
        <!--                        </div>-->

        <!--                        <div class="col-md-6 d-md-flex align-items-md-stretch">-->
        <!--                            <div class="count-box">-->
        <!--                                <i class="bi bi-award"></i>-->
        <!--                                <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="4" class="purecounter"></span>-->
        <!--                                <p><strong>Awards</strong> rerum asperiores dolor alias quo reprehenderit eum et nemo pad der</p>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div><!-- End .content-->
        <!--            </div>-->
        <!--        </div>-->

        <!--    </div>-->
        <!--</section><!-- End Counts Section -->

        <!-- ======= Testimonials Section ======= -->
        <!--<section id="testimonials" class="testimonials">-->
        <!--    <div class="container" data-aos="zoom-in">-->

        <!--        <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">-->
        <!--            <div class="swiper-wrapper">-->

        <!--                <div class="swiper-slide">-->
        <!--                    <div class="testimonial-item">-->
        <!--                        <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>Saul Goodman</h3>-->
        <!--                        <h4>Ceo &amp; Founder</h4>-->
        <!--                        <p>-->
        <!--                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
        <!--                            Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.-->
        <!--                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                    </div>-->
        <!--                </div><!-- End testimonial item -->-->

        <!--                <div class="swiper-slide">-->
        <!--                    <div class="testimonial-item">-->
        <!--                        <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>Sara Wilsson</h3>-->
        <!--                        <h4>Designer</h4>-->
        <!--                        <p>-->
        <!--                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
        <!--                            Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.-->
        <!--                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                    </div>-->
        <!--                </div><!-- End testimonial item -->

        <!--                <div class="swiper-slide">-->
        <!--                    <div class="testimonial-item">-->
        <!--                        <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>Jena Karlis</h3>-->
        <!--                        <h4>Store Owner</h4>-->
        <!--                        <p>-->
        <!--                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
        <!--                            Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.-->
        <!--                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                    </div>-->
        <!--                </div><!-- End testimonial item -->

        <!--                <div class="swiper-slide">-->
        <!--                    <div class="testimonial-item">-->
        <!--                        <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>Matt Brandon</h3>-->
        <!--                        <h4>Freelancer</h4>-->
        <!--                        <p>-->
        <!--                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
        <!--                            Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.-->
        <!--                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                    </div>-->
        <!--                </div><!-- End testimonial item -->

        <!--                <div class="swiper-slide">-->
        <!--                    <div class="testimonial-item">-->
        <!--                        <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">-->
        <!--                        <h3>John Larson</h3>-->
        <!--                        <h4>Entrepreneur</h4>-->
        <!--                        <p>-->
        <!--                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
        <!--                            Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.-->
        <!--                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
        <!--                        </p>-->
        <!--                    </div>-->
        <!--                </div><!-- End testimonial item -->
        <!--            </div>-->
        <!--            <div class="swiper-pagination"></div>-->
        <!--        </div>-->

        <!--    </div>-->
        <!--</section><!-- End Testimonials Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2><?php echo strtoupper($course['course_name']); ?></h2>
                    <p>Result of class</p>
                </div>

                <?php
                $sub = $course['course_id'];
                $sql = "SELECT * FROM results where course_name = '$sub'";
                $result = mysqli_query($conn, $sql);
                echo '<table class="table table-bordered table-dark" id="myTable2">
                              <thead style="color: #ffc451">
                                <th class="color">Enrollment</th>
                                <th class="color" style="text-align:center">Assignment</th>
                                <th class="color" style="text-align:center">Practical</th>
                                <th class="color" style="text-align:center">PT</th>
                                <th class="color" style="text-align:center">Final_Theory</th>
                                <th class="color" style="text-align:center">Result</th>
                            </thead>';
                while ($rows = $result->fetch_assoc()) {
                    $ass_avg = $rows['Assignment_1'] + $rows['Assignment_2'];
                    $ass_avg_avg = ceil($ass_avg / 2);
                    $prac_avg = $rows['Practical_1'] + $rows['Practical_2'] + $rows['Practical_3'];
                    $prac_avg_avg = ceil($prac_avg / 3);
                    $pt_avg = $rows['PT_1'] + $rows['PT_2'];
                    $pt_avg_avg = ceil($pt_avg / 2);
                    $final_theory = $rows['Final_Theory'];
                    $assaddition= $rows["Assignment_1"] + $rows["Assignment_2"];
                    $pracaddition = $rows["Practical_1"] + $rows["Practical_2"]+ $rows["Practical_3"];
                    $ptaddition =  $rows["PT_1"] + $rows["PT_2"];
                    echo '<tr>
                        <td style="color:white;">' .  $rows["enrollment"] . ' </td>
                        <td style="color:white; text-align:center">' . $assaddition . '</td>
                        <td style="color:white; text-align:center">' . $pracaddition . '</td>
                        <td style="color:white; text-align:center">' . $ptaddition . '</td>
                        <td style="color:white; text-align:center">' . $rows["Final_Theory"] . '</td>';

                    $a = $ass_avg_avg > 10 && $prac_avg_avg > 10 && $pt_avg_avg > 20 && $final_theory > 33;
                    if ($a) {
                        echo '<td style="color:white; text-align:center"> Pass </td>';
                    } else {
                        echo '<td style="color:white; text-align:center"> Fail  </td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
                ?>


            </div>
        </section><!-- End Team Section -->

        <!-- ======= Contact Section ======= -->
        <!--<section id="contact" class="contact">-->
        <!--    <div class="container" data-aos="fade-up">-->

        <!--        <div class="section-title">-->
        <!--            <h2>Contact</h2>-->
        <!--            <p>Contact Us</p>-->
        <!--        </div>-->

        <!--        <div>-->
        <!--            <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>-->
        <!--        </div>-->

        <!--        <div class="row mt-5">-->

        <!--            <div class="col-lg-4">-->
        <!--                <div class="info">-->
        <!--                    <div class="address">-->
        <!--                        <i class="bi bi-geo-alt"></i>-->
        <!--                        <h4>Location:</h4>-->
        <!--                        <p>A108 Adam Street, New York, NY 535022</p>-->
        <!--                    </div>-->

        <!--                    <div class="email">-->
        <!--                        <i class="bi bi-envelope"></i>-->
        <!--                        <h4>Email:</h4>-->
        <!--                        <p>info@example.com</p>-->
        <!--                    </div>-->

        <!--                    <div class="phone">-->
        <!--                        <i class="bi bi-phone"></i>-->
        <!--                        <h4>Call:</h4>-->
        <!--                        <p>+1 5589 55488 55s</p>-->
        <!--                    </div>-->

        <!--                </div>-->

        <!--            </div>-->

        <!--            <div class="col-lg-8 mt-5 mt-lg-0">-->

        <!--                <form action="forms/contact.php" method="post" role="form" class="php-email-form">-->
        <!--                    <div class="row">-->
        <!--                        <div class="col-md-6 form-group">-->
        <!--                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>-->
        <!--                        </div>-->
        <!--                        <div class="col-md-6 form-group mt-3 mt-md-0">-->
        <!--                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="form-group mt-3">-->
        <!--                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>-->
        <!--                    </div>-->
        <!--                    <div class="form-group mt-3">-->
        <!--                        <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>-->
        <!--                    </div>-->
        <!--                    <div class="my-3">-->
        <!--                        <div class="loading">Loading</div>-->
        <!--                        <div class="error-message"></div>-->
        <!--                        <div class="sent-message">Your message has been sent. Thank you!</div>-->
        <!--                    </div>-->
        <!--                    <div class="text-center"><button type="submit">Send Message</button></div>-->
        <!--                </form>-->

        <!--            </div>-->

        <!--        </div>-->

        <!--    </div>-->
        <!--</section><!-- End Contact Section -->

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
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
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

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable3').DataTable();
        });
    </script>

</body>

</html>