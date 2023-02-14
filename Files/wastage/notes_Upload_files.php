<?php
// connect to the database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "cop";
// $conn = mysqli_connect($servername, $username, $password, $dbname);
include("conn.php");
$sql = "SELECT * FROM notes order by `upload_date` desc";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $course = $_POST['course'];
    $unit = $_POST['unit'];
    // destination of the file on the server
    $destination = 'notesuploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO notes (name, course_id, unit, size, downloads) VALUES ('$filename', '$course', $unit, $size, 0)";
            if (mysqli_query($conn, $sql)) {
                echo '<html>
                <title>Announcement Upload Files</title>
                <head>
                <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
                <body>
                
                
                
                
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>File Uploaded Successfully!!</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
                
                </body>
                </html>';
            }
        } else {
            echo '<html>
            <title>Announcement Upload Files</title>
            <head>
            <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
            <body>
            
            
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>File Not Uploaded!!</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
            
            </body>
            </html>';
        }
    }
}

?>
