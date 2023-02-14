<?php
include("../conn.php");
if (!$conn) {
    die("Sorry we are unable to connect to the database" . "<br>");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>admin course registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body style="background-image: url('bg.jpg');">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Course Form</h2>
                    </div>

                    <form action="admin_course_entry.php" method="post">
                        <div class="form-group">
                            <label>course id</label>
                            <input type="text" name="course_id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>course name</label>
                            <input type="text" name="course_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>teacher id</label>
                            <input type="number" name="teacher_id" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>credits</label>
                            <input type="number" name="credits" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>semester</label>
                            <input type="number" name="semester" class="form-control">
                        </div>

                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include_once 'admin_course_entry.php';
if (isset($_POST['submit'])) {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $teacher_id = $_POST['teacher_id'];
    $credits = $_POST['credits'];
    $semester = $_POST['semester'];


    $sql = "INSERT INTO courses (course_id, course_name, teacher_id, credits, semester) VALUES ( '$course_id', '$course_name', $teacher_id , $credits, $semester)";
    if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-info" role="alert">
                A simple info alert—check it out!
            </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
            A simple danger alert—check it out!
            </div>';
    }
    mysqli_close($conn);
}
?>