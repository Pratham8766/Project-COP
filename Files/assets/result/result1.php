<?php
session_start();
include("../conn.php");
// $conn = mysqli_connect("localhost", "root", "", "COP");
if (!$conn) {
    echo "connection not successful";
    exit();
} else {
    // if (isset($_POST['course'])) {
    //     $course = $_POST['course'];
    //     $type=$_POST['Type_of_Result'];
    //     $_SESSION['var1'] = $course;
    //     // $check = $_POST['check'];
    //     $_SESSION['var'] = $_POST["enroll"];
    // }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $course = $_POST['course'];
        $type = $_POST['Type_of_Result'];
        $_SESSION['var1'] = $course;
        $_SESSION['var'] = $type;
        // echo $course;
        // echo $type;
        $sql2 = "select * from course_reg where course1='$course' OR course2='$course' OR course3='$course' OR course4='$course' OR course5='$course' OR course6='$course' OR course7='$course'";
        $res2 = mysqli_query($conn, $sql2);
        //$sql3 = "INSERT INTO $course (enrollment,Assignment_1,Assignment_2) VALUES ($row2['enroll'],$_POST['asss1'],$_POST['ass2'])";
        //$res3=mysqli_query($conn, $sql3);

    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>test2</title>
    <!-- <style>
        table {
            width: 45%;
            border: solid black;
            margin: 10px auto;
        }

        th,
        td {
            height: 50px;
            vertical-align: center;
            text-align: center;
            border: 1px solid black;
        }
    </style> -->
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <h1 class="display-3" style="text-align: center;">List of Students</h1>


    <div class="container mb-3">

        <form action="result2.php" method="POST">
            <table class="table">
                <?php
                switch ($type) {
                    case 'ass':
                        // echo '<table>
                        echo '<thead>
                    <th>Enrollment</th>
                    <th>Assignment_1</th>
                    <th>Assignment_2</th>
                    </thead>
                    <tbody>';

                        $total2 = mysqli_num_rows($res2);
                        if ($total2 > 0) {
                            while ($row2 = mysqli_fetch_assoc($res2)) {

                                echo '<tr>';
                                echo '<td>' . $row2["enroll"] . '</td>';
                                echo '<td> <input type="number" name="ass1[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                                echo '<td> <input type="number" name="ass2[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                                // echo '<td>' . $file["unit"] . '</td>';
                                // echo '<td><a href="Download_files.php?file_id='.$file["id"].'">Download</a></td>
                                echo '</tr>';

                                // echo '<label class="list-group-item"> <input type="checkbox" class="form-check-input me-1"  name = "check[' . $row2['enroll'] . ']" value="1">' .
                                //     $row2['enroll'] . '</label>';

                            }
                        }
                        break;


                    case 'prac':
                        // echo '<table>
                        echo '<thead>
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
                                echo '<td>' . $row2["enroll"] . '</td>';
                                echo '<td> <input type="number" name="prac1[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                                echo '<td> <input type="number" name="prac2[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                                echo '<td> <input type="number" name="prac3[' . $row2["enroll"] . ']" placeholder="/10" min=0 max=10> </td>';
                                // echo '<td>' . $file["unit"] . '</td>';
                                // echo '<td><a href="Download_files.php?file_id='.$file["id"].'">Download</a></td>
                                echo '</tr>';

                                // echo '<label class="list-group-item"> <input type="checkbox" class="form-check-input me-1"  name = "check[' . $row2['enroll'] . ']" value="1">' .
                                //     $row2['enroll'] . '</label>';

                            }
                        }
                        break;


                    case 'pt':
                        // echo '<table>
                        echo '<thead>
                        <th>Enrollment</th>
                        <th>PT_1</th>
                        <th>PT_2</th>
                        </thead>
                        <tbody>';

                        $total2 = mysqli_num_rows($res2);
                        if ($total2 > 0) {
                            while ($row2 = mysqli_fetch_assoc($res2)) {

                                echo '<tr>';
                                echo '<td>' . $row2["enroll"] . '</td>';
                                echo '<td> <input type="number" name="pt1[' . $row2["enroll"] . ']" placeholder="/20" min=0 max=20> </td>';
                                echo '<td> <input type="number" name="pt2[' . $row2["enroll"] . ']" placeholder="/20" min=0 max=20> </td>';
                                // echo '<td>' . $file["unit"] . '</td>';
                                // echo '<td><a href="Download_files.php?file_id='.$file["id"].'">Download</a></td>
                                echo '</tr>';

                                // echo '<label class="list-group-item"> <input type="checkbox" class="form-check-input me-1"  name = "check[' . $row2['enroll'] . ']" value="1">' .
                                //     $row2['enroll'] . '</label>';

                            }
                        }
                        break;


                    case 'th':
                        // echo '<table class="table table-striped table-hover">
                        echo '<thead>
                        <th>Enrollment</th>
                        <th>Final Theory</th>
                        </thead>
                        <tbody>';

                        $total2 = mysqli_num_rows($res2);
                        if ($total2 > 0) {
                            while ($row2 = mysqli_fetch_assoc($res2)) {

                                echo '<tr>';
                                echo '<td>' . $row2["enroll"] . '</td>';
                                echo '<td> <input type="number" name="th[' . $row2["enroll"] . ']" placeholder="/70" min=0 max=70> </td>';
                                // echo '<td> <input type="number" name="ass2[' . $row2["enroll"] . ']"> </td>';
                                // echo '<td>' . $file["unit"] . '</td>';
                                // echo '<td><a href="Download_files.php?file_id='.$file["id"].'">Download</a></td>
                                echo '</tr>';

                                // echo '<label class="list-group-item"> <input type="checkbox" class="form-check-input me-1"  name = "check[' . $row2['enroll'] . ']" value="1">' .
                                //     $row2['enroll'] . '</label>';

                            }
                        }
                        break;
                }
                ?>
            </table>

            <input class="btn btn-outline-primary" type="submit" >
        </form>

    </div>
</body>