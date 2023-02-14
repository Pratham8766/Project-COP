<?php
// session_start();
include("../conn.php");
$enroll = $_SESSION['enrollid'];
// $enroll = 5678;
include("../notification.php");
$sql1 = "select course_id, course_name from courses where teacher_id = $enroll";
$res1 = mysqli_query($conn, $sql1);
if (isset($_POST['submit'])) {
    $course = $_SESSION['course'];
    $id = $_POST['check'];
    foreach ($id as $key => $value) {
        $sql3 = "UPDATE `results` SET attendance=((SELECT attendance FROM `results` WHERE enrollment=$key and course_name='$course')+1) WHERE enrollment=$key and course_name='$course'";
        $res3 = mysqli_query($conn, $sql3);
    }
    $sql4 = "UPDATE courses SET classes =((SELECT classes FROM courses WHERE course_id='$course')+1) WHERE course_id='$course'";
    $res4 = mysqli_query($conn, $sql4);
    echo '<div class="alert alert-success" role="alert">
            attendance taken
            </div>';
    $response = sendMessage();
    $return["allresponses"] = $response;
    $return = json_encode($return);
    $data = json_decode($response, true);
    $id = $data['id'];
}
?>

<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        .wrap {
            padding: 2.3em;
            width: 50%;
            margin: 2em auto;
            background: rgba(1, 14, 21, 0.62);
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
        
        .w3layouts_main h3 {
            font-size: 1em;
            color: #e6cfcf;
            line-height: 1.5;
        }

        .get-started-btn {
            color: #fff;
            background-color: #343a40;
            border-radius: 4px;
            padding: 7px 25px 8px 25px;
            white-space: nowrap;
            transition: 0.3s;
            font-size: 14px;
            display: inline-block;
            border: 2px solid #ffc451;
        }

        #select {
            float: left;
            width: 80%;
        }

        #button {
            float: right;
        }

        .get-started-btn:hover {
            background: #ffbb38;
            color: #343a40;
        }

        @media (max-width: 992px) {
            .get-started-btn {
                padding: 7px 20px 8px 20px;
                margin-right: 15px;
            }
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>COP-Attendance</title>
</head>

<body class="agileits_w3layouts" style="background-color: black;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- <h1>Hello, world!</h1> -->
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="../TeacherHome.php" class="breadcrumbs__link">Home</a>
        </li>

        <li class="breadcrumbs__item">
            <a href="take_attendance.php" class="breadcrumbs__link breadcrumbs__link--active">Take Attendance</a>
        </li>
    </ul>
    <h1 class="agile_head" style="text-align: center;">Attendance</h1>

    <div class="w3layouts_main wrap" style="padding-bottom: 80px;">
        <form class="form-inline" action="take_attendance.php" method="POST">
                <select onchange="if(this.value != 0) { this.form.submit(); }" name="course" class="form-select">
                    <option selected>Select Course</option>
                    <?php
                    if ($res1) {
                        while ($row1 = mysqli_fetch_assoc($res1)) {
                            echo '<option  value="' . $row1["course_id"] . '">' . $row1["course_id"] . '-' . $row1["course_name"] . '</option>';
                        }
                    }
                    ?>
                </select>

            <!-- <div id="button">
                <button name="submit course" value="submit" class="get-started-btn scrollto">View Profile</button>
            </div> -->
        </form>
        <form action="take_attendance.php" method="post">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['course'])) {
                    $course = $_POST['course'];
                    $_SESSION['course'] = $course;
                    $sql2 = "select * from course_reg where course1='$course' OR course2='$course' OR course3='$course' OR course4='$course' OR course5='$course' OR course6='$course' OR course7='$course'";
                    $res2 = mysqli_query($conn, $sql2);
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        echo '<label style="margin-top: 10px; font-size: 20px; color: #ffc451"> <input type="checkbox"  class="form-check-input me-1"  name = "check[' . $row2['enroll'] . ']" value="1">' . $row2['enroll'] . '</label><br>';
                    }
                    echo '<center><button name="submit" style="margin-top: 10px" value="attendance" class="get-started-btn scrollto">Submit</button>';
                }
            }
            ?>
        </form>
    </div>
</body>

</html>