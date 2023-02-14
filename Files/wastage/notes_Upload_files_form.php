<?php include 'notes_Upload_files.php';
session_start();
$enroll = $_SESSION['enrollid']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Files Upload and Download</title>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<div class="container">
  <div class="row">
    <form action="notes_Upload_files.php" method="post" enctype="multipart/form-data">

      <body>
        <h2 style="font-size:30px; text-align:center;">Upload File</h2>
        <center>
          <?php
          $sql1 = "select * from courses WHERE teacher_id=$enroll";
          $res1 = mysqli_query($conn, $sql1);
          echo '
          <select style="margin-top: 35px;" name="course" class = "form-select" size = "1">';
          echo '<option value="Select Course">Select Course</option>';
          while ($row = mysqli_fetch_assoc($res1)) {
            echo '<option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>';
            // echo $row['course_name'];
          }
          echo '</select>';
          ?>
          <select style="margin-top: 40px;" class="form-select" name="unit">
            <option>Select Unit</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>
        </center>

        <div style="margin-top: 40px;" class="container">
          <b>Select Notes:</b>
          <input type="file" name="myfile" class="type">
          <button type="submit" name="save" class="btn btn-outline-primary" id="color">Upload</button>
        </div>
        <div class="container1">
        </div>
    </form>
  </div>
</div>
</body>

</html>