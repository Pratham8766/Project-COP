<?php
// connect to the database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "cop";
// $conn = mysqli_connect($servername, $username, $password, $dbname);

include("../conn.php");
$enroll = $_SESSION['enrollid'];

include("../notification.php");
$sql = "SELECT * FROM announcements";
$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['save'])) 
{ // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $course = $_POST['course'];
    $title = $_POST['title'];
    $body = $_POST['description'];
// echo ($_POST['due_date']);
    if($_POST['due_date']!="")
    {
      $due_date = $_POST['due_date'];
    }
    else{
      $due_date = '0000-00-00';
    }
    if(isset($filename)){
        $file = $_FILES['myfile']['tmp_name'];
        $size = $_FILES['myfile']['size'];
    }
    else{
        $filename = NULL;
        $size = NULL;
    }
    $destination = 'uploads/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($extension, ['zip', 'pdf', 'docx','jpg','jpeg','png','pptx','xlsx','doc','ppt','xls','c','java','class','exe','rar','html','css','js','php','cpp','txt','sql',''])) {
        echo "You file extension must be .zip, .pdf .jpgor .docx";
    } 
    elseif ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } 
    else
    {
        if (move_uploaded_file($file, $destination)) {      
          $sql = "INSERT INTO announcements (name,size,subject, title, body, due_date, downloads) VALUES ('$filename',$size,'$course', '$title', '$body', '$due_date',0)";
          if (mysqli_query($conn, $sql)) 
          {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>File Uploaded Successfully!!</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            $response = sendMessage();
            $return["allresponses"] = $response;
            $return = json_encode($return);
            $data = json_decode($response, true);
            $id = $data['id'];
          }
        } 
        else{
            $sql1 = "INSERT INTO announcements (name,size,subject, title, body, due_date, downloads) VALUES (null ,null,'$course', '$title', '$body','$due_date' ,null)";
            $result1 = mysqli_query($conn, $sql1);
            if($result1){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>File Uploaded Successfully!!</strong> 
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

<head>
  <title>Announcement</title>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

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
	<!-- <link href="feedbackstyle.css" rel="stylesheet" type="text/css" media="all" /> -->
	<link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
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
  #color{
    color:white;
  }

  .agileits_w3layouts {
            background-image: url("../assets/img/tempbg.jpg");
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
  </style>
  
</head>

<body class="agileits_w3layouts" style="background-color: black;">
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="../TeacherHome.php" class="breadcrumbs__link">Home</a>
        </li>

        <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Make Announcement</a>
        </li>
    </ul>
<h1 class="agile_head text-center">Make Announcement</h1>
<div class="container">
  <div class="w3layouts_main wrap">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      
          <?php
          $sql1 = "select * from courses WHERE teacher_id=$enroll";
          $res1 = mysqli_query($conn, $sql1);
          echo '
          <select style="margin-top: 35px;" name="course" class = "form-select" size = "1">';
          echo '<option value="Select Course" required>Select Course</option>';
          while ($row = mysqli_fetch_assoc($res1)) {
            echo '<option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>';
            // echo $row['course_name'];
          }
          echo '</select>';
          ?>
          <br>
          <!-- <textarea name="title" class = "form-select" cols="1" rows="1">Title</textarea> -->
          <input type="text" name="title" class = "form-control" placeholder = "Title" required>
          <br>
          <textarea name="description" id="" cols="20" rows="10" class = "form-select" placeholder = "Body"></textarea>
          <br>
          &emsp;
          &emsp;
        
          <br>
          <div style = "text-align:left;">
            <br>
            <b id = "color">Due date: </b><input type="date" name="due_date" placeholder = "Due Date" > <br>
            </div>
            <br>
            <br>
            <div class="mb-2">
             <br>
            <label for="formFile" class="form-label" id = "color">Attach file :</label>
            <input class="form-control" type="file" name="myfile" class="type"><br>
          </div>
          <center>

          <button type="submit" name="save" class="btn btn-primary" id="color">Upload</button>

          </center>
        
    </form>
  </div>
</div>


</body>

</html>