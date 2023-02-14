<?php
session_start();
$enroll = $_SESSION['enrollid'];
include("../conn.php");
// $conn = mysqli_connect("localhost", "root", "", "cop");
if (!$conn) {
    echo "connection not successful";
    exit();
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Results</title>
</head>

<body>
    <h1 class="display-3" style="text-align: center;">Select Course</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <div class="container mb-3">
        <form action="fetch.php" method="POST">
           <?php $sql1 = "select * from course_reg WHERE enroll=$enroll";
      $res1 = mysqli_query($conn, $sql1);
      $row = mysqli_fetch_assoc($res1);
       $sql2= "select * from courses where course_id='$row[course1]'";
            $course1=mysqli_fetch_assoc(mysqli_query($conn,$sql2));$sql3= "select * from courses where course_id='$row[course2]'";
            $course2=mysqli_fetch_assoc(mysqli_query($conn,$sql3));$sql4= "select * from courses where course_id='$row[course3]'";
            $course3=mysqli_fetch_assoc(mysqli_query($conn,$sql4));$sql5= "select * from courses where course_id='$row[course4]'";
            $course4=mysqli_fetch_assoc(mysqli_query($conn,$sql5));$sql6= "select * from courses where course_id='$row[course5]'";
            $course5=mysqli_fetch_assoc(mysqli_query($conn,$sql6));$sql7= "select * from courses where course_id='$row[course6]'";
            $course6=mysqli_fetch_assoc(mysqli_query($conn,$sql7));$sql8= "select * from courses where course_id='$row[course7]'";
            $course7=mysqli_fetch_assoc(mysqli_query($conn,$sql8));
      echo '<div class="container mb-3">
            <select name="course" class = "form-select" size = "1">
            <option selected>Select Course</option>';
           
      if ($row['course1'] != NULL) echo '<option value="' . $row['course1'] . '">' . $course1['course_name'] . '</option>
            ';
      if ($row['course2'] != NULL) echo '<option value="' . $row['course2'] . '">' . $course2['course_name'] . '</option>
            ';
      if ($row['course3'] != NULL) echo '<option value="' . $row['course3'] . '">' .$course3['course_name'] . '</option>
            ';
      if ($row['course4'] != NULL) echo '<option value="' . $row['course4'] . '">' . $course4['course_name'] . '</option>
            ';
      if ($row['course5'] != NULL) echo '<option value="' . $row['course5'] . '">' . $course5['course_name'] . '</option>
            ';
      if ($row['course6'] != NULL) echo '<option value="' . $row['course6'] . '">' . $course6['course_name'] . '</option>
            ';
      if ($row['course7'] != NULL) echo '<option value="' . $row['course7'] . '">' . $course7['course_name'] . '</option>
            </select>';
      echo '<input class="btn btn-outline-primary" type="submit" value="search" style="margin-top: 30px;" >
      </div>';

      ?>
        </form>

    </div>

</body>

</html>