<?php
// ob_start();
// Code to download the files
if (isset($_GET['file_id1'])) {
    $id = $_GET['file_id1'];
    include "../conn.php";
    $sql = "SELECT * FROM announcements WHERE id=$id ORDER BY due_date DESC";
    $result = mysqli_query($conn, $sql);

    $file1 = mysqli_fetch_assoc($result);
    $file1path = 'uploads/' . $file1['name'];

    if (file_exists($file1path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file1path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('announcementuploads/' . $file1['name']));
        readfile('announcementuploads/' . $file1['name']);

        $newCount = $file1['downloads'] + 1;
        $updateQuery = "UPDATE announcements SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }
}

?>
