<?php
// session_start();
include "../conn.php";
$enroll = $_SESSION['enrollid'];
// $_SESSION['course'] = $_POST['course'];
// $course_id = $_POST['course'];
$result1 = mysqli_query($conn, "SELECT * FROM `courses` WHERE semester = 1");
$result2 = mysqli_query($conn, "SELECT * FROM `courses` WHERE semester = 2");
$result3 = mysqli_query($conn, "SELECT * FROM `courses` WHERE semester = 3");
$result4 = mysqli_query($conn, "SELECT * FROM `courses` WHERE semester = 4");
$result5 = mysqli_query($conn, "SELECT * FROM `courses` WHERE semester = 5");
$result6 = mysqli_query($conn, "SELECT * FROM `courses` WHERE semester = 6");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $selected_courses=$_POST['selected_courses'];
    $student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM course_reg where enroll=$enroll"));
    foreach($student as $key => $value)
    {
        if($key=='enroll')
        continue;
        $clean=mysqli_query($conn,"UPDATE `course_reg` set `$key` = null where enroll=$enroll");
    }
    $clean=mysqli_query($conn,"DELETE from `results` where `enrollment`=$enroll");
    for ($i = 0, $j = 1; $i < count($selected_courses); $i++, $j++) 
    {
        $result = mysqli_query($conn, "UPDATE course_reg SET course$j= '$selected_courses[$i]' where enroll=$enroll");
        $delete= mysqli_query($conn,"DELETE * from results where enrollment=$enroll");
        $sql3 = "insert into results (enrollment,course_name) values ($enroll,'$selected_courses[$i]')";
        $res3 = mysqli_query($conn, $sql3); 
        
    }
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Courses registered successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Register Courses</title>
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
    <link href="registerstyle.css" rel="stylesheet" type="text/css" media="all" />
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* .container1 {
            text-align: center;
            margin-top: 2px;
        }

        body {
            background-color: lightgoldenrodyellow;
        }

        form {
            width: 26%;
            margin: 70px auto;
            padding: 15px;
            border: 1px solid #555;
        } */

        #color {
            border-radius: 5px;
        }

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
        }

        @media (max-width: 992px) {
            .get-started-btn {
                padding: 7px 20px 8px 20px;
                margin-right: 15px;
            }
        }

        .agileits_w3layouts {
            background: url(../assets/img/tempbg.jpg)no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        .wrap {
            padding: 2.3em;
            width: 37%;
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
    </style>
</head>

<body class="agileits_w3layouts" style="background-color: black;">

    <div style="color: grey;">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="../StudentHome.php" class="breadcrumbs__link">Home</a>
            </li>

            <li class="breadcrumbs__item">
                <a href="/register courses/register.php" class="breadcrumbs__link breadcrumbs__link--active">Course Registration</a>
            </li>
        </ul>
        <h1 class="agile_head text-center">Course Registration</h1>
        <div class=" w3layouts_main wrap">


            <div class="container">

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div style="color: grey;">

                        <?php
                        $count = 0;

                        echo "<h4 style='font-size: 30px; color:#ffc451'>First Semester</h4>";
                        echo '<div class="form-check">';
                        while ($row = mysqli_fetch_assoc($result1)) {
                            echo '<input style = "margin-top:10px;" class="form-check-input" name="selected_courses[]" type="checkbox" value="' . $row['course_id'] . '" id="sem1' . $count . '">
                            <label style = "margin-top:5px;" class="form-check-label" for="sem1' . $count . '">' . $row['course_name'] .  '</label><br>';

                            $count++;
                        }
                        echo '</div>';


                        echo "<br><h4 style='font-size: 30px; color:#ffc451'>Second Semester</h4>";
                        while ($row = mysqli_fetch_assoc($result2)) {
                            echo '<input style = "margin-top:10px;"class="form-check-input" name="selected_courses[]" type="checkbox" value="' . $row['course_id'] . '" id="sem2' . $count . '">
                            <label style = "margin-top:5px;"class="form-check-label" for="sem2' . $count . '">' . $row['course_name'] .  '</label><br>';
                            $count++;
                        }
                        echo '</tr>';
                        echo '</table>';
                        echo "<br><h4 style='font-size: 30px; color:#ffc451'>Third Semester</h4>";
                        while ($row = mysqli_fetch_assoc($result3)) {
                            echo '<input style = "margin-top:10px;"class="form-check-input" name="selected_courses[]" type="checkbox" value="' . $row['course_id'] . '" id="sem3' . $count . '">
                            <label style = "margin-top:5px;"class="form-check-label" for="sem3' . $count . '">' . $row['course_name'] .  '</label><br>';
                            $count++;
                        }
                        echo "<br><h4 style='font-size: 30px; color:#ffc451'>Fourth Semester</h4>";
                        while ($row = mysqli_fetch_assoc($result4)) {
                            echo '<input style = "margin-top:10px;"class="form-check-input" name="selected_courses[]" type="checkbox" value="' . $row['course_id'] . '" id="sem4' . $count . '">
                            <label style = "margin-top:5px;"class="form-check-label" for="sem4' . $count . '">' . $row['course_name'] .  '</label><br>';
                            $count++;
                        }
                        echo "<br><h4 style='font-size: 30px; color:#ffc451'>Fifth Semester</h4>";
                        while ($row = mysqli_fetch_assoc($result5)) {
                            echo '<input style = "margin-top:10px;"class="form-check-input" name="selected_courses[]" type="checkbox" value="' . $row['course_id'] . '" id="sem5' . $count . '">
                            <label style = "margin-top:5px;"class="form-check-label" for="sem5' . $count . '">' . $row['course_name'] .  '</label><br>';
                            $count++;
                        }
                        echo "<br><h4 style='font-size: 30px; color:#ffc451'>Sixth Semester</h4>";
                        while ($row = mysqli_fetch_assoc($result6)) {
                            echo '<input style = "margin-top:10px;"class="form-check-input" name="selected_courses[]" type="checkbox" value="' . $row['course_id'] . '" id="sem6' . $count . '">
                            <label style = "margin-top:5px;"class="form-check-label" for="sem6' . $count . '">' . $row['course_name'] .  '</label><br>';
                            $count++;
                        }

                        echo '<center><div class="col-12"><br>
            <button class="get-started-btn scrollto" type="submit">Submit form</button>
             </div></center>';
                        ?>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>