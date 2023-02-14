<?php
// session_start();
include "../conn.php";
$enroll = $_SESSION['enrollid'];
$semester = mysqli_fetch_row(mysqli_query($conn, "SELECT `semester` FROM `students` WHERE `enrollment`=$enroll"));
$batch = mysqli_fetch_row(mysqli_query($conn, "SELECT `batch` FROM `students` WHERE `enrollment`=$enroll"));
$table = "tt" . $semester[0];
$batch = $batch[0];
$r = mysqli_query($conn, "SELECT * FROM `course_reg` where enroll=$enroll");
date_default_timezone_set('Asia/Kolkata');
$r=mysqli_fetch_assoc($r);
foreach ($r as $key => $value) {
    if ($key == 'enroll')
        continue;
    $course[] = $value;
}
function showmore($day)
{
    global $conn, $table, $batch, $course;
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `$table` WHERE `day`='$day' and `batch`='$batch'"));
    $cancelled = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `cancelled_classes`"));
    for ($i = 0; $i < count($cancelled); $i++) {
        if ($data['day'] == $cancelled[$i][0]) {
            foreach ($data as $key => $value) {
                if ($key == $cancelled[$i][1] && $value == $cancelled[$i][2])
                    $data[$key] = 'NULL';
            }
        }
    }

    $added = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `extra_classes`"));
    for ($i = 0; $i < count($added); $i++) {
        if ($data['day'] == $added[$i][0]) {
            foreach ($data as $key => $value) {
                if ($key == $added[$i][1] && $value == 'NULL' && in_array($added[$i][2], $course))
                    $data[$key] = $added[$i][2];
            }
        }
    }
    foreach ($data as $key => $value) {
        echo '<td width=250px>' . $value . '</td>';
    }
    echo '<tr>';
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nav-toggle').click(function() {
                var collapse_content_selector = $(this).attr('href');
                var toggle_switch = $(this);
                $(collapse_content_selector).toggle(function() {
                    if ($(this).css('display') == 'none') {
                        toggle_switch.html('Upcoming Schedule');
                    } else {
                        toggle_switch.html('Hide');
                    }
                });
            });

        });
    </script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>View TT</title>
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
        body{
            background-image: url("../assets/img/change.jpg");
            background-size: cover;
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
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="../StudentHome.php" class="breadcrumbs__link">Home</a>
        </li>

        <li class="breadcrumbs__item">
            <a href="/Timetable/studentview.php" class="breadcrumbs__link breadcrumbs__link--active">Schedule</a>
        </li>
    </ul>
    <h1 style="margin-top:80px" class="agile_head text-center">Today's Schedule</h1>
    <center>

        <table id="myTable" class="table table-dark table-striped" style="width: 80%">
            <thead>
                <tr>
                    <?php
                    $day = date('l', time());
                    $tt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `$table` WHERE `day`='$day'"));
                    foreach ($tt as $key => $value) {
                        echo '<th>' . $key . '</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tr>
                <?php showmore(date('l', time())); ?>
            </tr>
        </table><br>
        <div id="collapse" style="display:none">
            <table class="table table-dark table-striped" style="width: 80%">
                <tbody>
                    <?php showmore(date('l', time() + 86400)); ?>
                    <?php showmore(date('l', time() + (86400 * 2))); ?>
                    <?php showmore(date('l', time() + (86400 * 3))); ?>
                    <?php showmore(date('l', time() + (86400 * 4))); ?>
                    <?php showmore(date('l', time() + (86400 * 5))); ?>
                    <?php showmore(date('l', time() + (86400 * 6))); ?>
                </tbody>
            </table>
        </div>
                <!--<button href="#collapse" class="nav-toggle btn btn-primary">Upcoming Schedule</button>-->
                <button  href="#collapse" class="nav-toggle get-started-btn scrollto" style="color: #ffc451;">Upcoming Schedule</button>

    </center>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
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