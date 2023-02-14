<?php
include("conn.php");
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="signupstyle.css">
  <title>COP Sign-up</title>
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
  </style>
</head>

<body>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enroll = $_POST['enrollment'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $mob = $_POST['mobile_no'];
    $addrress = $_POST['address'];
    $batch = $_POST['batch'];
    $semester = $_POST['semester'];
    $pass_input = $_POST['password'];
    $pass_retype = $_POST['retype_pass'];


    $flag = 0;
    $sql="SELECT * FROM admin where admin_id = $enroll" ;
    $admin =mysqli_num_rows(mysqli_query($conn,$sql));
    $sql2= "SELECT * FROM students where enrollment = $enroll";
    $students =mysqli_num_rows (mysqli_query($conn,$sql2));
    $sql3= "SELECT * FROM teachers where teacher_id = $enroll";
    $teacher =mysqli_num_rows( mysqli_query($conn,$sql3));
    if($admin==0 && $students==0 && $teacher==0)
    {
    
  
    if ($pass_input === $pass_retype) {
      // connneting to database
      //   $servername = "localhost";
      //   $username = "root";
      //   $password = ""; //no password when databse is on host machine
      //   $database = "COP";
      //   $conn = mysqli_connect($servername, $username, $password, $database);
      if (!$conn) {
        echo "Connection failed";
      } else {
        // echo "connection succesful";
        $query = "INSERT INTO `pending_req` (`enrollment`,`first name`,`middle name`,`last name`,`dob`,`email`,`mobile number`,`address`, `password`, `batch`, `semester`) VALUES ('$enroll', '$first_name', '$middle_name', '$last_name', '$dob', '$email', '$mob', '$addrress', '$pass_input', '$batch', '$semester')";
        $result = mysqli_query($conn, $query);
        if ($result) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>submitted</strong> successfully. Admin will approve your entry into system
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry</strong> your req has not been processed. please check your data.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
      }
    }
    // if($pass_input != $pass_retype) {
    //   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    //   <strong>Password not Matching.</strong>
    //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    // }




  }
else
{
  echo"INVALID ENROLLMENT";
}
}
  
  ?>
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="index.php" class="breadcrumbs__link">login Page</a>
        </li>

        <li class="breadcrumbs__item">
            <a href="signup.php" class="breadcrumbs__link breadcrumbs__link--active">Sign up</a>
        </li>
    </ul>
  <p style="text-align: center;  font-size:30px ">Welcome to COP.</p>
  <div class="container">
    <form action="signup.php" method="POST">
      <!-- <div class="mb-3"> -->
      <div class="shadow-lg p-3 mb-3 bg-body rounded">
        <label for="EnrollmentInput" class="form-label">Enrollment No:</label>
        <input type="number" name="enrollment" class="form-control" id="EnrollmentInput" aria-describedby="emailHelp" required>
      </div>
      <!-- </div> -->

      <!-- <div class="mb-3"> -->
      <div class="shadow-lg p-3 mb-3 bg-body rounded">
        <label for="first_name" class="form-label">First Name:</label>
        <input type="text" name="first_name" class="form-control" id="first_name" required>
      </div>
      <!-- </div> -->

      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="middle_name" class="form-label">Middle Name:</label>
          <input type="text" name="middle_name" class="form-control" id="middle_name">
        </div>
      </div>

      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="last_name" class="form-label">Last Name:</label>
          <input type="text" name="last_name" class="form-control" id="last_name" required>
        </div>
      </div>

      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="dob" class="form-label">Date of Birth:</label>
          <input type="date" name="dob" class="form-control" id="dob" required>
        </div>
      </div>

      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="email" class="form-label">Email:</label>
          <input type="email" name="email" class="form-control" id="eamil" required>
        </div>
      </div>

      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="mobile_no" class="form-label">Mobile no:</label>
          <input type="tel" name="mobile_no" class="form-control" id="mobile_no" required>
        </div>
      </div>

      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="address" class="form-label">Address:</label>
          <input type="text" name="address" class="form-control" id="address">
        </div>
      </div>
      
      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="batch" class="form-label">Batch:</label>
          <input type="text" name="batch" class="form-control" id="batch">
        </div>
      </div>
      
      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="semester" class="form-label">Semester:</label>
          <input type="number" name="semester" class="form-control" id="semester" min=1 max=6>
        </div>
      </div>


      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="PasswordInput" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="PasswordInput" required>
        </div>
      </div>

      <div class="mb-3">
        <div class="shadow-lg p-3 mb-3 bg-body rounded">
          <label for="RetypePassword" class="form-label">Retype-Password</label>
          <input type="password" name="retype_pass" class="form-control" id="RetypePassword" required>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Signup</button>
    </form>
  </div>





  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
     -->
</body>

</html>
