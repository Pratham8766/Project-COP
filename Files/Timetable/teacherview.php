<?php
include "../conn.php";
$tid = $_SESSION['enrollid'];
$table = "tt1";
date_default_timezone_set('Asia/Kolkata');
$r = mysqli_query($conn, "SELECT course_id,course_name FROM `courses` where teacher_id=$tid");
while ($c = mysqli_fetch_assoc($r))
{
    $course[] = $c['course_id'];
    $course_name[]=$c['course_name'];
}
$day = date('l', time());
$data['day'] = 'NULL';
$data['9-10'] = 'NULL';
$data['10-11'] = 'NULL';
$data['11-12'] = 'NULL';
$data['12-13'] = 'NULL';
$data['13-14'] = 'NULL';
$data['14-15'] = 'NULL';
$data['15-16'] = 'NULL';
$data['16-17'] = 'NULL';
$data['17-18'] = 'NULL';
function printschedule($day, $date)
{
    global $course, $tid, $table, $conn,$course_name;
    $data['day'] = 'NULL';
    $data['9-10'] = 'NULL';
    $data['10-11'] = 'NULL';
    $data['11-12'] = 'NULL';
    $data['12-13'] = 'NULL';
    $data['13-14'] = 'NULL';
    $data['14-15'] = 'NULL';
    $data['15-16'] = 'NULL';
    $data['16-17'] = 'NULL';
    $data['17-18'] = 'NULL';
    for ($i = 1; $i < 7; $i++) {
        $sql = "SELECT * FROM `tt$i` where `day`='$day'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($row as $key => $value) {
                if ($key == 'batch')
                    continue;
                if($key=='day')
                    $data['day']=$value;
                if ($value != 'NULL' && in_array($value,$course)) {
                    $data[$key] = $value;
                }
            }
        }
    }

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

    echo '<tbody>
            <tr>';
    foreach ($data as $key => $value) {
        echo '<td style="text-align: center">' . $value . '</td>';
    }
    echo '<tr>';
    echo '</tr>
        <tr>
            <form action="teacherview.php" method="post">';
    $x=0;
    foreach ($data as $key => $value) {
        if ($key == 'day') {
            $data['date'] = $date;
            echo '<td><button style="font-size: 15px;text-align: center;"  name="day" value="' . htmlentities(serialize($data)) . '" class="semi-transparent-button">Cancel All </button></td>';
        } elseif ($value != 'NULL') {
            $cancel = array("day" => $day, "ts" => $key, "course_id" => $value, "date" => $date);
            echo '<td><button style="font-size: 13px; text-align: center;" name="cancel" value="' . htmlentities(serialize($cancel)) . '" class="semi-transparent-button">Cancel</button></td>';
        } else {
            echo '<input type="hidden" name="add" value="'.$x.'">';
            echo '<td><center><select onchange="if(this.value != 0) { this.form.submit(); }" style="font-size: 15px;text-align: center;" name="add'.$x.'"><option selected>Add</option>';
            foreach ($course as $keyx => $course_id) {
                $add= array("day" => $day, "ts" => $key, "course_id" => $course_id, "date" => $date);
                echo '<option value="' . htmlentities(serialize($add)) . '">' . $course_name[$keyx] . '</option>';
            }
            echo '</select></center></td>';
            $x++;
        }
    }
    echo '<tr>';
    echo '</form>
        </tr>
     </tbody>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // include "../conn.php";
    $hotsname = "localhost";
    $username = "id16934540_cop";
    $password = "Teamshadow@000";
    $dbname = "id16934540_cmcop";
    $conn = mysqli_connect($hotsname,$username,$password,$dbname);
    date_default_timezone_set('Asia/Kolkata');
    if(!$conn){
        echo "error in connecting to database";
    }
    if (isset($_POST['day'])) {
        $all = unserialize($_POST['day']);
        $date = $all['date'];
        $day = $all['day'];
        foreach ($all as $key => $value) {
            if ($key != 'day' && $value != 'NULL' && $key != 'date') {
                $delete = mysqli_query($conn, "DELETE FROM `extra_classes` WHERE `day`='$day' AND  `Timeslot`='$key' AND `Course_id`='$value'");
                $result = mysqli_query($conn, "INSERT INTO `cancelled_classes` (`day`, `Timeslot`, `Course_id`,`date`) VALUES('$day', '$key', '$value','$date')");
            }
        }
        if ($result)
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Class cancelled successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        else
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Unknown error occurred!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
    } elseif (isset($_POST['cancel'])) {
        $cancel = unserialize($_POST['cancel']);
        $day = $cancel['day'];
        $ts = $cancel['ts'];
        $date = $cancel['date'];
        $course_id = $cancel['course_id'];
        $delete = mysqli_query($conn, "DELETE FROM `extra_classes` WHERE `day`='$day' AND  `Timeslot`='$ts' AND `Course_id`='$course_id'");
        $result = mysqli_query($conn, "INSERT INTO `cancelled_classes` (`day`, `Timeslot`, `Course_id`,`date`) VALUES('$day', '$ts', '$course_id','$date')");
        if ($result)
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Class cancelled successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        else
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Unknown error occurred!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
    } elseif (isset($_POST['add'])) {
        for ($i=0; $i <= $_POST['add']; $i++) {
            $help="add".$i; 
            if (strlen($_POST[$help])>3) {
                $add = unserialize($_POST[$help]);
            }
        }
        //   $yes=false;
        //     echo '<script>
        //         if (confirm("Are you sure u want add '.$add['course_id'].' at '.$add['ts'].'?"))
        //         {
        //             ';$yes=true; echo'                            
        //         }
        //         </script>';
        //         echo $yes;
        $day = $add['day'];
        $date = $add['date'];
        $ts = $add['ts'];
        $course_id = $add['course_id'];
        $sem=mysqli_fetch_assoc(mysqli_query($conn, "SELECT `semester` FROM `courses` WHERE `course_id`='$course_id'"));
        $sem=$sem['semester'];
        $tt="tt".$sem;
        $sub=mysqli_fetch_assoc(mysqli_query($conn,"SELECT `$ts` FROM $tt where `day`='$day'"));
        $sub=$sub[$ts];
        $can=mysqli_fetch_assoc(mysqli_query($conn,"SELECT `course_id` from cancelled_classes where `day`='$day' and `Timeslot`='$ts'"));
        if($can!=null)
        {
            foreach($can as $value)
            {
                $q=mysqli_fetch_assoc(mysqli_query($conn,"SELECT `course_id` from courses where course_id='$value' and semester=$sem"));
            }
            if($q!=null)
                $sub='NULL';
        }
        $a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `course_id` from extra_classes where `day`='$day' and `Timeslot`='$ts'"));
        if ($a != null) {
            foreach ($a as $value) {
                $q = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `course_id` from courses where course_id='$value' and semester=$sem"));
            }
            if ($q != null)
                $sub = $q['course_id'];
        }
        if($sub!='NULL')
        {
            $teacher=mysqli_fetch_assoc(mysqli_query($conn,"SELECT `first name`, `last name` from teachers where teacher_id = (SELECT teacher_id from courses WHERE course_id = '$sub');"));
            $teacher=$teacher['first name'].' '.$teacher['last name'];
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Cannot add!!</strong> Class already engaged by '.$teacher.'('.$sub.')
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else
        {
            $delete = mysqli_query($conn, "DELETE FROM `cancelled_classes` WHERE `date`='$date' AND  `Timeslot`='$ts' AND `Course_id`='$course_id'");
            $result = mysqli_query($conn, "INSERT INTO `extra_classes` (`day`, `Timeslot`, `Course_id`,`date`) VALUES ('$day', '$ts', '$course_id','$date')");
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Class added successfully</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Unkonwn error occured!!</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
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
    <style>
        select {
            padding: 5px;
            color: #000;
            font-size: 10px;
            color: white;
            border: black;
            text-align: center;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.5);
            ;
            -webkit-appearance: none;
            width: 50%;
        }

        select option {
            background-color: black;
        }

        .semi-transparent-button {
            display: block;
            box-sizing: border-box;
            margin: 0 auto;
            padding: 2px;
            width: 80%;
            max-width: 100px;
            background: #fff;
            /* fallback color for old browsers */
            background: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            color: #fff;
            text-align: center;
            text-decoration: none;
            letter-spacing: 1px;
            transition: all 0.3s ease-out;
        }

        .semi-transparent-button:hover,
        .semi-transparent-button:focus,
        .semi-transparent-button:active {
            background: #fff;
            color: #000;
            transition: all 0.5s ease-in;
        }

        .semi-transparent:focus {
            outline: none;
        }

        .is-blue {
            background: #1e348e;
            /* fallback color for old browsers */
            background: rgba(30, 52, 142, 0.5);
        }

        .is-blue:hover,
        .is-blue:focus,
        .is-blue:active {
            background: #1e348e;
            /* fallback color for old browsers */
            background: rgb(30, 52, 142);
            color: #fff;
        }
        body{
            background-image: url("../assets/img/change.jpg");
            background-size: cover;
        }

        .with-border {
            border: 1px solid #fff;
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
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>View Time Table</title>
</head>

<body>
    <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
            <a href="../TeacherHome.php" class="breadcrumbs__link">Home</a>
        </li>

        <li class="breadcrumbs__item">
            <a href="teacherview.php" class="breadcrumbs__link breadcrumbs__link--active">Today's Schedule</a>
        </li>
    </ul>
    <h1 style="margin-top:80px" class="agile_head text-center">Today's Schedule</h1>
    <center>
        <!-- <div class="container"> -->
        <!-- <div class="row"> -->
        <table class="table table-dark table-striped" style="width: 80%">
            <thead>
                <tr>
                    <?php
                    foreach ($data as $key => $value) {
                        echo '<td style="text-align: center">' . strtoupper($key) . '</td>';
                    }
                    ?>
                </tr>
            </thead>
            <p> <?php printschedule(date('l', time()), date('Y-m-d', time())); ?> </p>
        </table>
        <div id="collapse" style="display:none">
            <table class="table table-dark table-striped" style="width: 80%">
                <p> <?php printschedule(date('l', time() + 86400), date('Y-m-d', time() + 86400)); ?> </p>
                <p> <?php printschedule(date('l', time() + (86400 * 2)), date('Y-m-d', time() + (86400 * 2))); ?> </p>
                <p> <?php printschedule(date('l', time() + (86400 * 3)), date('Y-m-d', time() + (86400 * 3))); ?> </p>
                <p> <?php printschedule(date('l', time() + (86400 * 4)), date('Y-m-d', time() + (86400 * 4))); ?> </p>
                <p> <?php printschedule(date('l', time() + (86400 * 5)), date('Y-m-d', time() + (86400 * 5))); ?> </p>
                <p> <?php printschedule(date('l', time() + (86400 * 6)), date('Y-m-d', time() + (86400 * 6))); ?> </p>
            </table>
        </div>
        <!--<button href="#collapse" class="nav-toggle btn btn-primary">Upcoming Schedule</button>-->
        <button  href="#collapse" class="nav-toggle get-started-btn scrollto" style="color: #ffc451;">Upcoming Schedule</button>
        <!-- </div> -->
        <!-- </div> -->
    </center>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>