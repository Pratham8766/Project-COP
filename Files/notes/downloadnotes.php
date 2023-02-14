<?php
ob_start();
// include 'notes_Upload_files.php';
// Code to download the files
include "../conn.php";
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    $sql = "SELECT * FROM notes WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('notesuploads/' . $file['name']));
        readfile('notesuploads/' . $file['name']);

        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE notes SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }
}
?>