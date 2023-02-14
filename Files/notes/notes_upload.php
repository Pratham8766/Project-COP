<?php
// session_start();
include("../conn.php");
$enroll = $_SESSION['enrollid'];
// $enroll=1234;
// $course='CM401E';
include("../notification.php");
$sql = "SELECT * FROM notes order by `upload_date` desc";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    // $course = $_POST['course'];
    $unit = $_POST['unit'];
    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpg', 'jpeg', 'png', 'pptx', 'xlsx', 'doc', 'ppt', 'xls', 'c', '.java', 'class', 'exe', 'rar', 'html', 'css', 'js', 'php', 'cpp', 'txt', 'sql', ''])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $p = $_SESSION['c'];
            $sql = "INSERT INTO notes (name, course_id, unit, size, downloads) VALUES ('$filename', '$p', $unit, $size, 0)";
            if (mysqli_query($conn, $sql)) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>File Uploaded successfully</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                $response = sendMessage();
                $return["allresponses"] = $response;
                $return = json_encode($return);
                $data = json_decode($response, true);
                $id = $data['id'];
            }
        } else {
           echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>File not Uploaded!!</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }
}
?>

<html lang="en">

<head>
    <title>Upload Notes</title>
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
        #color {
            color: white;
        }

        .agileits_w3layouts {
            background-image: url("/assets/img/tempbg.jpg");
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

        .get-started-btn {
            color: #fff;
            border-radius: 4px;
            padding: 7px 25px 8px 25px;
            white-space: nowrap;
            background-color: #343a40;
            transition: 0.3s;
            font-size: 14px;
            display: inline-block;
            border: 2px solid #ffc451;
        }

        .get-started-btn:hover {
            background: #ffbb38;
            color: #343a40;
        }

        .breadcrumbs {
            padding: 10px;
            font-family: 'Roboto', sans-serif;

        }

        .breadcrumbs__item {
            display: inline-block;
            margin-top: 5px;
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

<body class="agileits_w3layouts" style="background-color:green;">
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="../TeacherHome.php" class="breadcrumbs__link">Home</a>
        </li>

        <li class="breadcrumbs__item">
            <a href="" class="breadcrumbs__link breadcrumbs__link--active">Upload Notes</a>
        </li>
    </ul>
    <h1 class="agile_head text-center" style="color: #ffc451;">Upload Notes</h1>
    <div class=" w3layouts_main wrap">
        <div class="container">
            <div class="row">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

                        <center>
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

                        <div style="margin-top: 40px; color: #ffc451;" class="container">
                            Select Notes:
                            <input type="file" name="myfile" class="type">
                            <button type="submit" name="save" class=" get-started-btn scrollto" style="color: #ffc451; float:right">Upload</button>
                        </div>
                        <div class="container1">
                        </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>