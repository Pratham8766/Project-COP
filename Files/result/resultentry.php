<?php
// session_start();
include("../conn.php");
$enroll = $_SESSION['enrollid'];
include("../notification.php");
$sql1 = "select course_id, course_name from courses where teacher_id = $enroll";
$res1 = mysqli_query($conn, $sql1);
$course="";
?>

<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .agileits_w3layouts {
            background: url(../assets/img/result1.jpg)no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        
        .wrap {
            padding: 2.3em;
            width: 50%;
            margin: 2em auto;
            background: rgba(1, 14, 21, 0.62);
           
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

    <title>COP-Result</title>
</head>

<body class="agileits_w3layouts" style="background-color: black;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
        
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="../TeacherHome.php" class="breadcrumbs__link">Home</a>
        </li>

        <li class="breadcrumbs__item">
            <a href="resultentry.php" class="breadcrumbs__link breadcrumbs__link--active">Store Result</a>
        </li>
    </ul>
    <h1 class="agile_head" style="text-align: center; color:#ffc451;">Result</h1>
    <div class="w3layouts_main wrap" style="padding-bottom: 80px;">
        <form class="form-inline" action="resultentry.php" method="POST">
            <select name="course" class="form-select">
                <option selected>Select Course</option>
                <?php
                if ($res1) {
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        echo '<option  value="' . $row1["course_id"] . '">' . $row1["course_id"] . '-' . $row1["course_name"] . '</option>';
                    }
                }
                ?>
            </select>
            <select onchange="if(this.value != 0) { this.form.submit(); }" name="Type_of_Result" class="form-select" style="margin-top: 40px;">
                <option selected>Type of Result</option>
                <option value="ass"> Assignments</option>
                <option value="prac"> Practicals</option>
                <option value="pt"> Progressive Test</option>
                <option value="th"> Final theory</option>

            </select>

            <!-- <div id="button">
                <button name="submit course" value="submit" class="get-started-btn scrollto">View Profile</button>-->
            </div>
        </form>
        
        
        <form action="resultentry.php" method="POST">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['Type_of_Result'])) {
            $course = $_POST['course'];
            $type = $_POST['Type_of_Result'];
            $_SESSION['var1'] = $course;
            $_SESSION['var'] = $type;
            $sql2 = "select * from course_reg where course1='$course' OR course2='$course' OR course3='$course' OR course4='$course' OR course5='$course' OR course6='$course' OR course7='$course'";
            $res2 = mysqli_query($conn, $sql2);
            echo '<table class="table">';
            switch ($type) {
                case 'ass':
                    echo '<thead style="color:#ffc451">
                    <th>Enrollment</th>
                    <th>Assignment_1</th>
                    <th>Assignment_2</th>
                    </thead>
                    <tbody>';

                    $total2 = mysqli_num_rows($res2);
                    if ($total2 > 0) {
                        while ($row2 = mysqli_fetch_assoc($res2)) {

                            echo '<tr>';
                            echo '<td style = "color:#ffc451">' . $row2["enroll"] . '</td>';
                            echo '<td> <input  type="number" name="ass1[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                            echo '<td> <input  type="number" name="ass2[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                            echo '</tr>';


                        }
                    }
                    break;


                case 'prac':
                    echo '<thead style = "color:#ffc451">
                        <th>Enrollment</th>
                        <th>Practical_1</th>
                        <th>Practical_2</th>
                        <th>Practical_3</th>
                        </thead>
                        <tbody>';

                    $total2 = mysqli_num_rows($res2);
                    if ($total2 > 0) {
                        while ($row2 = mysqli_fetch_assoc($res2)) {

                            echo '<tr>';
                            echo '<td style = "color:#ffc451">' . $row2["enroll"] . '</td>';
                            echo '<td> <input type="number" name="prac1[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                            echo '<td> <input type="number" name="prac2[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                            echo '<td> <input type="number" name="prac3[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                            echo '</tr>';


                        }
                    }
                    break;


                case 'pt':
                    echo '<thead style = "color:#ffc451">
                        <th>Enrollment</th>
                        <th>PT_1</th>
                        <th>PT_2</th>
                        </thead>
                        <tbody>';

                    $total2 = mysqli_num_rows($res2);
                    if ($total2 > 0) {
                        while ($row2 = mysqli_fetch_assoc($res2)) {

                            echo '<tr>';
                            echo '<td style = "color:#ffc451">' . $row2["enroll"] . '</td>';
                            echo '<td> <input type="number" name="pt1[' . $row2["enroll"] . ']" placeholder="/20" min=0 max=20> </td>';
                            echo '<td> <input type="number" name="pt2[' . $row2["enroll"] . ']" placeholder="/20" min=0 max=20> </td>';
                            echo '</tr>';

                        }
                    }
                    break;


                case 'th':
                    echo '<thead style = "color:#ffc451">
                        <th>Enrollment</th>
                        <th>Final Theory</th>
                        </thead>
                        <tbody>';

                    $total2 = mysqli_num_rows($res2);
                    if ($total2 > 0) {
                        while ($row2 = mysqli_fetch_assoc($res2)) {

                            echo '<tr>';
                            echo '<td style = "color:#ffc451">' . $row2["enroll"] . '</td>';
                            echo '<td> <input type="number" name="th[' . $row2["enroll"] . ']" placeholder="/70" min=0 max=70> </td>';
                            echo '</tr>';

                            

                        }
                    }
                    break;
            }
            echo '</table>

        <input class="get-started-btn scrollto" name= "submit" type="submit">';
        }
        }
        ?>
        </form>
        
        
        <?php
        if (isset($_POST['submit'])) {
            $course = $_SESSION['var1'];
            $type = $_SESSION['var'];

            
            switch ($type) {
                case 'ass':
                    $ass1 = $_POST['ass1'];
                    $ass2 = $_POST['ass2'];
                    foreach ($ass1 as $key => $value) {
                        $sql3 = "UPDATE results set Assignment_1 = $value where enrollment = $key and course_name = '$course'";
                        $res3 = mysqli_query($conn, $sql3);
                    }
                    foreach ($ass2 as $key => $value) {
                        $sql4 = "UPDATE results set Assignment_2 = $value where enrollment = $key and course_name = '$course'";
                        $res4 = mysqli_query($conn, $sql4);
                    }
                    if($res3 || $res4){
                        echo '<div class="alert alert-success" role="alert">
                            Marks Recorded
                            </div>';
                        $response = sendMessage();
                        $return["allresponses"] = $response;
                        $return = json_encode($return);
                        $data = json_decode($response, true);
                        $id = $data['id'];
                    }
                    break;

                case 'prac':
                    $prac1 = $_POST['prac1'];
                    $prac2 = $_POST['prac2'];
                    $prac3 = $_POST['prac3'];
                    foreach ($prac1 as $key => $value) {
                        $sql3 = "UPDATE results set Practical_1 = $value where enrollment = $key and course_name = '$course'";
                        $res3 = mysqli_query($conn, $sql3);
                    }
                    foreach ($prac2 as $key => $value) {
                        $sql4 = "UPDATE results set Practical_2 = $value where enrollment = $key and course_name = '$course'";
                        $res4 = mysqli_query($conn, $sql4);
                    }
                    foreach ($prac3 as $key => $value) {
                        $sql5 = "UPDATE results set Practical_3 = $value where enrollment = $key and course_name = '$course'";
                        $res5 = mysqli_query($conn, $sql5);
                    }
                    if($res3 || $res4 || $res5){
                        echo '<div class="alert alert-success" role="alert">
                            Marks Recorded
                            </div>';
                        $response = sendMessage();
                        $return["allresponses"] = $response;
                        $return = json_encode($return);
                        $data = json_decode($response, true);
                        $id = $data['id'];
                    }
                    break;

                case 'pt':
                    $pt1 = $_POST['pt1'];
                    $pt2 = $_POST['pt2'];
                    foreach ($pt1 as $key => $value) {
    
                        $sql3 = "UPDATE results set PT_1 = $value where enrollment = $key and course_name = '$course'";
                        $res3 = mysqli_query($conn, $sql3);
                    }
                    foreach ($pt2 as $key => $value) {
                        $sql4 = "UPDATE results set PT_2 = $value where enrollment = $key and course_name = '$course'";
                        $res4 = mysqli_query($conn, $sql4);
                    }
                    if($res3 || $res4){
                        echo '<div class="alert alert-success" role="alert">
                            Marks Recorded
                            </div>';
                        $response = sendMessage();
                        $return["allresponses"] = $response;
                        $return = json_encode($return);
                        $data = json_decode($response, true);
                        $id = $data['id'];
                    }
                    break;

                case 'th':
                    $th = $_POST['th'];
                    foreach ($th as $key => $value) {
                        $sql3 = "UPDATE results set Final_Theory = $value where enrollment = $key and course_name = '$course'";
                        $res3 = mysqli_query($conn, $sql3);
                    }
                    if($res3){
                        echo '<div class="alert alert-success" role="alert">
                            Marks Recorded
                            </div>';
                        $response = sendMessage();
                        $return["allresponses"] = $response;
                        $return = json_encode($return);
                        $data = json_decode($response, true);
                        $id = $data['id'];
                    }
                    break;
            }
        }
        ?>
    </body>

</html>