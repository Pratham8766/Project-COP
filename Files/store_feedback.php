<?php
// connect to the database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "cop";
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// session_start();
include "conn.php";
$enroll = $_SESSION['enrollid'];
$_SESSION['course'] = $_GET['id'];
$course_id = $_GET['id'];
// $_SESSION['course'] = 'am301e';
// $course_id = 'am301e';

$course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `courses` WHERE `course_id`='$course_id'"));
$teacher_id = $course['teacher_id'];
$teacher = mysqli_fetch_assoc(mysqli_query($conn, "SELECT *  FROM `teachers` WHERE teacher_id='$teacher_id'"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseid = $_SESSION['course'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $q5 = $_POST['q5'];
    $q6 = $_POST['q6'];
    $q7 = $_POST['q7'];
    $q8 = $_POST['q8'];
    $q9 = $_POST['q9'];
    $comments = $_POST['comments'];
    $sql4 = "select teacher_id from courses where course_id = '$courseid'";
    $res4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($res4);
    $teach_id = $row4['teacher_id'];
    $query = mysqli_query($conn, "INSERT INTO `feedback` (`id`, `course_id`,`teacher_id`,`q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`,`q9`, `suggestions`) VALUES (NULL, '$courseid','$teach_id', $q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,'$comments')");

    if ($query) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Feedback Submitted</strong> 
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Unkonwn error occured!!</strong> 
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Feedback</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Elegant Feedback Form  Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //custom-theme -->

    <style>
        .breadcrumbs {
            padding: 10px;
            font-family: 'Roboto', sans-serif;

        }

        .breadcrumbs__item {
            display: inline-block;
            margin-top: 20px;
        }

        .breadcrumbs__item:not(:last-of-type)::after {
            content: '\203a';
            margin: 0 5px;
            color: #ffc451;
        }

        .breadcrumbs__link {
            text-decoration: none;
            color: grey;
        }

        .breadcrumbs__link:hover {
            /* text-decoration: underline; */
            color: white;
        }

        .breadcrumbs__link--active {
            color: #ffc451;
            font-weight: 500;
        }

        #color {
            color: white;
        }

        .agileits_w3layouts {
            background-image: url("../assets/img/tempbg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
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

        .wrap {
            padding: 2.3em;
            width: 50%;
            margin: 2em auto;
            background: rgba(1, 14, 21, 0.62);
        }

        .w3layouts_main h3 {
            font-size: 1em;
            color: #e6cfcf;
            line-height: 1.5;
        }

        h2 {
            color: #ffc451;
            font-size: large;
            margin-top: 30px;
        }
        
      .get-started-btn {
            color: #fff;
            border-radius: 4px;
            padding: 7px 25px 8px 25px;
            white-space: nowrap;
            transition: 0.3s;
            background-color: #343a40;
            font-size: 14px;
            display: inline-block;
            border: 2px solid #ffc451;
        }

        .get-started-btn:hover {
            background: #ffbb38;
            color: #343a40;
            /* color: #fff; */
        }
        textarea{
	        font-family: 'Montserrat', sans-serif;
	        margin:0;
        }
        .agile_form textarea {
        	font-size: 0.85em;
            color: #fff;
            padding: 0.8em 1em;
            margin-bottom: 1em;
            width: 94.5%;
            outline: none;
            resize: none;
            height: 7em;
            border: 1px solid #696867;
        	border-radius: 5px;
           background: rgba(16, 16, 16, 0.47);
        	letter-spacing: 1px;
        }
        .textarea.w3l_summary {
        	 min-height: 4em;
        	 background: rgba(25, 5, 20, 0.48);
        	 font-size: 0.85em;
        }
        
    </style>
        <link href="feedbackstyle.css" rel="stylesheet" type="text/css" media="all" /> 
        <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
</head>

<body class="agileits_w3layouts" style="background-color: black;">
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="../StudentHome.php" class="breadcrumbs__link">Home</a>
        </li>

        <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Feedback Form</a>
        </li>
    </ul>
    <h1 class="agile_head text-center">Feedback Form</h1>
    <div class="container">
        <div class="w3layouts_main wrap">
            <span style="font-size: 20px; color:#ffc451">Course Code: </span>
            <span style="color: #e6cfcf; font-size: 20px"><?php echo $course_id; ?></span>
            <br>
            <span style="font-size: 20px; color:#ffc451">Course Name: </span>
            <span style="color: #e6cfcf; font-size: 20px"><?php echo ' ' . $course['course_name']; ?></span>
            <br>
            <span style="font-size: 20px; color:#ffc451">Course Teacher: </span>
            <span style="color: #e6cfcf; font-size: 20px"><?php echo $teacher['first name'] . ' ' . $teacher['middle name'] . ' ' . $teacher['last name']; ?></span>
            <br>
            <p style = "font-size:15px; color: #e6cfcf;">Please help us to serve you better by taking a couple of minutes. </h3>
            <form action="store_feedback.php" method="post" class="agile_form">
                <h2>1. Domain(course related )Knowledge</h2>
                <div style="color: grey;">
                    <div class="form-check">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <input class="form-check-input" type="radio" name="q1" value="4" id="flexRadioDefault1" required>
                            Excellent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" value="3" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Good
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" value="2" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Fair
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" value="1" id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault4">
                            Poor
                        </label>
                    </div>
                </div>
                <h2>2. Presentation skill and interaction with students</h2>
                <div style="color: grey;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" value="4" id="flexRadioDefault5" required>
                        <label class="form-check-label" for="flexRadioDefault5">
                            Excellent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" value="3" id="flexRadioDefault6">
                        <label class="form-check-label" for="flexRadioDefault6">
                            Good
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" value="2" id="flexRadioDefault7">
                        <label class="form-check-label" for="flexRadioDefault7">
                            Fair
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" value="1" id="flexRadioDefault8">
                        <label class="form-check-label" for="flexRadioDefault8">
                            Poor
                        </label>
                    </div>
                </div>
                <h2>3. Use of audio visual aids</h2>
                <div style="color: grey;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" value="4" id="flexRadioDefault9" required>
                        <label class="form-check-label" for="flexRadioDefault9">
                            Excellent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" value="3" id="flexRadioDefault10">
                        <label class="form-check-label" for="flexRadioDefault10">
                            Good
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" value="2" id="flexRadioDefault11">
                        <label class="form-check-label" for="flexRadioDefault11">
                            Fair
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" value="1" id="flexRadioDefault12">
                        <label class="form-check-label" for="flexRadioDefault12">
                            Poor
                        </label>
                    </div>
                </div>
                <h2>4. Punctuality and discipline</h2>
                <div style="color: grey;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" value="4" id="flexRadioDefault13" required>
                        <label class="form-check-label" for="flexRadioDefault13">
                            Excellent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" value="3" id="flexRadioDefault14">
                        <label class="form-check-label" for="flexRadioDefault14">
                            Good
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" value="2" id="flexRadioDefault15">
                        <label class="form-check-label" for="flexRadioDefault15">
                            Fair
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" value="1" id="flexRadioDefault16">
                        <label class="form-check-label" for="flexRadioDefault16">
                            Poor
                        </label>
                    </div>
                </div>
                <h2>5. Continuous assessment of assignment and laboratory work</h2>
                <div style="color: grey;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" value="4" id="flexRadioDefault17" required>
                        <label class="form-check-label" for="flexRadioDefault17">
                            Excellent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" value="3" id="flexRadioDefault18">
                        <label class="form-check-label" for="flexRadioDefault18">
                            Good
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" value="2" id="flexRadioDefault19">
                        <label class="form-check-label" for="flexRadioDefault19">
                            Fair
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" value="1" id="flexRadioDefault20">
                        <label class="form-check-label" for="flexRadioDefault20">
                            Poor
                        </label>
                    </div>
                </div>
                <h2>6. Ability to resolve difficulties </h2>
                <div style="color: grey;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q6" value="4" id="flexRadioDefault21" required>
                        <label class="form-check-label" for="flexRadioDefault21">
                            Excellent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q6" value="3" id="flexRadioDefault22">
                        <label class="form-check-label" for="flexRadioDefault22">
                            Good
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q6" value="2" id="flexRadioDefault23">
                        <label class="form-check-label" for="flexRadioDefault23">
                            Fair
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q6" value="1" id="flexRadioDefault24">
                        <label class="form-check-label" for="flexRadioDefault24">
                            Poor
                        </label>
                    </div>
                </div>
                <h2>7. Ability to use day to day examples,new ideas and concept for lifelong learning </h2>
                <div style="color: grey;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q7" value="4" id="flexRadioDefault25" required>
                        <label class="form-check-label" for="flexRadioDefault25">
                            Excellent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q7" value="3" id="flexRadioDefault26">
                        <label class="form-check-label" for="flexRadioDefault26">
                            Good
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q7" value="2" id="flexRadioDefault27">
                        <label class="form-check-label" for="flexRadioDefault27">
                            Fair
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q7" value="1" id="flexRadioDefault28">
                        <label class="form-check-label" for="flexRadioDefault28">
                            Poor
                        </label>
                    </div>
                    <h2>8. Ability of learning teaching process adopted by faculty to attain Cognitive Domain(Theory) Course Outcomes(COs)at excellent level </h2>
                    <div style="color: grey;">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q8" value="4" id="flexRadioDefault29" required>
                            <label class="form-check-label" for="flexRadioDefault29">
                                Excellent
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q8" value="3" id="flexRadioDefault30">
                            <label class="form-check-label" for="flexRadioDefault30">
                                Good
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q8" value="2" id="flexRadioDefault31">
                            <label class="form-check-label" for="flexRadioDefault31">
                                Fair
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q8" value="1" id="flexRadioDefault32">
                            <label class="form-check-label" for="flexRadioDefault32">
                                Poor
                            </label>
                        </div>
                        <h2>9. Ability of learning teaching process adopted by faculty to attain psychomotor domain(Practical) Course Outcomes(COs)at excellent level</h2>
                        <div style="color: grey;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q9" value="4" id="flexRadioDefault33" required>
                                <label class="form-check-label" for="flexRadioDefault33">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q9" value="3" id="flexRadioDefault34">
                                <label class="form-check-label" for="flexRadioDefault34">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q9" value="2" id="flexRadioDefault35">
                                <label class="form-check-label" for="flexRadioDefault35">
                                    Fair
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q9" value="1" id="flexRadioDefault35">
                                <label class="form-check-label" for="flexRadioDefault35">
                                    Poor
                                </label>
                            </div>
                        </div>

                         <h2>If you have specific feedback, please write to us...</h2>
                       <textarea placeholder="Additional comments (Optional)" class="w3l_summary" name="comments"></textarea>
                                <br>
                                <br>
                        <center><button type="submit" class="get-started-btn" style="background-color: #343a40;">Submit Feedback</button></center>
            </form>
        </div>
    </div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>