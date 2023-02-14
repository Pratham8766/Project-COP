<?php
// ob_start();

// session_start();
include("conn.php");
$enroll = $_SESSION['enrollid'];
$sql = "SELECT * FROM notices ORDER BY time DESC";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (isset($_POST['save'])) { // if save button on the form is clicked
  // name of the uploaded file
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
  // destination of the file on the server
  $destination = 'noticeuploads/' . $filename;
  // get the file extension
  $extension = pathinfo($filename, PATHINFO_EXTENSION);

  // the physical file on a temporary uploads directory on the server

}

?>
<?php
if (isset($_GET['file_id'])) {
  $id = $_GET['file_id'];

  $sql = "SELECT * FROM notices WHERE id=$id";
  $result = mysqli_query($conn, $sql);

  $file = mysqli_fetch_assoc($result);
  $filepath = 'noticeuploads/' . $file['name'];

  if (file_exists($filepath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($filepath));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('noticeuploads/' . $file['name']));
    readfile('noticeuploads/' . $file['name']);

    $newCount = $file['downloads'] + 1;
    $updateQuery = "UPDATE notices SET downloads=$newCount WHERE id=$id";
    mysqli_query($conn, $updateQuery);
    exit;
  }
}
?>
<html>

<head>
  <meta charset="utf-8" />
  <title>NOTICE!!</title>

  <meta charset="utf-8" />
  <title>Download Notice</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <meta charset="utf-8">



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
  <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <style>
    .agileits_w3layouts {
      background-image: url("../assets/img/notice.jpg");
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
      width: 80%;
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

    #mytable {
      padding-top: 10px;
    }
  </style>
</head>

<body class="agileits_w3layouts" style="background-color: black;">
  <ul class="breadcrumbs">
    <li class="breadcrumbs__item">
      <a href="StudentHome.php" class="breadcrumbs__link">Home</a>
    </li>

    <li class="breadcrumbs__item">
      <a href="download_notice.php" class="breadcrumbs__link breadcrumbs__link--active">Notice</a>
    </li>
  </ul>
  <h1 class="agile_head text-center">View Notice</h1>
  <div class="container">
    <div class="w3layouts_main wrap">
      <table class="table table-dark table-bordered" id="myTable">
        <thead style="color: #ffc451">
          <th>SR. NO</th>
          <th>Upload Date</th>
          <th>Subject</th>
          <th>Body</th>
          <th>Attachment</th>
        </thead>
        <tbody>
          <?php
          $sr_no = 1;
          foreach ($files as $file) : ?>
            <tr>
              <td><?php echo $sr_no; ?></td>
              <td><?php echo $file['time']; ?></td>
              <td><?php echo $file['subject']; ?></td>
              <td><?php echo $file['body']; ?></td>
              <td style="white-space:nowrap;"><a style="color: #ffc451;" href="download_notice.php?file_id=<?php echo $file['id'] ?>"><?php echo $file['name']; ?></a></td>
            </tr>
          <?php
            $sr_no++;
          endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>