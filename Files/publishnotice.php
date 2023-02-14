<?php
// session_start();
include("conn.php");
$enroll = $_SESSION['enrollid'];

include("notification.php");
$sql = "SELECT * FROM notices";
$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);


if (isset($_POST['save'])) {
  $filename = $_FILES['myfile']['name'];
  $subject = $_POST['subject'];

  if (isset($_POST['body'])) {
    $body = $_POST['body'];
  } else {
    $body = NULL;
  }

  if (isset($filename)) {
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
  } else {
    $filename = NULL;
    $size = NULL;
  }

  $destination = 'noticeuploads/' . $filename;
  $extension = pathinfo($filename, PATHINFO_EXTENSION);

  if (!in_array($extension, ['zip', 'pdf', 'docx', ''])) {
    echo "You file extension must be .zip, .pdf or .docx";
  } elseif ($_FILES['myfile']['size'] > 1000000) {
    echo "File too large!";
  } else {
    if (move_uploaded_file($file, $destination)) {
      $sql = "INSERT INTO notices (name, subject, body, size, downloads) VALUES ('$filename', '$subject', '$body', $size, 0)";
      if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>File Uploaded Successfully.</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                     $response = sendMessage();
                        $return["allresponses"] = $response;
                        $return = json_encode($return);
                        $data = json_decode($response, true);
                        $id = $data['id'];
      }
    } else if (move_uploaded_file($file, $destination)) {
      $sql1 = "INSERT INTO notices (name, subject, body, size, downloads) VALUES ('$filename', '$subject', null, '$size',0)";
      $result1 = mysqli_query($conn, $sql1);
      if ($result1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>File Uploaded Successfully.</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                   $response = sendMessage();
                        $return["allresponses"] = $response;
                        $return = json_encode($return);
                        $data = json_decode($response, true);
                        $id = $data['id'];
                  
      }
    } else if (move_uploaded_file($file, $destination)) {
      $sql1 = "INSERT INTO notices (name, subject, body, size, downloads) VALUES (null, '$subject', null, null, null)";
      $result1 = mysqli_query($conn, $sql1);
      if ($result1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>File Uploaded Successfully.</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                   $response = sendMessage();
                        $return["allresponses"] = $response;
                        $return = json_encode($return);
                        $data = json_decode($response, true);
                        $id = $data['id'];
                  
      }
    } else {
      $sql2 = "INSERT INTO notices (name, subject, body, size, downloads) VALUES (null, '$subject','$body', null, null)";
      $result2 = mysqli_query($conn, $sql2);
      if ($result2) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>File Uploaded Successfully.</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                   $response = sendMessage();
                        $return["allresponses"] = $response;
                        $return = json_encode($return);
                        $data = json_decode($response, true);
                        $id = $data['id'];
                 
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<title>Issue Notice</title>

<head>

  <title>Notice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


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
  <link href="feedbackstyle.css" rel="stylesheet" type="text/css" media="all" />
  <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <style>
    .agileits_w3layouts {
      background-image: url("/COP/feedbackbg.jpg");
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
      width: 40%;
      margin: 2em auto;
      background: rgba(1, 14, 21, 0.62);
    }

    .w3layouts_main h3 {
      font-size: 1em;
      color: #e6cfcf;
      line-height: 1.5;
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
  </style>
</head>

<body class="agileits_w3layouts" style="background-image: url('assets/img/features.jpg');">
  <ul class="breadcrumbs">
    <li class="breadcrumbs__item">
      <a href="TeacherHome.php" class="breadcrumbs__link">Home</a>
    </li>

    <li class="breadcrumbs__item">
      <a href="publishnotice.php" class="breadcrumbs__link breadcrumbs__link--active">Notice</a>
    </li>
  </ul>
  <h1 class="agile_head text-center">Issue Notice</h1>
  <div class="container">
    <div class="w3layouts_main wrap">
      <form action="publishnotice.php" method="post" enctype="multipart/form-data">

        <input class="form-control" type="text" name="subject" placeholder="Subject" required><br>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label"></label>
          <textarea class="form-control" name="body" id="exampleFormControlTextarea1" placeholder="Body" rows="3"></textarea>
        </div>

        <div class="mb-2">
          <label style="white-space:nowrap; color:white;" for="formFile" class="form-label" id="color">Attach file :</label>
          <input style="white-space:nowrap;" class="form-control" type="file" name="myfile" class="type"><br>
        </div>
        <center>
          <div class="container1">
            <button type="submit" name="save" class="btn btn-primary" id="color">UPLOAD</button>
          </div>
        </center>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>