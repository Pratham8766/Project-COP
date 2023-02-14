<?php
// connect to the database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "cop";
// $conn = mysqli_connect($servername, $username, $password, $dbname);
include("conn.php");
$sql = "SELECT * FROM notices";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    // destination of the file on the server
    $destination = 'noticeuploads/' . $filename;
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
            $sql = "INSERT INTO notices (name, subject, body, size, downloads) VALUES ('$filename', '$subject', '$body', $size, 0)";
            if (mysqli_query($conn, $sql)) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>File Uploaded Successfully.</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                echo '<script>
                    function showNotification() {
                        const notification = new Notification("New message from decode!", {
                            body: "hi in body"
                        });
                    }

                    console.log(Notification.permission);

                    if (Notification.permission === "granted") {
                        showNotification();
                    } else if (Notification.permission !== "denied") {
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted") {
                                showNotification();
                            }
                        });
                    }
                </script>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Failed to Upload file.</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
}

?>
