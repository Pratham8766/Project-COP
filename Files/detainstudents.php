<?php
include("conn.php");

if (isset($_POST['save'])) { // if save button on the form is clicked
    // session_start();
    $course = strtolower($_POST['course']);
    $title = $_POST['title'];
    $body = $_POST['description'];

    if (isset($_POST['due_date']))
        $due_date = $_POST['due_date'];
        $sql = "INSERT INTO announcements (name,size,subject, title, body, due_date, downloads) VALUES (null,null,'$course', '$title', '$body', '$due_date',0)";
        if (mysqli_query($conn, $sql)) {
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>File Uploaded Successfully!!</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    else {
        $sql1 = "INSERT INTO announcements (name,size,subject, title, body, due_date, downloads) VALUES (null ,null,'$course', '$title', '$body',null ,null)";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>File Uploaded Successfully!!</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
        }
    }
    header("location: TeacherSubject.php?id=$course#services");
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
        #color {
            color: white;
        }

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
    <h1 class="agile_head text-center">Make Announcement</h1>
    <div class="container">
        <div class="w3layouts_main wrap">
            <form action="detainstudents.php" method="post" enctype="multipart/form-data">
                <?php 
                if(isset($_POST['detention']))
                {
                    $course = strtoupper($_POST['course']);
                    $detian = unserialize($_POST['detain']); 

                }
                ?>
                <b id="color">Title: </b>
                <input type="text" name="title" class="form-control" value="DETENTION LIST FOR <?PHP echo $course ?>" required>
                <br>
                <b id="color">Body: </b><br>
                <input type="hidden" name="course" id="course" value="<?php echo $course?>">
                <textarea name="description" id="" cols="20" rows="10" class="form-select"><?php $txt="";
                    $sr = 1;
                    foreach ($detian as $key => $value) {
                        foreach ($value as $enroll => $percentage) {
                            $txt .= $enroll . ', ';
                            $sr++;
                        }
                    } echo $txt; ?>
                    </textarea>

                <div style="text-align:left;">
                    <br>
                    <b id="color">Due date: </b><input type="date" name="due_date" placeholder="Due Date"> <br>
                </div>
                <br>
                <br>
                 <center>

                    <button type="submit" name="save" class="btn btn-primary" id="color">Upload</button>

                </center>

            </form>
        </div>
    </div>


</body>

</html>