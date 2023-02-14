<?php
// session_start();
include "../conn.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table = "tt" . $_POST['area'];
    $sem = $_POST['area'];
} ?>
<!doctype html>
<html lang="en">

<head>
    <style>
        select {
            padding: 5px;
            color: #000;
            font-size: 12px;
            color: white;
            border: transparent;
            background: transparent;
            -webkit-appearance: none;
            width: 150px;
        }

        select option {
            background-color: black;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Timetable</title>
</head>

<body>
    <h2 style="text-align: center;">Add Timetable</h2>
    <form action="store.php" method="post">
        <table class="table table-dark table-striped">
            <thead>
                <tr><?php
                    $result = mysqli_query($conn, "SELECT * FROM `$table`");
                    $tt = mysqli_fetch_assoc($result);
                    foreach ($tt as $key => $value) {
                        echo '<td>' . $key . '</td>';
                    }
                    ?></tr>
            </thead>
            <tbody>
                <tr><?php
                    $count = 0;
                    $result = mysqli_query($conn, "SELECT * FROM `$table`");
                    while ($tt = mysqli_fetch_assoc($result)) {
                        $time[] = $tt;
                        foreach ($tt as $key => $value) {
                            if ($key == 'day') {
                                if ($count == 0 || $count % 3 == 0)
                                    echo '<td rowspan="3" style="vertical-align : middle;">' . $value . '</td>';
                                else
                                    continue;
                            } elseif ($key == 'batch') {
                                // echo '<td>batch</td>';
                                echo '<td>' . $value . '</td>';
                            } else {
                                $sql = "SELECT * FROM `courses` where semester=$sem";
                                $r = mysqli_query($conn, $sql);
                                echo '<td><select name="course[]" aria-label="Default select example">                
                            <option selected>NULL</option>';
                                while ($course = mysqli_fetch_assoc($r)) {
                                    echo '<option value="' . $course['course_id'] . '">' . $course['course_name'] . '</option>';
                                }
                                echo '</select></td>';
                            }
                        }
                        echo '<tr>';
                        $count++;
                    }
                    $_SESSION['var']=$time;
                    $_SESSION['table']=$table;
                    ?></tr>
            </tbody>
        </table>
        <div class="col-12">
            <center>
                <button type="submit" style="width: 250px;" class="btn btn-primary">Save</button>
        </div>


    </form>
    <!-- Optional JavaScript; choose one of the two ! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>-->
</body>

</html>
