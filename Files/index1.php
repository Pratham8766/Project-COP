<?php 
// session_start(); 
include("conn.php");
$result = mysqli_query($conn, "DELETE FROM cancelled_classes WHERE (`date`-CURDATE())>0");
$result = mysqli_query($conn, "DELETE FROM extra_classes WHERE (`date`-CURDATE())>0");
?>
<html lang="en">
<head>

<!-- Required meta tags  -->
<meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<meta name="viewport" content="width=1024">
      <!-- Bootstrap CSS  -->
     <link href="https:cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="style.css">

 </head>

 <body>
     <div class="container" onclick="onclick">
         <div class="top"></div>
         <div class="bottom"></div>
         <form action="<?php $_SERVER['PHP_SELF']; ?>"" method="POST">
             <div class="center">
                 <h2>Please Login</h2>
                 <input name="enroll_id" type="number" placeholder="Enter ID" />
                 <input name="pass_id" type="password" placeholder="Password" />
                 <button type="submit" class="btn btn-primary">login</button><br>
                 <button type="button" class="btn btn-primary" onclick="window.location.href='signup.php'"> Signup </button>
                 <h2>&nbsp;</h2>
             </div>
         </form>
     </div>

     <?php
     if ($_SERVER['REQUEST_METHOD'] == "POST") 
     {
         $enrollid = $_POST['enroll_id'];
         $_SESSION['enrollid']=$enrollid;
         $passid = $_POST['pass_id'];
        //   $conn = mysqli_connect('localhost', 'root', '', 'COP');
         $sql = "SELECT * FROM `students` WHERE `enrollment`= '$enrollid' AND `password` = '$passid'";
         $result = mysqli_query($conn, $sql);
         $total = mysqli_num_rows($result);
         $teachers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `teachers` WHERE `teacher_id`= $enrollid AND `password` = '$passid'"));
         $admin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `admin` WHERE `admin_id`= $enrollid AND `password` = '$passid'"));
         if ($total == 1) {
            //   header("Location: loginhome.php");
             echo '<meta http-equiv="refresh" content="0;url=StudentHome.php">';
         } 
         else if($teachers==1)
         {
            //   header("location: teacherhome.php");
             echo '<meta http-equiv="refresh" content="0;url=TeacherHome.php">';
         }
         else if ($admin == 1) {
            //   header("location: teacherhome.php");
            echo '<meta http-equiv="refresh" content="0;url=AdminHome.php">';
        }
         else    
             echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>Invalid credentials!!</strong>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
     }
    
     ?>
      <!-- Optional JavaScript; choose one of the two!  -->

      <!-- Option 1: Bootstrap Bundle with Popper  -->
     <script src="https:cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

      <!-- Option 2: Separate Popper and Bootstrap JS  -->
     
     <!-- <script src="https:cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
     <script src="https:cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
      -->
 </body>

 </html> 

