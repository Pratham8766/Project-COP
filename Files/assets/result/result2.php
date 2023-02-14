<?php
session_start();
include("../conn.php");
// $conn = mysqli_connect("localhost", "root", "", "COP");
if (!$conn) {
    echo "connection not successful";
    exit();
} else {
    echo "connection successfull";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // $ass1 = $_POST['ass1'];
        // $ass2 = $_POST['ass2'];

        // $prac1 = $_POST['prac1'];
        // $prac2 = $_POST['prac2'];
        // $prac3 = $_POST['prac3'];

        // $pt1 = $_POST['pt1'];
        // $pt2 = $_POST['pt2'];

        // $th = $_POST['th'];

        $course = $_SESSION['var1'];
        $type = $_SESSION['var'];

        // echo $course;
        // print_r($ass1);
        // print_r($ass2);
        // $sql2 = "select * from course_reg where course1='$course' OR course2='$course' OR course3='$course' OR course4='$course' OR course5='$course' OR course6='$course' OR course7='$course'";
        // $res2 = mysqli_query($conn, $sql2);
        switch ($type) {
            case 'ass':
                $ass1 = $_POST['ass1'];
                $ass2 = $_POST['ass2'];
                foreach ($ass1 as $key => $value) {
                    // $sql3 = "INSERT INTO '$course' (enrollment,Assignment_1,Assignment_2) VALUES ($enroll,$ass1,$ass2)";
                    $sql3 = "UPDATE $course set Assignment_1 = $value where enrollment = $key";
                    // echo $sql3;
                    $res3 = mysqli_query($conn, $sql3);
                }
                foreach ($ass2 as $key => $value) {
                    $sql4 = "UPDATE $course set Assignment_2 = $value where enrollment = $key";
                    // echo $sql3;
                    $res4 = mysqli_query($conn, $sql4);
                }
                break;

            case 'prac':
                $prac1 = $_POST['prac1'];
                $prac2 = $_POST['prac2'];
                $prac3 = $_POST['prac3'];
                foreach ($prac1 as $key => $value) {
                    // $sql3 = "INSERT INTO '$course' (enrollment,Assignment_1,Assignment_2) VALUES ($enroll,$ass1,$ass2)";
                    $sql3 = "UPDATE $course set Practical_1 = $value where enrollment = $key";
                    // echo $sql3;
                    $res3 = mysqli_query($conn, $sql3);
                }
                foreach ($prac2 as $key => $value) {
                    $sql4 = "UPDATE $course set Practical_2 = $value where enrollment = $key";
                    // echo $sql3;
                    $res4 = mysqli_query($conn, $sql4);
                }
                foreach ($prac3 as $key => $value) {
                    $sql5 = "UPDATE $course set Practical_3 = $value where enrollment = $key";
                    // echo $sql3;
                    $res5 = mysqli_query($conn, $sql5);
                }
                break;

            case 'pt':
                $pt1 = $_POST['pt1'];
                $pt2 = $_POST['pt2'];
                foreach ($pt1 as $key => $value) {
                    // $sql3 = "INSERT INTO '$course' (enrollment,Assignment_1,Assignment_2) VALUES ($enroll,$ass1,$ass2)";
                    $sql3 = "UPDATE $course set PT_1 = $value where enrollment = $key";
                    // echo $sql3;
                    $res3 = mysqli_query($conn, $sql3);
                }
                foreach ($pt2 as $key => $value) {
                    $sql4 = "UPDATE $course set PT_2 = $value where enrollment = $key";
                    // echo $sql3;
                    $res4 = mysqli_query($conn, $sql4);
                }
                break;

            case 'th':
                $th = $_POST['th'];
                foreach ($th as $key => $value) {
                    // $sql3 = "INSERT INTO '$course' (enrollment,Assignment_1,Assignment_2) VALUES ($enroll,$ass1,$ass2)";
                    $sql3 = "UPDATE $course set Final_Theory = $value where enrollment = $key";
                    // echo $sql3;
                    $res3 = mysqli_query($conn, $sql3);
                }
                break;
        }
    } 
    
    else {
        echo "npt post";
    }
}
