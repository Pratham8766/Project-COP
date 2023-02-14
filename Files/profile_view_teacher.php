<?php
// session_start();
include("conn.php");
$enroll = $_SESSION['enrollid'];
?>
<html>

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COP-View Profile</title>
  <style>
    .agileits_w3layouts {
      background-image: url("/gp cop/assets/img/bluegradient.jpg");
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

    .breadcrumbs {
      /* padding: 40px; */
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
      color: white;
    }

    .breadcrumbs__link:hover {
      color: white;
    }

    .breadcrumbs__link--active {
      color: #ffc451;
      font-weight: 500;
    }
  </style>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>


<body class="agileits_w3layouts" style="background-color: black;">

  <ul class="breadcrumbs">
    <li class="breadcrumbs__item">
      <a href="TeacherHome.php" class="breadcrumbs__link">Home</a>
    </li>

    <li class="breadcrumbs__item">
      <a href="profile_view_teacher.php" class="breadcrumbs__link breadcrumbs__link--active">View Profile</a>
    </li>
  </ul>
  <h1 class="agile_head text-center"> VIEW PROFILE</h1>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <div class=" w3layouts_main wrap">

    <?php
    $sql = "SELECT * FROM teachers where teacher_id = $enroll";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    foreach ($row as $key => $value) {
      if ($key == 'password')
        continue;
      echo '<span style="font-size: large; font-family: `Montserrat`, sans-serif; text-align:left; color: #ffc451">' . strtoupper($key) . '</span> : <span style="font-size: large; text-align:left; color: white">' . ucfirst($value) . '</span><br><br>';
    }
    ?>
  </div>
</body>

</html>